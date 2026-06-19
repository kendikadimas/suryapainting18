<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Admin | SuryaPainting18</title>
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
        .btn-ghost-admin{display:inline-flex;align-items:center;gap:8px;background:transparent;color:rgba(255,255,255,0.6);font-family:'Barlow Condensed',sans-serif;font-size:11px;font-weight:700;font-style:italic;letter-spacing:2px;text-transform:uppercase;padding:10px 18px;border:1px solid rgba(255,255,255,0.12);text-decoration:none;transition:border-color 0.25s,color 0.2s;cursor:pointer}
        .btn-ghost-admin:hover{border-color:rgba(255,255,255,0.4);color:#fff}
        .admin-main{flex:1;max-width:800px;width:100%;margin:0 auto;padding:40px 24px}
        @media(min-width:1024px){.admin-main{padding:48px}}
        @media(max-width:640px){.admin-nav-inner{padding:0 14px;height:56px}.admin-main{padding:20px 16px}}
        .page-header{margin-bottom:32px}
        .page-header-label{font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--pink);display:flex;align-items:center;gap:12px;margin-bottom:10px}
        .page-header-label-line{width:36px;height:2px;background:var(--pink)}
        .page-heading{font-family:'Barlow Condensed',sans-serif;font-size:clamp(24px,4vw,40px);font-weight:900;font-style:italic;text-transform:uppercase;color:#fff;line-height:1}
        .page-subheading{font-size:13px;color:var(--gray);margin-top:6px}
        .alert-success{background:rgba(3,144,74,0.1);border:1px solid rgba(3,144,74,0.25);border-left:3px solid #03904a;padding:16px 20px;margin-bottom:24px;display:flex;align-items:flex-start;gap:12px;position:relative}
        .alert-success-icon{width:20px;height:20px;background:#03904a;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
        .alert-success-icon svg{width:12px;height:12px;color:#fff}
        .alert-success-title{font-weight:700;color:#fff;margin-bottom:2px}
        .alert-success-text{font-size:13px;color:rgba(255,255,255,0.7)}
        .alert-close{position:absolute;top:12px;right:14px;background:none;border:none;color:rgba(255,255,255,0.3);cursor:pointer;padding:4px;transition:color 0.2s}
        .alert-close:hover{color:#fff}
        .alert-error{background:rgba(238,20,177,0.1);border:1px solid rgba(238,20,177,0.25);border-left:3px solid var(--pink);padding:16px 20px;margin-bottom:24px;display:flex;align-items:flex-start;gap:12px}
        .alert-error-icon{width:20px;height:20px;background:var(--pink);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .alert-error-icon svg{width:12px;height:12px;color:#fff}
        .alert-error p{font-size:13px;color:rgba(255,255,255,0.7)}
        .admin-card{background:#111;border:1px solid rgba(255,255,255,0.08);overflow:hidden}
        @media(max-width:640px){.admin-card{margin:0 -16px;border-radius:0;border-left:none;border-right:none}}
        .admin-table{width:100%;border-collapse:collapse;text-align:left}
        .admin-table th{padding:12px 16px;font-size:9px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#555;border-bottom:1px solid rgba(255,255,255,0.06);background:rgba(255,255,255,0.02)}
        .admin-table td{padding:14px 16px;border-bottom:1px solid rgba(255,255,255,0.04);font-size:13px}
        .admin-table tbody tr{transition:background 0.2s}
        .admin-table tbody tr:hover{background:rgba(255,255,255,0.02)}
        .admin-table td:first-child,.admin-table th:first-child{padding-left:20px}
        .admin-table td:last-child,.admin-table th:last-child{padding-right:20px;text-align:right}
        .admin-name{font-weight:700;color:#fff}
        .admin-email{font-size:12px;color:var(--gray)}
        .admin-date{font-size:10px;color:#555}
        .badge-self{display:inline-block;font-size:8px;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:3px 8px;background:rgba(238,20,177,0.1);border:1px solid rgba(238,20,177,0.3);color:var(--pink)}
        .btn-delete-admin{display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;background:transparent;border:1px solid rgba(255,255,255,0.08);color:#555;cursor:pointer;transition:all 0.2s}
        .btn-delete-admin:hover{border-color:var(--pink);color:var(--pink);background:rgba(238,20,177,0.08)}
        .btn-delete-admin svg{width:13px;height:13px}
        .empty-state{padding:60px 24px;text-align:center}
        .empty-state svg{width:40px;height:40px;color:#444;margin-bottom:16px}
        .empty-state p{font-size:13px;color:#555}
        @media(max-width:640px){
            .admin-table td:first-child,.admin-table th:first-child{padding-left:14px}
            .admin-table td:last-child,.admin-table th:last-child{padding-right:14px}
            .admin-table td{padding:12px 10px;font-size:12px}
            .admin-table th{padding:10px;font-size:8px}
            .admin-email{font-size:11px}
        }
    </style>
</head>
<body>
    <nav class="admin-nav">
        <div class="admin-nav-inner">
            <a href="{{ route('admin.dashboard') }}" class="admin-nav-brand">
                <img src="/assets/01-logo-suryapainting18.png" alt="SuryaPainting18" style="height:32px;width:auto;">
            </a>
            <div>
                <a href="{{ route('admin.add-admin') }}" class="btn-ghost-admin" style="font-size:10px;padding:6px 12px;letter-spacing:1.5px;">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn-ghost-admin">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                    Dashboard
                </a>
            </div>
        </div>
    </nav>

    <main class="admin-main">
        <div class="page-header">
            <div class="page-header-label"><span class="page-header-label-line"></span>Manajemen Admin</div>
            <h1 class="page-heading">Daftar Admin</h1>
            <p class="page-subheading">{{ $admins->count() }} akun admin terdaftar.</p>
        </div>

        @if(session('success'))
        <div class="alert-success" x-data="{ show: true }" x-show="show">
            <div class="alert-success-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
            <div><div class="alert-success-title">Berhasil!</div><div class="alert-success-text">{{ session('success') }}</div></div>
            <button @click="show = false" class="alert-close"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert-error">
            <div class="alert-error-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></div>
            <p>{{ $errors->first() }}</p>
        </div>
        @endif

        <div class="admin-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="text-align:center;">Terdaftar</th>
                        <th style="text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                    <tr>
                        <td>
                            <div class="admin-name">{{ $admin->name }}</div>
                            @if($admin->id === Auth::id())
                                <span class="badge-self" style="margin-top:3px;">Anda</span>
                            @endif
                        </td>
                        <td><span class="admin-email">{{ $admin->email }}</span></td>
                        <td style="text-align:center;"><span class="admin-date">{{ $admin->created_at->format('d/m/Y') }}</span></td>
                        <td style="text-align:right;">
                            @if($admin->id !== Auth::id())
                                <form action="{{ route('admin.delete-admin', $admin->id) }}" method="POST" onsubmit="return confirm('Hapus admin {{ addslashes($admin->name) }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-delete-admin">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    </button>
                                </form>
                            @else
                                <span style="color:#444;font-size:10px;text-transform:uppercase;letter-spacing:1px;">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
