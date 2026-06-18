<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Admin | SuryaPainting18</title>
    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <link rel="apple-touch-icon" href="/assets/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,400;0,600;0,700;0,800;0,900;1,700;1,800;1,900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --pink: #ee14b1; --pink-dark: #c0108f; --dark: #0d0d0d; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background-color: var(--dark); color: #fff; height: 100vh; overflow: hidden; }
        .login-bg { position: fixed; inset: 0; z-index: 0; background: radial-gradient(ellipse 50% 60% at 70% 40%, rgba(238,20,177,0.12), transparent 60%), radial-gradient(ellipse 40% 50% at 20% 80%, rgba(48,48,48,0.3), transparent 50%), #0d0d0d; }
        .login-bg::before { content: ''; position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px); background-size: 48px 48px; }
        .login-bg::after { content: ''; position: absolute; top: 0; right: 0; width: 0; height: 0; border-style: solid; border-width: 0 180px 180px 0; border-color: transparent #ee14b1 transparent transparent; opacity: 0.25; }
        .login-wrap { position: relative; z-index: 1; height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; }
        .login-box { width: 100%; max-width: 480px; }
        .login-brand { display: flex; align-items: center; justify-content: center; margin-bottom: 40px; text-decoration: none; }
        .login-card { background: #111; border: 1px solid rgba(255,255,255,0.08); padding: 40px 36px; position: relative; overflow: hidden; }
        .login-card::before { content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: var(--pink); }
        .login-card::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px; background: linear-gradient(to right, var(--pink) 0%, transparent 100%); }
        .login-title { font-family: 'Barlow Condensed', sans-serif; font-size: 32px; font-weight: 900; font-style: italic; text-transform: uppercase; color: #fff; line-height: 1; margin-bottom: 6px; letter-spacing: 1px; }
        .login-subtitle { font-size: 12px; color: #555; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 32px; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 10px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; color: #888; margin-bottom: 10px; }
        .form-input-wrap { position: relative; }
        .form-input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #555; display: flex; align-items: center; }
        .form-input-icon svg { width: 16px; height: 16px; }
        .form-input { width: 100%; padding: 13px 16px 13px 44px; background: #0d0d0d; border: 1px solid rgba(255,255,255,0.1); color: #fff; font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 500; outline: none; transition: border-color 0.25s; }
        .form-input:focus { border-color: var(--pink); }
        .form-input::placeholder { color: #444; font-weight: 400; }
        .login-submit { display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; background: var(--pink); color: #fff; font-family: 'Barlow Condensed', sans-serif; font-size: 14px; font-weight: 800; font-style: italic; letter-spacing: 2.5px; text-transform: uppercase; padding: 15px 28px; border: 2px solid var(--pink); cursor: pointer; transition: background 0.25s, transform 0.2s; }
        .login-submit:hover { background: var(--pink-dark); border-color: var(--pink-dark); transform: translateY(-1px); }
        .login-submit svg { width: 16px; height: 16px; }
        .login-error { background: rgba(238,20,177,0.1); border: 1px solid rgba(238,20,177,0.3); border-left: 3px solid var(--pink); padding: 14px 16px; margin-bottom: 24px; display: flex; align-items: flex-start; gap: 12px; }
        .login-error-icon { width: 20px; height: 20px; background: var(--pink); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px; }
        .login-error-icon svg { width: 12px; height: 12px; color: #fff; }
        .login-error ul { list-style: none; margin: 0; padding: 0; }
        .login-error li { font-size: 13px; color: rgba(255,255,255,0.7); line-height: 1.6; }
        .login-success { background: rgba(3,144,74,0.15); border: 1px solid rgba(3,144,74,0.3); border-left: 3px solid #03904a; padding: 14px 16px; margin-bottom: 24px; display: flex; align-items: flex-start; gap: 12px; }
        .login-success-icon { width: 20px; height: 20px; background: #03904a; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px; }
        .login-success-icon svg { width: 12px; height: 12px; color: #fff; }
        .login-success p { font-size: 13px; color: rgba(255,255,255,0.7); line-height: 1.6; }
        .login-footer { margin-top: 28px; text-align: center; }
        .login-footer a { font-family: 'Barlow Condensed', sans-serif; font-size: 12px; font-weight: 700; font-style: italic; letter-spacing: 2px; text-transform: uppercase; color: rgba(255,255,255,0.3); text-decoration: none; transition: color 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .login-footer a:hover { color: rgba(255,255,255,0.7); }
        .login-footer a svg { width: 14px; height: 14px; }
        .login-divider { display: flex; align-items: center; gap: 16px; margin: 24px 0; }
        .login-divider-line { flex: 1; height: 1px; background: rgba(255,255,255,0.08); }
        .login-divider-text { font-size: 10px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; color: #444; white-space: nowrap; }
        @media (max-width: 640px) { .login-bg::after { border-width: 0 80px 80px 0; } }
        @media (max-width: 480px) { .login-card { padding: 28px 20px; } .login-brand { margin-bottom: 28px; } .login-brand img { height: 40px !important; } .login-title { font-size: 26px; } .login-subtitle { font-size: 11px; margin-bottom: 24px; } .form-group { margin-bottom: 16px; } .login-submit { padding: 13px 24px; font-size: 13px; } }
        @media (max-width: 380px) { .login-wrap { padding: 16px; } .login-card { padding: 20px 14px; } .login-brand img { height: 32px !important; } .login-title { font-size: 22px; } .form-input { padding: 11px 14px 11px 38px; font-size: 13px; } .login-submit { padding: 12px 18px; font-size: 12px; } }
    </style>
</head>
<body>
    <div class="login-bg"></div>
    <div class="login-wrap">
        <div class="login-box">
            <a href="{{ route('home') }}" class="login-brand">
                <img src="/assets/01-logo-suryapainting18.png" alt="SuryaPainting18" style="height:52px;width:auto;">
            </a>
            <div class="login-card">
                <h1 class="login-title">Daftar Admin</h1>
                <p class="login-subtitle">Buat akun admin baru untuk mengelola pesanan.</p>
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
                <form action="{{ route('admin.register.submit') }}" method="POST">
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
                    <button type="submit" class="login-submit">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                        Daftar Akun Admin
                    </button>
                </form>
                <div class="login-divider">
                    <span class="login-divider-line"></span>
                    <span class="login-divider-text">atau</span>
                    <span class="login-divider-line"></span>
                </div>
                <div class="login-footer">
                    <a href="{{ route('admin.login') }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        Sudah punya akun? Masuk
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
