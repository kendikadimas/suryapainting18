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
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

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
        $search    = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

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

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.dashboard', compact('orders', 'search', 'startDate', 'endDate'));
    }

    // Export all (filtered) orders as a modern native Excel (.xlsx) file, with fallback to HTML-based XLS
    public function exportOrders(Request $request)
    {
        $search    = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        $query = Order::with(['timeline'])->withCount('timeline');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nomor_surat',    'LIKE', "%{$search}%")
                  ->orWhere('customer_name',  'LIKE', "%{$search}%")
                  ->orWhere('customer_phone', 'LIKE', "%{$search}%")
                  ->orWhere('product_name',   'LIKE', "%{$search}%")
                  ->orWhere('nomor_plat',     'LIKE', "%{$search}%");
            });
        }

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        // Check if PhpSpreadsheet and its required ZipArchive extension are available
        if (class_exists('PhpOffice\PhpSpreadsheet\Spreadsheet') && class_exists('ZipArchive')) {
            try {
                $filename = 'pesanan-suryapainting18-' . now()->format('Y-m-d') . '.xlsx';

                // Clean output buffers to prevent corrupt files
                if (ob_get_length()) ob_end_clean();

                return Excel::download(new OrdersExport($orders, $search, $startDate, $endDate), $filename);
            } catch (\Throwable $e) {
                report($e);
                // Fallback to HTML-based XLS
            }
        }

        // Fallback: Generate HTML-based XLS (does not require ZipArchive or other special PHP extensions)
        $filename = 'pesanan-suryapainting18-' . now()->format('Y-m-d') . '.xls';
        $html     = $this->generateHtmlExcel($orders, $search, $startDate, $endDate);

        return response($html, 200)
            ->header('Content-Type',        'application/vnd.ms-excel; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Pragma',  'no-cache')
            ->header('Expires', '0');
    }

    // Helper to generate the structured HTML Excel when PhpSpreadsheet or ext-zip is missing
    private function generateHtmlExcel($orders, $search, $startDate, $endDate)
    {
        $metaText = 'Laporan: Daftar Pesanan';
        if ($search) $metaText .= ' | Filter: "' . e($search) . '"';
        if ($startDate) $metaText .= ' | Dari: ' . date('d/m/Y', strtotime($startDate));
        if ($endDate) $metaText .= ' | Sampai: ' . date('d/m/Y', strtotime($endDate));
        $metaText .= ' | Diekspor: ' . now()->format('d/m/Y H:i') . ' WIB | Total Pesanan: ' . $orders->count();

        $rowsHtml = '';
        foreach ($orders as $index => $order) {
            $bgColor = ($index % 2 === 0) ? '#ffffff' : '#f6f2fc';
            
            $statusLabel = match($order->status) {
                'Pending'    => 'Menunggu',
                'Processing' => 'Diproses',
                'Completed'  => 'Selesai',
                'Cancelled'  => 'Dibatalkan',
                default      => $order->status,
            };
            $statusStyle = match($order->status) {
                'Pending'    => 'background:#fefce8;color:#854d0e;font-weight:bold;text-align:center;border-left:3px solid #eab308;',
                'Processing' => 'background:#eff6ff;color:#1e40af;font-weight:bold;text-align:center;border-left:3px solid #3b82f6;',
                'Completed'  => 'background:#f0fdf4;color:#166534;font-weight:bold;text-align:center;border-left:3px solid #22c55e;',
                'Cancelled'  => 'background:#fff0f0;color:#991b1b;font-weight:bold;text-align:center;border-left:3px solid #ef4444;',
                default      => 'text-align:center;',
            };

            // Calculate duration
            $duration = '—';
            if ($order->status === 'Completed') {
                $latestTimeline = $order->timeline->first();
                $completionTime = $latestTimeline ? $latestTimeline->created_at : $order->updated_at;
                
                $diff = $order->created_at->diff($completionTime);
                $parts = [];
                if ($diff->d > 0) $parts[] = $diff->d . ' hari';
                if ($diff->h > 0) $parts[] = $diff->h . ' jam';
                if ($diff->i > 0 && $diff->d == 0) $parts[] = $diff->i . ' menit';
                if (empty($parts)) $parts[] = '< 1 menit';
                $duration = implode(' ', $parts);
            } elseif (in_array($order->status, ['Pending', 'Processing'])) {
                $duration = 'Dalam proses';
            }

            $tanggalKeluar = in_array($order->status, ['Completed', 'Cancelled'])
                ? $order->updated_at->format('d/m/Y H:i')
                : '—';

            $rowsHtml .= "
            <tr style=\"background:{$bgColor};\">
                <td style=\"text-align:center;color:#666;font-size:9pt;\">" . ($index + 1) . "</td>
                <td style=\"font-weight:bold;color:#3c096c;text-align:center;\">" . e($order->nomor_surat) . "</td>
                <td style=\"font-weight:bold;\">" . e($order->customer_name) . "</td>
                <td style=\"color:#1a7a3a;font-size:9.5pt;\">" . e($order->customer_phone ?: '—') . "</td>
                <td style=\"text-align:center;\">" . e($order->nomor_plat ?: '—') . "</td>
                <td style=\"text-align:center;\">" . e($order->tipe_motor ?: '—') . "</td>
                <td style=\"font-size:9.5pt;color:#444;\">" . e($order->detail_motor ?: '—') . "</td>
                <td>" . e($order->product_name) . "</td>
                <td style=\"{$statusStyle}\">{$statusLabel}</td>
                <td style=\"text-align:center;font-size:9.5pt;\">{$duration}</td>
                <td style=\"text-align:center;font-weight:bold;color:#3c096c;\">{$order->timeline_count}</td>
                <td style=\"text-align:center;font-size:9pt;color:#555;\">" . $order->created_at->format('d/m/Y H:i') . "</td>
                <td style=\"text-align:center;font-size:9pt;color:#555;\">{$tanggalKeluar}</td>
            </tr>";
        }

        $totalCount = $orders->count();
        $copyrightYear = date('Y');

        return "
        <html>
        <head>
            <meta http-equiv=\"content-type\" content=\"application/vnd.ms-excel; charset=UTF-8\">
            <meta charset=\"UTF-8\">
            <style>
                * { font-family: Calibri, Arial, sans-serif; }
                .co-banner { background: #3c096c; color: #ffffff; font-size: 18pt; font-weight: bold; text-align: center; padding: 14px 10px 6px; }
                .co-sub { background: #5a189a; color: #ffd166; font-size: 9pt; text-align: center; padding: 4px 10px 12px; }
                .co-divider { background: #ffd166; height: 4px; font-size: 1pt; }
                .meta-row { background: #f6f2fc; font-size: 9pt; color: #555; padding: 5px 10px; border-bottom: 1px solid #e5dcf2; }
                .meta-label { color: #999; font-weight: bold; }
                table.data-table { border-collapse: collapse; width: 100%; margin-top: 12px; }
                table.data-table thead th { background: #3c096c; color: #ffffff; font-size: 10pt; font-weight: bold; text-align: center; padding: 9px 12px; border: 1px solid #240046; white-space: nowrap; }
                table.data-table tbody td { border: 1px solid #e5dcf2; padding: 7px 11px; font-size: 10pt; vertical-align: middle; }
            </style>
        </head>
        <body>
        <table class=\"data-table\">
            <tr>
                <td colspan=\"13\" class=\"co-banner\" align=\"center\" style=\"text-align:center;border:none;\">🎨 &nbsp; SuryaPainting18</td>
            </tr>
            <tr>
                <td colspan=\"13\" class=\"co-sub\" align=\"center\" style=\"text-align:center;border:none;\">Jasa Pengecatan Motor Profesional &nbsp;·&nbsp; suryapainting18indonesia.com</td>
            </tr>
            <tr>
                <td colspan=\"13\" class=\"co-divider\" style=\"background:#ffd166;height:4px;font-size:1pt;border:none;padding:0;\">&nbsp;</td>
            </tr>
            <tr style=\"height:6px;font-size:1pt;\">
                <td colspan=\"13\" style=\"border:none;\">&nbsp;</td>
            </tr>
            <tr>
                <td colspan=\"13\" class=\"meta-row\" align=\"center\" style=\"text-align:center;background:#f6f2fc;font-size:9pt;color:#555;padding:8px 10px;border-bottom:1px solid #e5dcf2;\">
                    {$metaText}
                </td>
            </tr>
            <tr style=\"height:12px;font-size:1pt;\">
                <td colspan=\"13\" style=\"border:none;\">&nbsp;</td>
            </tr>
            <thead>
                <tr>
                    <th rowspan=\"1\" style=\"width:38px;\" align=\"center\">No.</th>
                    <th align=\"center\">Nomor Surat</th>
                    <th align=\"center\">Nama Pelanggan</th>
                    <th align=\"center\">No. HP / WhatsApp</th>
                    <th align=\"center\">Nomor Plat</th>
                    <th align=\"center\">Tipe Motor</th>
                    <th align=\"center\">Detail Motor</th>
                    <th align=\"center\">Produk / Jasa</th>
                    <th style=\"width:90px;\" align=\"center\">Status</th>
                    <th style=\"width:120px;\" align=\"center\">Durasi Pengerjaan</th>
                    <th style=\"width:70px;\" align=\"center\">Update</th>
                    <th style=\"width:110px;\" align=\"center\">Tanggal Masuk</th>
                    <th style=\"width:110px;\" align=\"center\">Tanggal Keluar</th>
                </tr>
            </thead>
            <tbody>
                {$rowsHtml}
            </tbody>
            <tfoot>
                <tr>
                    <td colspan=\"10\" style=\"background:#3c096c;color:#ffffff;font-weight:bold;font-size:10pt;padding:9px 12px;border:1px solid #240046;text-align:right;\">Total Pesanan</td>
                    <td style=\"background:#3c096c;color:#ffd166;font-weight:bold;font-size:10pt;padding:9px 12px;border:1px solid #240046;text-align:center;\">{$totalCount}</td>
                    <td style=\"background:#3c096c;color:#ffffff;font-weight:bold;font-size:10pt;padding:9px 12px;border:1px solid #240046;\">&nbsp;</td>
                    <td style=\"background:#3c096c;color:#ffffff;font-weight:bold;font-size:10pt;padding:9px 12px;border:1px solid #240046;\">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan=\"13\" align=\"center\" style=\"text-align:center;font-size:8pt;color:#bbb;padding:16px 6px 6px;border:none;border-top:1px solid #e5dcf2;\">
                        &copy; {$copyrightYear} SuryaPainting18 &nbsp;&mdash;&nbsp; Dokumen ini digenerate otomatis oleh sistem pada " . now()->format('d/m/Y H:i') . " WIB
                    </td>
                </tr>
            </tfoot>
        </table>
        </body>
        </html>";
    }

    // Return a printable order letter view for a single order
    public function printOrder($id)
    {
        $order = Order::with(['timeline' => function ($q) {
            $q->orderBy('created_at', 'asc');
        }])->findOrFail($id);

        return view('admin.orders.print', compact('order'));
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
