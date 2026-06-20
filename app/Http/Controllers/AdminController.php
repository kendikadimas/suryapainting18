<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\OrderTimeline;
use App\Models\User;

class AdminController extends Controller
{
    // Show login page
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Show register page
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        // Block registration if any admin already exists
        if (User::count() > 0) {
            return redirect()->route('admin.login');
        }

        return view('admin.register');
    }

    // Handle register request
    public function register(Request $request)
    {
        // Block public registration if any admin already exists
        if (User::count() > 0 && !Auth::check()) {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Auto-login only for first-time registration (no admin exists yet)
        if (User::count() === 1) {
            Auth::login($user);
            return redirect()->route('admin.dashboard')->with('success', 'Akun admin berhasil dibuat. Selamat datang!');
        }

        return redirect()->route('admin.dashboard')->with('success', 'Akun admin baru berhasil ditambahkan.');
    }

    // Show add admin form (authenticated only)
    public function showAddAdminForm()
    {
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Hanya superadmin yang dapat menambah admin baru.');
        }
        return view('admin.add-admin');
    }

    // Store new admin (authenticated only)
    public function storeAdmin(Request $request)
    {
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Hanya superadmin yang dapat menambah admin baru.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Akun admin baru berhasil ditambahkan.');
    }

    // List all admins
    public function listAdmins()
    {
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Hanya superadmin yang dapat melihat daftar admin.');
        }

        $admins = User::orderBy('created_at', 'desc')->get();
        return view('admin.list-admin', compact('admins'));
    }

    // Delete an admin (cannot delete self)
    public function deleteAdmin($id)
    {
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Hanya superadmin yang dapat menghapus admin.');
        }

        $admin = User::findOrFail($id);

        if ($admin->id === Auth::id()) {
            return back()->withErrors(['Tidak dapat menghapus akun sendiri.']);
        }

        $admin->delete();

        return back()->with('success', 'Akun admin berhasil dihapus.');
    }

    // Show forgot password page
    public function showForgotPasswordForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.forgot-password');
    }

    // Send password reset link
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Link reset password telah dikirim ke email Anda. (Cek folder spam atau log file jika menggunakan MAIL_MAILER=log)');
        }

        return back()->withErrors([
            'email' => 'Email tidak ditemukan dalam sistem.',
        ])->onlyInput('email');
    }

    // Show reset password form
    public function showResetPasswordForm(string $token)
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        // If no email in query string, link is invalid
        if (!request('email')) {
            return redirect()->route('admin.forgot-password')
                ->withErrors(['email' => 'Link reset password tidak valid. Silakan minta ulang.']);
        }

        return view('admin.reset-password', ['token' => $token]);
    }

    // Handle reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => \Illuminate\Support\Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('admin.login')->with('success', 'Password berhasil direset. Silakan login dengan password baru Anda.');
        }

        return back()->withErrors([
            'email' => 'Link reset password tidak valid atau sudah kedaluwarsa. Silakan coba lagi.',
        ])->onlyInput('email');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    // Show dashboard (list orders)
    public function dashboard(Request $request)
    {
        $search = $request->input('search');
        $query = Order::query()->withCount('timeline');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nomor_surat', 'LIKE', "%{$search}%")
                  ->orWhere('customer_name', 'LIKE', "%{$search}%")
                  ->orWhere('customer_phone', 'LIKE', "%{$search}%")
                  ->orWhere('product_name', 'LIKE', "%{$search}%")
                  ->orWhere('nomor_plat', 'LIKE', "%{$search}%");
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.dashboard', compact('orders', 'search'));
    }

    // Create a new order
    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100|unique:orders,nomor_surat',
            'customer_name' => 'required|string|max:150',
            'customer_phone' => 'nullable|string|max:20',
            'nomor_plat' => 'nullable|string|max:50',
            'tipe_motor' => 'nullable|string|in:Matic,Kopling',
            'detail_motor' => 'nullable|string|max:500',
            'product_name' => 'required|string|max:255',
        ]);

        $order = Order::create($validated);

        OrderTimeline::create([
            'order_id' => $order->id,
            'title' => 'Pesanan Dibuat',
            'description' => 'Pesanan baru telah berhasil didaftarkan di sistem.',
        ]);

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', "Pesanan baru berhasil dibuat dengan Nomor Surat: {$order->nomor_surat}");
    }

    // Show order details and edit timeline page
    public function showOrder($id)
    {
        $order = Order::with('timeline')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Update order data
    public function updateOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100|unique:orders,nomor_surat,' . $order->id,
            'customer_name' => 'required|string|max:150',
            'customer_phone' => 'nullable|string|max:20',
            'nomor_plat' => 'nullable|string|max:50',
            'tipe_motor' => 'nullable|string|in:Matic,Kopling',
            'detail_motor' => 'nullable|string|max:500',
            'product_name' => 'required|string|max:255',
        ]);

        $order->update($validated);

        return back()->with('success', 'Data pesanan berhasil diperbarui.');
    }

    // Add progress step (timeline) to order
    public function addTimeline(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:Pending,Processing,Completed,Cancelled',
            'image' => 'nullable|file|max:20480',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = strtolower($file->getClientOriginalExtension() ?: '');
            $allowedExtensions = ['jpeg', 'png', 'jpg', 'gif', 'webp', 'heic', 'heif'];

            if (!in_array($ext, $allowedExtensions)) {
                return back()->withErrors(['image' => 'Format file gambar tidak didukung (harus jpeg, png, jpg, gif, webp, heic, heif).'])->withInput();
            }
        }

        // Update order status
        $order->update(['status' => $validated['status']]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $imagePath = $this->storeImageAsWebp($request->file('image'));
            } catch (\Throwable $e) {
                report($e);
            }
        }

        OrderTimeline::create([
            'order_id' => $order->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
        ]);

        return back()->with('success', 'Progres baru berhasil ditambahkan ke timeline.');
    }

    // Convert uploaded image to WebP and store it.
    // Returns the relative storage path (e.g. "orders/abc123.webp") or null on failure.
    // Compatible with Intervention Image v4 (which ships on the production server).
    private function storeImageAsWebp($file): ?string
    {
        try {
            $hash    = uniqid('', true);
            $name    = 'orders/' . $hash . '.webp';
            $quality = 80;
            $path    = $file->getRealPath();

            // Build the ImageManager with the best available driver (Imagick preferred over GD).
            $driver = extension_loaded('imagick')
                ? new \Intervention\Image\Drivers\Imagick\Driver()
                : new \Intervention\Image\Drivers\Gd\Driver();

            $manager = new \Intervention\Image\ImageManager($driver);

            // decode() is the v4 primary entry-point; it accepts file paths, binary, SplFileInfo …
            $image  = $manager->decode($path);

            // encodeUsingFileExtension() is the v4 API and returns EncodedImageInterface.
            $binary = $image->encodeUsingFileExtension('webp', $quality)->toString();

            Storage::disk('public')->put($name, $binary);

            return $name;
        } catch (\Throwable $e) {
            report($e);

            // Fallback: store the original file when WebP conversion is not possible
            // (e.g. HEIC/HEIF captured directly from an iPhone camera on a GD-only server).
            try {
                $ext  = strtolower($file->getClientOriginalExtension() ?: 'jpg');
                $hash = uniqid('', true);
                $name = 'orders/' . $hash . '.' . $ext;

                Storage::disk('public')->putFileAs('orders', $file, $hash . '.' . $ext);

                return $name;
            } catch (\Throwable $e2) {
                report($e2);
                return null;
            }
        }
    }


    // Delete a timeline item
    public function deleteTimeline($id)
    {
        $timeline = OrderTimeline::findOrFail($id);

        if ($timeline->image_path) {
            Storage::disk('public')->delete($timeline->image_path);
        }

        $timeline->delete();

        return back()->with('success', 'Progres berhasil dihapus dari timeline.');
    }

    // Delete an order
    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);

        foreach ($order->timeline as $timeline) {
            if ($timeline->image_path) {
                Storage::disk('public')->delete($timeline->image_path);
            }
        }

        $order->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Pesanan berhasil dihapus.');
    }
}
