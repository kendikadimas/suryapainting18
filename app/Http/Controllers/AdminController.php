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
        return view('admin.register');
    }

    // Handle register request
    public function register(Request $request)
    {
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

        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Akun admin berhasil dibuat. Selamat datang!');
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

    // Update main order status
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|string|in:Pending,Processing,Completed,Cancelled',
        ]);

        $order->update($validated);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    // Add progress step (timeline) to order
    public function addTimeline(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:Pending,Processing,Completed,Cancelled',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,heic,heif|max:10240',
        ]);

        // Update order status if a new one is provided
        if (!empty($validated['status'])) {
            $order->update(['status' => $validated['status']]);
        }

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
    private function storeImageAsWebp($file): ?string
    {
        try {
            $driver = extension_loaded('imagick')
                ? new \Intervention\Image\Drivers\Imagick\Driver()
                : new \Intervention\Image\Drivers\Gd\Driver();

            $manager = new \Intervention\Image\ImageManager($driver);
            $image   = $manager->read($file->getRealPath());

            $hash    = uniqid('', true);
            $name    = 'orders/' . $hash . '.webp';
            $quality = 80;

            Storage::disk('public')->put($name, $image->toWebp($quality)->toString());

            return $name;
        } catch (\Throwable $e) {
            report($e);

            // Fallback: store original file when WebP conversion fails (e.g. HEIC on GD)
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
