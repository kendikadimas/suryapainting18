<style>
    .admin-nav{position:sticky;top:0;z-index:40;background:rgba(10,10,10,0.97);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,0.06)}
    .admin-nav-inner{max-width:1280px;margin:0 auto;padding:0 24px;height:68px;display:flex;align-items:center;justify-content:space-between}
    @media(min-width:1024px){.admin-nav-inner{padding:0 48px}}
    .admin-nav-brand{display:flex;align-items:center;gap:12px;text-decoration:none}
    .admin-nav-icon{width:36px;height:36px;background:var(--pink);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .admin-nav-icon svg{width:18px;height:18px;color:#fff}
    .admin-nav-name{font-family:'Barlow Condensed',sans-serif;font-size:22px;font-weight:800;letter-spacing:2px;text-transform:uppercase;color:#fff}
    .admin-nav-name span{color:var(--pink)}
    .admin-nav-badge{font-family:'Inter',sans-serif;font-size:9px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:var(--gray);background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);padding:4px 10px;margin-left:10px;line-height:1}
    .admin-nav-right{display:flex;align-items:center;gap:16px}
    .admin-nav-status{display:none;align-items:center;gap:8px;font-size:11px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,0.5)}
    @media(min-width:640px){.admin-nav-status{display:flex}}
    .admin-nav-dot{width:7px;height:7px;background:var(--pink);border-radius:50%;animation:pulse-dot 2s ease-in-out infinite}
    @keyframes pulse-dot{0%,100%{opacity:1}50%{opacity:0.3}}
    .btn-ghost-admin{display:inline-flex;align-items:center;gap:8px;background:transparent;color:rgba(255,255,255,0.6);font-family:'Barlow Condensed',sans-serif;font-size:11px;font-weight:700;font-style:italic;letter-spacing:2px;text-transform:uppercase;padding:10px 18px;border:1px solid rgba(255,255,255,0.12);text-decoration:none;transition:border-color 0.25s,color 0.2s;cursor:pointer}
    .btn-ghost-admin:hover{border-color:rgba(255,255,255,0.4);color:#fff}

    .sidebar-trigger{display:none;background:transparent;border:none;color:rgba(255,255,255,0.5);cursor:pointer;padding:6px;align-items:center}
    .sidebar-trigger:hover{color:#fff}
    .sidebar-link{display:flex;align-items:center;gap:12px;padding:11px 14px;color:rgba(255,255,255,0.55);text-decoration:none;font-family:'Inter',sans-serif;font-size:13px;font-weight:500;border-radius:8px;border-left:3px solid transparent;transition:all 0.15s}
    .sidebar-link:hover{color:#fff;background:rgba(255,255,255,0.04)}
    .sidebar-logout{display:flex;align-items:center;gap:12px;width:100%;padding:12px 16px;color:rgba(255,255,255,0.4);background:transparent;border:1px solid rgba(255,255,255,0.08);border-radius:10px;font-family:'Inter',sans-serif;font-size:13px;font-weight:500;cursor:pointer;transition:all 0.15s}
    .sidebar-logout:hover{color:#fff;border-color:rgba(238,20,177,0.4);background:rgba(238,20,177,0.06)}
    @media(max-width:640px){.sidebar-trigger{display:flex}.admin-nav-desktop{display:none!important}.admin-nav-inner{gap:8px}}
</style>
<!-- Sidebar Overlay -->
<div x-show="sidebarOpen" x-transition:opacity.duration.200ms class="fixed inset-0 z-40 bg-black/70 backdrop-blur-sm" @click="sidebarOpen = false" style="display:none;"></div>
<!-- Sidebar -->
<div x-show="sidebarOpen" x-transition:enter="transition duration-250 ease-out" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition duration-200 ease-in" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="fixed top-0 left-0 z-50 w-72 h-full bg-[#0b0b0b] border-r border-white/8 flex flex-col shadow-2xl" style="display:none;">
    <div class="flex items-center gap-3 px-5 h-[60px] border-b border-white/6 flex-shrink-0">
        <img src="/assets/01-logo-suryapainting18.png" alt="SP18" style="height:28px;width:auto;">
        <span class="text-sm font-semibold text-white/60 tracking-wider uppercase" style="font-family:'Inter',sans-serif;letter-spacing:2px;">Menu</span>
        <button @click="sidebarOpen = false" class="ml-auto text-white/30 hover:text-white p-1.5"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <div class="flex-1 overflow-y-auto py-3 px-3 flex flex-col gap-0.5">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link" @if(request()->routeIs('admin.dashboard')) style="color:#fff;background:rgba(238,20,177,0.06);border-left:3px solid var(--pink);" @endif>
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>
        @if(Auth::user()->isSuperAdmin())
        <a href="{{ route('admin.add-admin') }}" class="sidebar-link" @if(request()->routeIs('admin.add-admin')) style="color:#fff;background:rgba(238,20,177,0.06);border-left:3px solid var(--pink);" @endif>
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
            Tambah Admin
        </a>
        <a href="{{ route('admin.list-admin') }}" class="sidebar-link" @if(request()->routeIs('admin.list-admin')) style="color:#fff;background:rgba(238,20,177,0.06);border-left:3px solid var(--pink);" @endif>
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            Daftar Admin
        </a>
        @endif
        <a href="{{ route('home') }}" target="_blank" rel="noopener" class="sidebar-link">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            Lihat Website
        </a>
    </div>
    <div class="px-4 py-4 border-t border-white/6">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-logout">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Keluar
            </button>
        </form>
    </div>
</div>

<nav class="admin-nav">
    <div class="admin-nav-inner">
        <button @click="sidebarOpen = true" class="sidebar-trigger" aria-label="Menu">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
        <a href="{{ route('home') }}" class="admin-nav-brand">
            <img src="/assets/01-logo-suryapainting18.png" alt="SuryaPainting18" style="height:32px;width:auto;">
        </a>
        <div class="admin-nav-right">
            <span class="admin-nav-status"><span class="admin-nav-dot"></span>Admin Aktif</span>
            <a href="{{ route('home') }}" target="_blank" rel="noopener" class="btn-ghost-admin admin-nav-desktop">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                Website
            </a>
            @if(Auth::user()->isSuperAdmin())
            <a href="{{ route('admin.list-admin') }}" class="btn-ghost-admin admin-nav-desktop">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Admin
            </a>
            <a href="{{ route('admin.add-admin') }}" class="btn-ghost-admin admin-nav-desktop">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                Tambah Admin
            </a>
            @endif
            <form action="{{ route('admin.logout') }}" method="POST" class="admin-nav-desktop">@csrf<button type="submit" class="btn-ghost-admin"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Keluar</button></form>
        </div>
    </div>
</nav>
