<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin | SuryaPainting18</title>

    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <link rel="apple-touch-icon" href="/assets/favicon.png">

    <!-- Google Fonts: Barlow Condensed + Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,400;0,600;0,700;0,800;0,900;1,700;1,800;1,900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite compiled assets (Tailwind v4, Alpine.js, Lucide) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --pink: #ee14b1;
            --pink-dark: #c0108f;
            --dark: #0d0d0d;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--dark);
            color: #fff;
            height: 100vh;
            overflow: hidden;
        }

        /* Background atmosphere */
        .login-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(ellipse 50% 60% at 70% 40%, rgba(238,20,177,0.12), transparent 60%),
                radial-gradient(ellipse 40% 50% at 20% 80%, rgba(48,48,48,0.3), transparent 50%),
                #0d0d0d;
        }

        /* Subtle grid texture */
        .login-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        /* Red accent diagonal corner */
        .login-bg::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 0; height: 0;
            border-style: solid;
            border-width: 0 180px 180px 0;
            border-color: transparent #ee14b1 transparent transparent;
            opacity: 0.25;
        }

        /* ===== LAYOUT ===== */
        .login-wrap {
            position: relative;
            z-index: 1;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .login-body { display: flex; flex-direction: column; min-height: 100vh; }

        .login-box {
            width: 100%;
            max-width: 480px;
        }

        /* ===== BRAND HEADER ===== */
        .login-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 48px;
            text-decoration: none;
        }

        /* ===== CARD ===== */
        .login-card {
            background: #111;
            border: 1px solid rgba(255,255,255,0.08);
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
        }

        /* Left red accent bar */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 4px;
            height: 100%;
            background: var(--pink);
        }

        /* Bottom red bar */
        .login-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(to right, var(--pink) 0%, transparent 100%);
        }

        .login-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 36px;
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            color: #fff;
            line-height: 1;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .login-subtitle {
            font-size: 12px;
            color: #555;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 36px;
        }

        /* ===== FORM ===== */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: #888;
            margin-bottom: 10px;
        }

        .form-input-wrap {
            position: relative;
        }

        .form-input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #555;
            display: flex;
            align-items: center;
        }

        .form-input-icon svg {
            width: 16px;
            height: 16px;
        }

        .form-input {
            width: 100%;
            padding: 13px 16px 13px 44px;
            background: #0d0d0d;
            border: 1px solid rgba(255,255,255,0.1);
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 500;
            outline: none;
            transition: border-color 0.25s;
        }

        .form-input:focus {
            border-color: var(--pink);
        }

        .form-input::placeholder {
            color: #444;
            font-weight: 400;
        }

        /* ===== OPTIONS ROW ===== */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .form-check-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            color: #666;
            cursor: pointer;
            letter-spacing: 0.5px;
        }

        .form-check-label input[type="checkbox"] {
            width: 15px;
            height: 15px;
            border: 1px solid rgba(255,255,255,0.2);
            background: #0d0d0d;
            accent-color: var(--pink);
            cursor: pointer;
        }

        .form-back-link {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
            text-decoration: none;
            transition: color 0.2s;
            font-family: 'Barlow Condensed', sans-serif;
            font-style: italic;
        }

        .form-back-link:hover {
            color: var(--pink);
        }

        /* ===== SUBMIT BUTTON ===== */
        .login-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background: var(--pink);
            color: #fff;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 14px;
            font-weight: 800;
            font-style: italic;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            padding: 15px 28px;
            border: 2px solid var(--pink);
            cursor: pointer;
            transition: background 0.25s, transform 0.2s;
        }

        .login-submit:hover {
            background: var(--pink-dark);
            border-color: var(--pink-dark);
            transform: translateY(-1px);
        }

        .login-submit svg {
            width: 16px;
            height: 16px;
        }

        /* ===== ERROR ALERT ===== */
        .login-error {
            background: rgba(238,20,177,0.1);
            border: 1px solid rgba(238,20,177,0.3);
            border-left: 3px solid var(--pink);
            padding: 14px 16px;
            margin-bottom: 28px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .login-error-icon {
            width: 20px;
            height: 20px;
            background: var(--pink);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .login-error-icon svg {
            width: 12px;
            height: 12px;
            color: #fff;
        }

        .login-error ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .login-error li {
            font-size: 13px;
            color: rgba(255,255,255,0.7);
            line-height: 1.6;
        }

        /* ===== FOOTER STRIP ===== */
        .login-footer {
            margin-top: 36px;
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .login-footer a {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 12px;
            font-weight: 700;
            font-style: italic;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            text-decoration: none;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .login-footer a:hover {
            color: rgba(255,255,255,0.7);
        }

        .login-footer a svg {
            width: 14px;
            height: 14px;
        }

        .login-footer-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
        }

        .login-footer-row a {
            font-size: 11px;
            letter-spacing: 1.5px;
        }

        .login-footer-sep {
            width: 1px;
            height: 12px;
            background: rgba(255,255,255,0.12);
        }

        @media (max-width: 640px) {
            .login-bg::after { border-width: 0 80px 80px 0; }
        }

        @media (max-width: 480px) {
            .login-card { padding: 32px 20px; }
            .login-brand { margin-bottom: 36px; }
            .login-brand img { height: 40px !important; }
            .login-title { font-size: 28px; }
            .login-subtitle { font-size: 11px; margin-bottom: 28px; }
            .form-group { margin-bottom: 18px; }
            .login-submit { padding: 13px 24px; font-size: 13px; }
            .login-footer { margin-top: 28px; }
        }

        @media (max-width: 380px) {
            .login-wrap { padding: 16px; }
            .login-card { padding: 24px 16px; }
            .login-brand img { height: 34px !important; }
            .login-title { font-size: 24px; }
            .login-subtitle { font-size: 10px; }
            .form-input { padding: 11px 14px 11px 40px; font-size: 13px; }
            .login-submit { padding: 12px 20px; font-size: 12px; }
            .form-options { flex-direction: column; align-items: flex-start; gap: 12px; }
        }
    </style>
</head>
<body>

    <!-- Background atmosphere -->
    <div class="login-bg"></div>

    <div class="login-wrap">

        <div class="login-box">

            <!-- Brand -->
            <a href="{{ route('home') }}" class="login-brand" style="flex-direction:column;gap:0;">
                <img src="/assets/01-logo-suryapainting18.png" alt="SuryaPainting18" style="height:56px;width:auto;">
            </a>

            <!-- Login Card -->
            <div class="login-card">

                <h1 class="login-title">Masuk Admin</h1>
                <p class="login-subtitle">Gunakan akun admin terdaftar untuk mengelola pesanan.</p>

                <!-- Validation Errors -->
                @if($errors->any())
                    <div class="login-error">
                        <div class="login-error-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </div>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">Alamat Email</label>
                        <div class="form-input-wrap">
                            <div class="form-input-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                </svg>
                            </div>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                class="form-input"
                                placeholder="nama@email.com"
                                required
                                autofocus
                            >
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="form-input-wrap">
                            <div class="form-input-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </div>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-input"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="form-options">
                        <label class="form-check-label">
                            <input type="checkbox" name="remember">
                            <span>Ingat saya</span>
                        </label>
                        <a href="{{ route('admin.forgot-password') }}" class="form-back-link">Lupa Password?</a>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="login-submit">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/>
                        </svg>
                        Masuk ke Panel Admin
                    </button>
                </form>

                <!-- Footer link -->
                <div class="login-footer">
                    <a href="{{ route('home') }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                        Kembali ke Beranda
                    </a>
                    <div class="login-footer-row">
                        <a href="{{ route('admin.register') }}">Daftar Admin</a>
                        <span class="login-footer-sep"></span>
                        <a href="{{ route('admin.forgot-password') }}">Lupa Password</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
