<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin | SuryaPainting18</title>
    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <link rel="apple-touch-icon" href="/assets/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,400;0,600;0,700;0,800;0,900;1,700;1,800;1,900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root{--pink:#ee14b1;--pink-dark:#c0108f;--dark:#0d0d0d;--gray:#888;}
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Inter',sans-serif;background-color:var(--dark);color:#fff;min-height:100vh;display:flex;flex-direction:column;overflow-x:hidden}
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
        .admin-main{flex:1;max-width:1280px;width:100%;margin:0 auto;padding:40px 24px}
        @media(min-width:1024px){.admin-main{padding:48px}}
        .admin-header{display:flex;flex-wrap:wrap;align-items:flex-start;justify-content:space-between;gap:24px;margin-bottom:40px}
        .admin-header-label{font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--pink);display:flex;align-items:center;gap:12px;margin-bottom:12px}
        .admin-header-label-line{width:36px;height:2px;background:var(--pink)}
        .admin-heading{font-family:'Barlow Condensed',sans-serif;font-size:clamp(28px,4vw,44px);font-weight:900;font-style:italic;text-transform:uppercase;color:#fff;line-height:1;letter-spacing:0.5px}
        .admin-subheading{font-size:13px;color:var(--gray);margin-top:8px}
        .btn-red-admin{display:inline-flex;align-items:center;gap:10px;background:var(--pink);color:#fff;font-family:'Barlow Condensed',sans-serif;font-size:13px;font-weight:800;font-style:italic;letter-spacing:2.5px;text-transform:uppercase;padding:14px 28px;border:2px solid var(--pink);transition:background 0.25s,transform 0.2s;cursor:pointer;text-decoration:none}
        .btn-red-admin:hover{background:var(--pink-dark);border-color:var(--pink-dark);transform:translateY(-1px)}
        .btn-ghost-admin{display:inline-flex;align-items:center;gap:8px;background:transparent;color:rgba(255,255,255,0.6);font-family:'Barlow Condensed',sans-serif;font-size:11px;font-weight:700;font-style:italic;letter-spacing:2px;text-transform:uppercase;padding:10px 18px;border:1px solid rgba(255,255,255,0.12);text-decoration:none;transition:border-color 0.25s,color 0.2s;cursor:pointer}
        .btn-ghost-admin:hover{border-color:rgba(255,255,255,0.4);color:#fff}
        .alert-success{background:rgba(3,144,74,0.1);border:1px solid rgba(3,144,74,0.25);border-left:3px solid #03904a;padding:16px 20px;margin-bottom:28px;display:flex;align-items:flex-start;gap:12px;position:relative}
        .alert-success-icon{width:20px;height:20px;background:#03904a;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
        .alert-success-icon svg{width:12px;height:12px;color:#fff}
        .alert-success-title{font-weight:700;color:#fff;margin-bottom:2px}
        .alert-success-text{font-size:13px;color:rgba(255,255,255,0.7)}
        .alert-close{position:absolute;top:12px;right:14px;background:none;border:none;color:rgba(255,255,255,0.3);cursor:pointer;padding:4px;transition:color 0.2s}
        .alert-close:hover{color:#fff}
        .filter-bar{background:#111;border:1px solid rgba(255,255,255,0.08);padding:20px 24px;margin-bottom:4px;display:flex;flex-wrap:wrap;gap:12px;align-items:center;justify-content:space-between}
        .filter-form{display:flex;gap:8px;width:100%}
        @media(min-width:768px){.filter-form{width:auto;flex-grow:1;max-width:480px}}
        .filter-input-wrap{flex:1;position:relative}
        .filter-input-icon{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#555;display:flex}
        .filter-input-icon svg{width:14px;height:14px}
        .filter-input{width:100%;padding:10px 14px 10px 38px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:13px;outline:none;transition:border-color 0.25s}
        .filter-input:focus{border-color:var(--pink)}
        .filter-input::placeholder{color:#444;font-weight:400}
        .filter-submit{display:inline-flex;align-items:center;justify-content:center;background:transparent;border:1px solid rgba(255,255,255,0.12);color:rgba(255,255,255,0.6);font-family:'Barlow Condensed',sans-serif;font-size:11px;font-weight:700;font-style:italic;letter-spacing:2px;text-transform:uppercase;padding:10px 18px;cursor:pointer;transition:border-color 0.25s,color 0.2s;white-space:nowrap}
        .filter-submit:hover{border-color:rgba(255,255,255,0.4);color:#fff}
        .filter-reset{display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;background:transparent;border:1px solid rgba(255,255,255,0.08);color:#555;text-decoration:none;transition:border-color 0.2s,color 0.2s}
        .filter-reset:hover{border-color:rgba(255,255,255,0.2);color:#fff}
        .filter-reset svg{width:14px;height:14px}
        .filter-count{font-size:12px;color:var(--gray);font-weight:500}
        .filter-count strong{color:#fff;font-weight:700}
        .orders-table-wrap{background:#111;border:1px solid rgba(255,255,255,0.08);overflow:hidden}
        .orders-empty{padding:60px 24px;text-align:center}
        .orders-empty-icon{width:56px;height:56px;border:1px solid rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 20px}
        .orders-empty-icon svg{width:24px;height:24px;color:#444}
        .orders-empty h3{font-family:'Barlow Condensed',sans-serif;font-size:18px;font-weight:800;font-style:italic;text-transform:uppercase;color:rgba(255,255,255,0.5);margin-bottom:6px}
        .orders-empty p{font-size:13px;color:#555;max-width:360px;margin:0 auto}
        .orders-table{width:100%;border-collapse:collapse;text-align:left}
        .orders-table thead{border-bottom:1px solid rgba(255,255,255,0.08);background:rgba(255,255,255,0.02)}
        .orders-table th{padding:14px 20px;font-size:9px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#555}
        .orders-table th:first-child{padding-left:24px}
        .orders-table th:last-child{padding-right:24px;text-align:right}
        .orders-table td{padding:18px 20px;border-bottom:1px solid rgba(255,255,255,0.04)}
        .orders-table td:first-child{padding-left:24px}
        .orders-table td:last-child{padding-right:24px;text-align:right}
        .orders-table tbody tr{transition:background 0.2s}
        .orders-table tbody tr:hover{background:rgba(255,255,255,0.02)}
        .order-code{font-family:'Barlow Condensed',sans-serif;font-size:14px;font-weight:800;letter-spacing:2px;text-transform:uppercase;color:#fff;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);padding:4px 10px;display:inline-block}
        .order-customer-name{font-weight:700;font-size:13px;color:#fff}
        .order-date{font-size:11px;color:#555;margin-top:2px}
        .order-product{font-size:13px;font-weight:600;color:rgba(255,255,255,0.7)}
        .status-badge{display:inline-block;font-size:9px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;padding:5px 12px;border:1px solid}
        .status-badge--pending{color:#f6e500;border-color:rgba(246,229,0,0.25);background:rgba(246,229,0,0.08)}
        .status-badge--processing{color:#4c98b9;border-color:rgba(76,152,185,0.25);background:rgba(76,152,185,0.08)}
        .status-badge--completed{color:#03904a;border-color:rgba(3,144,74,0.25);background:rgba(3,144,74,0.08)}
        .status-badge--cancelled{color:var(--pink);border-color:rgba(238,20,177,0.25);background:rgba(238,20,177,0.08)}
        .timeline-count{font-size:11px;font-weight:600;color:var(--gray);display:inline-flex;align-items:center;gap:6px}
        .timeline-count-dot{width:6px;height:6px;background:var(--pink);border-radius:50%}
        .action-manage{display:inline-flex;align-items:center;gap:6px;background:transparent;border:1px solid rgba(238,20,177,0.4);color:var(--pink);font-family:'Barlow Condensed',sans-serif;font-size:11px;font-weight:700;font-style:italic;letter-spacing:2px;text-transform:uppercase;padding:8px 14px;text-decoration:none;transition:background 0.25s,color 0.2s,border-color 0.2s;cursor:pointer}
        .action-manage:hover{background:var(--pink);color:#fff;border-color:var(--pink)}
        .action-manage svg{width:13px;height:13px}
        .action-delete{display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;background:transparent;border:1px solid rgba(255,255,255,0.08);color:#555;cursor:pointer;transition:border-color 0.2s,color 0.2s,background 0.2s}
        .action-delete:hover{border-color:var(--pink);color:var(--pink);background:rgba(238,20,177,0.08)}
        .action-delete svg{width:13px;height:13px}
        .action-wa{display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;background:transparent;border:1px solid rgba(37,211,102,0.3);color:#25d366;cursor:pointer;transition:border-color 0.2s,background 0.2s;text-decoration:none;flex-shrink:0}
        .action-wa:hover{border-color:#25d366;background:rgba(37,211,102,0.1)}
        .action-wa svg{width:14px;height:14px}
        .mobile-order-card{padding:24px;border-bottom:1px solid rgba(255,255,255,0.06)}
        .mobile-order-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}
        .mobile-order-row{display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid rgba(255,255,255,0.04)}
        .mobile-order-row:last-of-type{border-bottom:none}
        .mobile-order-label{font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:var(--gray);margin-bottom:0}
        .mobile-order-footer{display:flex;align-items:center;justify-content:space-between;padding-top:14px;border-top:1px solid rgba(255,255,255,0.06)}
        .modal-overlay{position:fixed;inset:0;z-index:50;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,0.88);padding:24px}
        .modal-card{width:100%;max-width:460px;background:#111;border:1px solid rgba(255,255,255,0.1);position:relative;overflow:hidden}
        .modal-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:var(--pink)}
        .modal-header{display:flex;align-items:center;justify-content:space-between;padding:20px 24px;border-bottom:1px solid rgba(255,255,255,0.06)}
        .modal-title{font-family:'Barlow Condensed',sans-serif;font-size:20px;font-weight:800;font-style:italic;text-transform:uppercase;color:#fff;display:flex;align-items:center;gap:10px}
        .modal-title svg{width:18px;height:18px;color:var(--pink)}
        .modal-close{background:none;border:none;color:rgba(255,255,255,0.3);cursor:pointer;padding:4px;transition:color 0.2s}
        .modal-close:hover{color:#fff}
        .modal-close svg{width:20px;height:20px}
        .modal-body{padding:24px}
        .modal-field{margin-bottom:20px}
        .modal-field label{display:block;font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#888;margin-bottom:8px}
        .modal-field input{width:100%;padding:12px 16px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:14px;outline:none;transition:border-color 0.25s}
        .modal-field input:focus{border-color:var(--pink)}
        .modal-field input::placeholder{color:#444}
        .modal-actions{display:flex;gap:8px;padding-top:8px}
        .modal-btn-cancel{flex:1;background:transparent;border:1px solid rgba(255,255,255,0.12);color:rgba(255,255,255,0.6);font-family:'Barlow Condensed',sans-serif;font-size:12px;font-weight:700;font-style:italic;letter-spacing:2px;text-transform:uppercase;padding:12px 20px;cursor:pointer;transition:border-color 0.2s,color 0.2s}
        .modal-btn-cancel:hover{border-color:rgba(255,255,255,0.3);color:#fff}
        .modal-btn-submit{flex:1;background:var(--pink);border:2px solid var(--pink);color:#fff;font-family:'Barlow Condensed',sans-serif;font-size:12px;font-weight:800;font-style:italic;letter-spacing:2px;text-transform:uppercase;padding:12px 20px;cursor:pointer;transition:background 0.25s,transform 0.15s}
        .modal-btn-submit:hover{background:var(--pink-dark);border-color:var(--pink-dark);transform:translateY(-1px)}
        .admin-footer{border-top:1px solid rgba(255,255,255,0.06);background:#070707;padding:24px 0}
        .admin-footer-inner{max-width:1280px;margin:0 auto;padding:0 24px;text-align:center}
        @media(min-width:1024px){.admin-footer-inner{padding:0 48px}}
        .admin-footer p{font-size:11px;color:#444;letter-spacing:1px}
        .admin-pagination{display:flex;justify-content:center;gap:4px;margin-top:32px}
        .admin-pagination a,.admin-pagination span{display:inline-flex;align-items:center;justify-content:center;min-width:36px;height:36px;padding:0 12px;font-family:'Inter',sans-serif;font-size:12px;font-weight:600;color:rgba(255,255,255,0.5);background:transparent;border:1px solid rgba(255,255,255,0.08);text-decoration:none;transition:border-color 0.2s,color 0.2s,background 0.2s}
        .admin-pagination a:hover{border-color:rgba(255,255,255,0.2);color:#fff}
        .admin-pagination .active{background:var(--pink);border-color:var(--pink);color:#fff;font-weight:700}
        @media(max-width:768px){.orders-table{display:none}.mobile-cards{display:block!important}}
        @media(min-width:769px){.mobile-cards{display:none!important}}
        @media(max-width:640px){
            .admin-nav-inner{padding:0 16px;height:60px}
            .admin-main{padding:24px 16px}
            .admin-header{gap:16px;margin-bottom:28px}
            .admin-heading{font-size:26px}
            .admin-subheading{font-size:12px}
            .btn-red-admin{padding:12px 20px;font-size:12px;width:100%;justify-content:center}
            .filter-bar{padding:16px}
            .filter-form{flex-wrap:wrap}
            .filter-input-wrap{min-width:100%}
            .filter-submit{flex:1}
            .orders-table-wrap{margin:0 -16px;border-radius:0}
            .mobile-order-card{padding:20px 16px}
            .mobile-order-footer{flex-wrap:wrap;gap:12px}
            .mobile-order-footer .timeline-count{width:100%}
            .admin-pagination{gap:2px;flex-wrap:wrap}
            .admin-pagination a,.admin-pagination span{min-width:32px;height:32px;font-size:11px;padding:0 8px}
        }
        @media(max-width:400px){
            .mobile-order-card{padding:16px 12px}
            .mobile-order-header{flex-direction:column;align-items:flex-start;gap:8px}
            .admin-header-label{font-size:9px;letter-spacing:2px}
            .admin-heading{font-size:22px}
        }
    </style>
</head>
<body x-data="{ orderModalOpen: false }">
    <nav class="admin-nav">
        <div class="admin-nav-inner">
            <a href="{{ route('home') }}" class="admin-nav-brand">
                <img src="/assets/01-logo-suryapainting18.png" alt="SuryaPainting18" style="height:32px;width:auto;">
                <span class="admin-nav-badge">Panel Admin</span>
            </a>
            <div class="admin-nav-right">
                <span class="admin-nav-status"><span class="admin-nav-dot"></span>Admin Aktif</span>
                <form action="{{ route('admin.logout') }}" method="POST">@csrf<button type="submit" class="btn-ghost-admin"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Keluar</button></form>
            </div>
        </div>
    </nav>
    <main class="admin-main">
        <div class="admin-header">
            <div>
                <div class="admin-header-label"><span class="admin-header-label-line"></span>Kelola Pesanan</div>
                <h1 class="admin-heading">Daftar Pesanan</h1>
                <p class="admin-subheading">Kelola status progres pengerjaan untuk setiap pesanan pelanggan.</p>
            </div>
            <button @click="orderModalOpen = true" class="btn-red-admin">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Buat Pesanan Baru
            </button>
        </div>
        @if(session('success'))
        <div class="alert-success" x-data="{ show: true }" x-show="show">
            <div class="alert-success-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
            <div><div class="alert-success-title">Berhasil!</div><div class="alert-success-text">{{ session('success') }}</div></div>
            <button @click="show = false" class="alert-close"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        @endif
        <div class="filter-bar">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="filter-form">
                <div class="filter-input-wrap">
                    <div class="filter-input-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg></div>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari kode, nama, atau produk..." class="filter-input">
                </div>
                <button type="submit" class="filter-submit">Filter</button>
                @if($search)<a href="{{ route('admin.dashboard') }}" class="filter-reset"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg></a>@endif
            </form>
            <div class="filter-count"><strong>{{ $orders->firstItem() ?? 0 }}</strong>&#8211;<strong>{{ $orders->lastItem() ?? 0 }}</strong> dari <strong>{{ $orders->total() }}</strong> pesanan</div>
        </div>
        <div class="orders-table-wrap">
            @if($orders->isEmpty())
            <div class="orders-empty">
                <div class="orders-empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="21 8 21 21 3 21 3 8"/><path d="M1 3h22l-2 5H3l-2-5z"/><path d="M9 12h6"/></svg></div>
                <h3>Tidak ada pesanan</h3>
                <p>Mulai buat pesanan baru untuk melacak progress pengerjaan produk Anda.</p>
            </div>
            @else
            <div class="hidden md:block">
                <table class="orders-table">
                    <thead><tr><th>Kode Order</th><th>Pelanggan</th><th>Produk</th><th>Status</th><th style="text-align:center;">Update</th><th style="text-align:right;">Aksi</th></tr></thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td><span class="order-code">{{ $order->order_code }}</span></td>
                            <td>
                                <div class="order-customer-name">{{ $order->customer_name }}</div>
                                @if($order->customer_phone)
                                    <div class="order-date" style="color:#25d366;">{{ $order->customer_phone }}</div>
                                @endif
                                <div class="order-date">Dibuat: {{ $order->created_at->format('d/m/Y H:i') }}</div>
                            </td>
                            <td><span class="order-product">{{ $order->product_name }}</span></td>
                            <td>
                                @if($order->status === 'Pending')<span class="status-badge status-badge--pending">Menunggu</span>
                                @elseif($order->status === 'Processing')<span class="status-badge status-badge--processing">Diproses</span>
                                @elseif($order->status === 'Completed')<span class="status-badge status-badge--completed">Selesai</span>
                                @elseif($order->status === 'Cancelled')<span class="status-badge status-badge--cancelled">Dibatalkan</span>
                                @endif
                            </td>
                            <td style="text-align:center;"><span class="timeline-count"><span class="timeline-count-dot"></span>{{ $order->timeline_count }} Update</span></td>
                            <td style="text-align:right;">
                                @if($order->customer_phone)
                                    @php
                                        $waPhone = preg_replace('/[^0-9]/', '', $order->customer_phone);
                                        if (str_starts_with($waPhone, '0')) $waPhone = '62' . substr($waPhone, 1);
                                        $waMsg = urlencode("Halo Kak *{$order->customer_name}*, pesanan Anda telah terdaftar.\n\nKode Pesanan: *{$order->order_code}*\nProduk: {$order->product_name}\n\nGunakan kode tersebut untuk melacak progres pengerjaan di website kami:\nhttps://suryapainting18indonesia.com\n\nTerima kasih telah mempercayakan pengerjaan kepada SuryaPainting18 🙏");
                                    @endphp
                                    <a href="https://wa.me/{{ $waPhone }}?text={{ $waMsg }}" target="_blank" rel="noopener" class="action-wa" title="Kirim kode via WhatsApp">
                                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    </a>
                                @endif
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="action-manage"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>Kelola</a>
                                <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini beserta seluruh riwayat progressnya?')">@csrf @method('DELETE')<button type="submit" class="action-delete"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button></form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mobile-cards">
                @foreach($orders as $order)
                <div class="mobile-order-card">
                    <div class="mobile-order-header">
                        <span class="order-code">{{ $order->order_code }}</span>
                        @if($order->status === 'Pending')<span class="status-badge status-badge--pending">Menunggu</span>
                        @elseif($order->status === 'Processing')<span class="status-badge status-badge--processing">Diproses</span>
                        @elseif($order->status === 'Completed')<span class="status-badge status-badge--completed">Selesai</span>
                        @elseif($order->status === 'Cancelled')<span class="status-badge status-badge--cancelled">Dibatalkan</span>
                        @endif
                    </div>
                    <div class="mobile-order-row"><div class="mobile-order-label">Pelanggan</div><div class="order-customer-name">{{ $order->customer_name }}</div></div>
                    <div class="mobile-order-row"><div class="mobile-order-label">Produk / Jasa</div><div class="order-product">{{ $order->product_name }}</div></div>
                    <div class="mobile-order-footer">
                        <span class="timeline-count"><span class="timeline-count-dot"></span>{{ $order->timeline_count }} Update</span>
                        <div style="display:flex;gap:8px;align-items:center;">
                            @if($order->customer_phone)
                                @php
                                    $waPhone = preg_replace('/[^0-9]/', '', $order->customer_phone);
                                    if (str_starts_with($waPhone, '0')) $waPhone = '62' . substr($waPhone, 1);
                                    $waMsg = urlencode("Halo *{$order->customer_name}*, pesanan Anda telah terdaftar.\n\nKode Pesanan: *{$order->order_code}*\nProduk: {$order->product_name}\n\nGunakan kode tersebut untuk melacak progres pengerjaan di website kami.");
                                @endphp
                                <a href="https://wa.me/{{ $waPhone }}?text={{ $waMsg }}" target="_blank" rel="noopener" class="action-wa" title="Kirim kode via WA" style="width:30px;height:30px;">
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </a>
                            @endif
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="action-manage" style="padding:6px 12px;">Kelola</a>
                            <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesanan ini?')">@csrf @method('DELETE')<button type="submit" class="action-delete" style="width:30px;height:30px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button></form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="admin-pagination">{{ $orders->links() }}</div>
    </main>
    <div x-show="orderModalOpen" x-transition:opacity.duration.300ms class="fixed inset-0 z-50 flex items-center justify-center" style="display:none;background:rgba(0,0,0,0.88);padding:24px" @click="orderModalOpen = false" @keydown.escape.window="orderModalOpen = false" x-cloak>
        <div class="modal-card" @click.stop>
            <div class="modal-header">
                <div class="modal-title"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>Buat Pesanan Baru</div>
                <button @click="orderModalOpen = false" class="modal-close"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
            </div>
            <form action="{{ route('admin.orders.store') }}" method="POST" class="modal-body">
                @csrf
                <div class="modal-field"><label for="customer_name">Nama Pelanggan</label><input type="text" name="customer_name" id="customer_name" placeholder="Contoh: Budi Santoso" required></div>
                <div class="modal-field"><label for="customer_phone">No. HP / WhatsApp</label><input type="tel" name="customer_phone" id="customer_phone" placeholder="Contoh: 08123456789"></div>
                <div class="modal-field"><label for="product_name">Produk / Jasa</label><input type="text" name="product_name" id="product_name" placeholder="Contoh: Cat Velg Motor Beat" required></div>
                <div class="modal-actions">
                    <button type="button" @click="orderModalOpen = false" class="modal-btn-cancel">Batal</button>
                    <button type="submit" class="modal-btn-submit">Simpan Order</button>
                </div>
            </form>
        </div>
    </div>
    <footer class="admin-footer"><div class="admin-footer-inner"><p>&copy; {{ date('Y') }} SuryaPainting18. Hak Cipta Dilindungi.</p></div></footer>
</body>
</html>
