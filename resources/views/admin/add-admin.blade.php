<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Admin | SuryaPainting18</title>
    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <link rel="apple-touch-icon" href="/assets/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,400;0,600;0,700;0,800;0,900;1,700;1,800;1,900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root{--pink:#ee14b1;--pink-dark:#c0108f;--dark:#0d0d0d;--gray:#888;}
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Inter',sans-serif;background-color:#0a0a0a;color:#fff;min-height:100vh;display:flex;flex-direction:column;overflow-x:hidden;background-image:radial-gradient(ellipse at 50% 0%,rgba(238,20,177,0.04) 0%,transparent 60%),radial-gradient(ellipse at 80% 100%,rgba(238,20,177,0.03) 0%,transparent 50%);background-attachment:fixed}
        .admin-nav{position:sticky;top:0;z-index:40;background:rgba(10,10,10,0.97);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,0.06)}
        .admin-nav-inner{max-width:1280px;margin:0 auto;padding:0 24px;height:68px;display:flex;align-items:center;justify-content:space-between}
        @media(min-width:1024px){.admin-nav-inner{padding:0 48px}}
        .admin-nav-brand{display:flex;align-items:center;gap:12px;text-decoration:none}
        .admin-nav-badge{font-family:'Inter',sans-serif;font-size:9px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:var(--gray);background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);padding:4px 10px;margin-left:10px;line-height:1}
        .btn-ghost-admin{display:inline-flex;align-items:center;gap:8px;background:transparent;color:rgba(255,255,255,0.6);font-family:'Barlow Condensed',sans-serif;font-size:11px;font-weight:700;font-style:italic;letter-spacing:2px;text-transform:uppercase;padding:10px 18px;border:1px solid rgba(255,255,255,0.12);text-decoration:none;transition:border-color 0.25s,color 0.2s;cursor:pointer}
        .btn-ghost-admin:hover{border-color:rgba(255,255,255,0.4);color:#fff}
        .admin-main{flex:1;max-width:640px;width:100%;margin:0 auto;padding:40px 24px}
        @media(min-width:1024px){.admin-main{padding:48px}}
        @media(max-width:640px){.admin-nav-inner{padding:0 14px;height:56px}.admin-main{padding:20px 16px}}
        .page-header{margin-bottom:32px}
        .page-header-label{font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--pink);display:flex;align-items:center;gap:12px;margin-bottom:10px}
        .page-header-label-line{width:36px;height:2px;background:var(--pink)}
        .page-heading{font-family:'Barlow Condensed',sans-serif;font-size:clamp(24px,4vw,40px);font-weight:900;font-style:italic;text-transform:uppercase;color:#fff;line-height:1}
        .admin-card{background:#111;border:1px solid rgba(255,255,255,0.08);padding:32px 28px;position:relative}
        @media(max-width:640px){.admin-card{padding:20px 16px;background:#131313}}
        .alert-success{background:rgba(3,144,74,0.1);border:1px solid rgba(3,144,74,0.25);border-left:3px solid #03904a;padding:16px 20px;margin-bottom:28px;display:flex;align-items:flex-start;gap:12px;position:relative}
        .alert-success-icon{width:20px;height:20px;background:#03904a;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
        .alert-success-icon svg{width:12px;height:12px;color:#fff}
        .alert-success-title{font-weight:700;color:#fff;margin-bottom:2px}
        .alert-success-text{font-size:13px;color:rgba(255,255,255,0.7)}
        .alert-close{position:absolute;top:12px;right:14px;background:none;border:none;color:rgba(255,255,255,0.3);cursor:pointer;padding:4px;transition:color 0.2s}
        .alert-close:hover{color:#fff}
        .login-error{background:rgba(238,20,177,0.1);border:1px solid rgba(238,20,177,0.3);border-left:3px solid var(--pink);padding:14px 16px;margin-bottom:24px;display:flex;align-items:flex-start;gap:12px}
        .login-error-icon{width:20px;height:20px;background:var(--pink);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
        .login-error-icon svg{width:12px;height:12px;color:#fff}
        .login-error ul{list-style:none;margin:0;padding:0}
        .login-error li{font-size:13px;color:rgba(255,255,255,0.7);line-height:1.6}
        .form-group{margin-bottom:20px}
        .form-label{display:block;font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#888;margin-bottom:10px}
        .form-input-wrap{position:relative}
        .form-input-icon{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#555;display:flex}
        .form-input-icon svg{width:16px;height:16px}
        .form-input{width:100%;padding:13px 16px 13px 44px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:14px;font-weight:500;outline:none;transition:border-color 0.25s}
        .form-input:focus{border-color:var(--pink)}
        .form-input::placeholder{color:#444;font-weight:400}
        .btn-red-admin{display:inline-flex;align-items:center;justify-content:center;gap:10px;width:100%;background:var(--pink);color:#fff;font-family:'Barlow Condensed',sans-serif;font-size:14px;font-weight:800;font-style:italic;letter-spacing:2.5px;text-transform:uppercase;padding:15px 28px;border:2px solid var(--pink);cursor:pointer;transition:background 0.25s,transform 0.2s}
        .btn-red-admin:hover{background:var(--pink-dark);border-color:var(--pink-dark);transform:translateY(-1px)}
        .sidebar-trigger{display:none;background:transparent;border:none;color:rgba(255,255,255,0.5);cursor:pointer;padding:6px;align-items:center}
        .sidebar-trigger:hover{color:#fff}
        .sidebar-link{display:flex;align-items:center;gap:12px;padding:11px 14px;color:rgba(255,255,255,0.55);text-decoration:none;font-family:'Inter',sans-serif;font-size:13px;font-weight:500;border-radius:8px;border-left:3px solid transparent;transition:all 0.15s}
        .sidebar-link:hover{color:#fff;background:rgba(255,255,255,0.04)}
        @media(max-width:640px){.sidebar-trigger{display:flex}.admin-nav-desktop{display:none!important}.admin-nav-inner{gap:8px}}
        @media(max-width:480px){.form-input{padding:11px 14px 11px 38px;font-size:13px}.btn-red-admin{padding:13px 24px;font-size:13px}}
    </style>
</head>
<body x-data="{ sidebarOpen: false }">
    @include('admin.partials.navbar')

    <main class="admin-main">
        <div class="page-header">
            <div class="page-header-label"><span class="page-header-label-line"></span>Manajemen Admin</div>
            <h1 class="page-heading">Tambah Admin Baru</h1>
        </div>

        @if(session('success'))
        <div class="alert-success" x-data="{ show: true }" x-show="show">
            <div class="alert-success-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
            <div><div class="alert-success-title">Berhasil!</div><div class="alert-success-text">{{ session('success') }}</div></div>
            <button @click="show = false" class="alert-close"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        @endif

        @if($errors->any())
        <div class="login-error">
            <div class="login-error-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="admin-card">
            <form action="{{ route('admin.add-admin.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <div class="form-input-wrap">
                        <div class="form-input-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-input" placeholder="Contoh: Budi Santoso" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Alamat Email</label>
                    <div class="form-input-wrap">
                        <div class="form-input-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-input" placeholder="nama@email.com" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="form-input-wrap">
                        <div class="form-input-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                        <input type="password" name="password" id="password" class="form-input" placeholder="Minimal 8 karakter" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <div class="form-input-wrap">
                        <div class="form-input-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Ulangi password" required>
                    </div>
                </div>
                <button type="submit" class="btn-red-admin">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                    Tambah Admin
                </button>
            </form>
        </div>
    </main>
</body>
</html>
