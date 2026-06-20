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
        body{font-family:'Inter',sans-serif;background-color:#0a0a0a;color:#fff;min-height:100vh;display:flex;flex-direction:column;overflow-x:hidden;background-image:radial-gradient(ellipse at 50% 0%,rgba(238,20,177,0.04) 0%,transparent 60%),radial-gradient(ellipse at 80% 100%,rgba(238,20,177,0.03) 0%,transparent 50%);background-attachment:fixed}

        .admin-main{flex:1;max-width:1280px;width:100%;margin:0 auto;padding:40px 24px}
        @media(min-width:1024px){.admin-main{padding:48px}}
        .admin-header{display:flex;flex-wrap:wrap;align-items:flex-start;justify-content:space-between;gap:24px;margin-bottom:40px}
        .admin-header-label{font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--pink);display:flex;align-items:center;gap:12px;margin-bottom:12px}
        .admin-header-label-line{width:36px;height:2px;background:var(--pink)}
        .admin-heading{font-family:'Barlow Condensed',sans-serif;font-size:clamp(28px,4vw,44px);font-weight:900;font-style:italic;text-transform:uppercase;color:#fff;line-height:1;letter-spacing:0.5px}
        .admin-subheading{font-size:13px;color:var(--gray);margin-top:8px}
        .btn-red-admin{display:inline-flex;align-items:center;gap:10px;background:var(--pink);color:#fff;font-family:'Barlow Condensed',sans-serif;font-size:13px;font-weight:800;font-style:italic;letter-spacing:2.5px;text-transform:uppercase;padding:14px 28px;border:2px solid var(--pink);transition:background 0.25s,transform 0.2s;cursor:pointer;text-decoration:none}
        .btn-red-admin:hover{background:var(--pink-dark);border-color:var(--pink-dark);transform:translateY(-1px)}

        .alert-success{background:rgba(3,144,74,0.1);border:1px solid rgba(3,144,74,0.25);border-left:3px solid #03904a;padding:16px 20px;margin-bottom:28px;display:flex;align-items:flex-start;gap:12px;position:relative}
        .alert-success-icon{width:20px;height:20px;background:#03904a;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
        .alert-success-icon svg{width:12px;height:12px;color:#fff}
        .alert-success-title{font-weight:700;color:#fff;margin-bottom:2px}
        .alert-success-text{font-size:13px;color:rgba(255,255,255,0.7)}
        .alert-close{position:absolute;top:12px;right:14px;background:none;border:none;color:rgba(255,255,255,0.3);cursor:pointer;padding:4px;transition:color 0.2s}
        .alert-close:hover{color:#fff}
        .filter-bar{background:#111;border:1px solid rgba(255,255,255,0.08);padding:14px 18px;margin-bottom:4px;display:flex;flex-wrap:wrap;gap:10px;align-items:center;justify-content:space-between}
        .filter-form{display:flex;gap:6px;width:100%}
        @media(min-width:768px){.filter-form{width:auto;flex-grow:1;max-width:400px}}
        .filter-input-wrap{flex:1;position:relative}
        .filter-input-icon{position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#555;display:flex}
        .filter-input-icon svg{width:13px;height:13px}
        .filter-input{width:100%;padding:8px 12px 8px 34px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:12px;outline:none;transition:border-color 0.25s}
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
        .orders-table th{padding:10px 16px;font-size:9px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#555}
        .orders-table th:first-child{padding-left:20px}
        .orders-table th:last-child{padding-right:20px;text-align:right}
        .orders-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,0.04)}
        .orders-table td:first-child{padding-left:20px}
        .orders-table td:last-child{padding-right:20px;text-align:right}
        .orders-table tbody tr{transition:background 0.2s}
        .orders-table tbody tr:hover{background:rgba(255,255,255,0.02)}
        .order-code{font-family:'Barlow Condensed',sans-serif;font-size:13px;font-weight:800;letter-spacing:1.5px;text-transform:uppercase;color:#fff;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);padding:3px 8px;display:inline-block}
        .order-customer-name{font-weight:700;font-size:13px;color:#fff}
        .order-date{font-size:10px;color:#555;margin-top:2px}
        .order-product{font-size:12px;font-weight:600;color:rgba(255,255,255,0.7)}
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
        .mobile-order-card{padding:14px;border-left:3px solid transparent;margin-bottom:6px;background:#111;position:relative}
        .mobile-order-card:not(:last-child)::after{content:'';position:absolute;bottom:-4px;left:12px;right:12px;height:1px;background:linear-gradient(to right,transparent,rgba(238,20,177,0.12),transparent)}
        .mobile-order-card--pending{border-left-color:#f6e500}
        .mobile-order-card--processing{border-left-color:#4c98b9}
        .mobile-order-card--completed{border-left-color:#03904a}
        .mobile-order-card--cancelled{border-left-color:var(--pink)}
        .mobile-order-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:12px}
        .mobile-order-code{font-family:'Barlow Condensed',sans-serif;font-size:15px;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#fff}
        .mobile-order-phone{font-size:11px;color:#25d366;font-weight:600;margin-top:2px}
        .mobile-order-row{display:flex;align-items:baseline;justify-content:space-between;padding:7px 0}
        .mobile-order-label{font-size:9px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--gray);flex-shrink:0;margin-right:16px}
        .mobile-order-value{font-size:12px;font-weight:600;color:#fff;text-align:right;line-height:1.4}
        .mobile-order-field{background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.07);padding:10px 12px;margin-bottom:5px;display:flex;align-items:baseline;justify-content:space-between}
        .mobile-order-field .mobile-order-label{min-width:70px;font-size:9px}
        .mobile-order-field .mobile-order-value{font-size:12px}
        .mobile-order-footer{display:flex;align-items:center;justify-content:space-between;padding-top:12px;margin-top:8px;border-top:1px solid rgba(255,255,255,0.06);gap:8px}
        .status-badge-mobile{display:inline-flex;align-items:center;gap:5px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:5px 10px;border:1px solid;white-space:nowrap}
        .modal-overlay{position:fixed;inset:0;z-index:50;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,0.88);padding:24px}
        .modal-card{width:100%;max-width:440px;max-height:85vh;background:#111;border:1px solid rgba(255,255,255,0.1);position:relative;overflow:hidden;display:flex;flex-direction:column}
        .modal-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:var(--pink);z-index:1}
        .modal-header{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid rgba(255,255,255,0.06);flex-shrink:0}
        .modal-title{font-family:'Barlow Condensed',sans-serif;font-size:20px;font-weight:800;font-style:italic;text-transform:uppercase;color:#fff;display:flex;align-items:center;gap:10px}
        .modal-title svg{width:18px;height:18px;color:var(--pink)}
        .modal-close{background:none;border:none;color:rgba(255,255,255,0.3);cursor:pointer;padding:4px;transition:color 0.2s}
        .modal-close:hover{color:#fff}
        .modal-close svg{width:20px;height:20px}
        .modal-body{padding:16px 20px;overflow-y:auto;flex:1}
        .modal-footer{padding:14px 20px;border-top:1px solid rgba(255,255,255,0.06);flex-shrink:0;display:flex;gap:8px}
        .modal-field{margin-bottom:14px}
        .modal-field label{display:block;font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#888;margin-bottom:8px}
        .modal-field input{width:100%;padding:12px 16px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:14px;outline:none;transition:border-color 0.25s}
        .modal-field input:focus{border-color:var(--pink)}
        .modal-field input::placeholder{color:#444}
        .modal-btn-cancel{flex:1;background:transparent;border:1px solid rgba(255,255,255,0.12);color:rgba(255,255,255,0.6);font-family:'Barlow Condensed',sans-serif;font-size:12px;font-weight:700;font-style:italic;letter-spacing:2px;text-transform:uppercase;padding:11px 18px;cursor:pointer;transition:border-color 0.2s,color 0.2s;text-align:center}
        .modal-btn-cancel:hover{border-color:rgba(255,255,255,0.3);color:#fff}
        .modal-btn-submit{flex:1;background:var(--pink);border:2px solid var(--pink);color:#fff;font-family:'Barlow Condensed',sans-serif;font-size:12px;font-weight:800;font-style:italic;letter-spacing:2px;text-transform:uppercase;padding:11px 18px;cursor:pointer;transition:background 0.25s,transform 0.15s}
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
            .admin-nav-inner{padding:0 14px;height:56px}
            .admin-main{padding:20px 16px}
            .admin-header{gap:14px;margin-bottom:24px}
            .admin-heading{font-size:24px}
            .admin-subheading{font-size:11px}
            .btn-red-admin{padding:12px 20px;font-size:12px;width:100%;justify-content:center}
            .filter-bar{padding:10px 12px;flex-direction:column;gap:8px;align-items:stretch}
            .filter-form{flex-wrap:wrap;max-width:100%}
            .filter-input-wrap{min-width:100%}
            .filter-input{padding:10px 12px 10px 34px;font-size:13px}
            .filter-submit{flex:1;font-size:12px;padding:10px 18px}
            .filter-count{font-size:11px;text-align:center}
            .orders-table-wrap{margin:0 -16px;border-radius:0}
            .mobile-cards{display:flex;flex-direction:column;gap:12px}
            .mobile-order-card{padding:16px 14px;background:#131313;border-left-width:4px;margin-bottom:0}
            .mobile-order-card:not(:last-child)::after{bottom:-7px;left:14px;right:14px;background:linear-gradient(to right,transparent,rgba(238,20,177,0.15),transparent)}
            .mobile-order-code{font-size:15px;letter-spacing:2px}
            .mobile-order-phone{font-size:12px;margin-top:3px}
            .mobile-order-header{margin-bottom:14px;gap:12px}
            .mobile-order-field{padding:10px 12px;margin-bottom:5px}
            .mobile-order-field .mobile-order-label{font-size:9px;min-width:70px}
            .mobile-order-field .mobile-order-value{font-size:13px}
            .mobile-order-footer{padding-top:12px;margin-top:10px;flex-wrap:wrap;gap:10px}
            .mobile-order-footer .timeline-count{width:100%;font-size:11px}
            .status-badge-mobile{font-size:10px;padding:6px 12px}
            .action-manage{font-size:11px;padding:8px 16px;letter-spacing:2px;min-height:36px;align-items:center}
            .action-delete{width:36px;height:36px}
            .action-wa{width:36px;height:36px}
            .admin-pagination{gap:3px;flex-wrap:wrap;margin-top:28px}
            .admin-pagination a,.admin-pagination span{min-width:36px;height:36px;font-size:12px;padding:0 10px}
            .order-code{font-size:12px;letter-spacing:1px;padding:3px 8px}
            .order-customer-name{font-size:12px}
            .order-product{font-size:12px}
            .modal-card{max-width:100%;max-height:90vh;margin:0}
            .modal-header{padding:14px 16px}
            .modal-body{padding:12px 16px}
            .modal-footer{padding:12px 16px;flex-direction:column-reverse;gap:6px}
            .modal-title{font-size:17px}
            .modal-btn-cancel{width:100%}
            .modal-btn-submit{width:100%}
            .modal-field label{font-size:9px;letter-spacing:1.5px;margin-bottom:6px}
            .modal-field input{font-size:13px;padding:10px 14px}
            .modal-field select{font-size:13px;padding:10px 14px}
        }
        @media(max-width:400px){
            .admin-main{padding:16px 12px}
            .orders-table-wrap{margin:0 -12px}
            .mobile-order-card{padding:14px 12px;margin-bottom:0}
            .mobile-order-card:not(:last-child)::after{bottom:-7px;left:10px;right:10px}
            .mobile-order-field{padding:8px 10px}
            .mobile-order-field .mobile-order-label{font-size:8px;min-width:60px}
            .mobile-order-field .mobile-order-value{font-size:12px}
            .mobile-order-header{flex-direction:column;align-items:flex-start;gap:8px}
            .mobile-order-code{font-size:14px}
            .admin-header-label{font-size:9px;letter-spacing:2px}
            .admin-heading{font-size:20px}
            .action-manage{font-size:10px;padding:8px 12px;letter-spacing:1px}
            .action-delete{width:34px;height:34px}
            .action-wa{width:34px;height:34px}
            .filter-bar{padding:8px 10px}
            .status-badge-mobile{font-size:9px;padding:5px 10px}
        }
    </style>
</head>
<body x-data="{ orderModalOpen: false, sidebarOpen: false }">
    @include('admin.partials.navbar')
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
                    <thead><tr><th>Nomor Surat</th><th>Pelanggan</th><th>Produk</th><th>Status</th><th style="text-align:center;">Update</th><th style="text-align:right;">Aksi</th></tr></thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td><span class="order-code">{{ $order->nomor_surat }}</span></td>
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
                                        $waMsg = rawurlencode("Halo Kak *{$order->customer_name}*, pesanan Anda telah terdaftar.\n\nNomor Surat: *{$order->nomor_surat}*\nProduk: {$order->product_name}\n\nGunakan nomor surat atau nomor HP Anda untuk melacak progres pengerjaan di website kami:\nhttps://suryapainting18indonesia.com\n\nTerima kasih telah mempercayakan pengerjaan kepada SuryaPainting18");
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
            <div class="mobile-cards" style="display:none;">
                @foreach($orders as $order)
                <div class="mobile-order-card mobile-order-card--{{ strtolower($order->status) }}">
                    <div class="mobile-order-header">
                        <div style="min-width:0;">
                            <div class="mobile-order-code" style="display:flex;align-items:center;gap:8px;">
                                <span style="width:8px;height:8px;background:currentColor;border-radius:2px;flex-shrink:0;opacity:0.8;"></span>
                                {{ $order->nomor_surat }}
                            </div>
                            @if($order->customer_phone)
                                <div class="mobile-order-phone" style="display:flex;align-items:center;gap:5px;">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                    {{ $order->customer_phone }}
                                </div>
                            @endif
                        </div>
                        @if($order->status === 'Pending')<span class="status-badge-mobile" style="color:#f6e500;border-color:rgba(246,229,0,0.3);background:rgba(246,229,0,0.08)">Menunggu</span>
                        @elseif($order->status === 'Processing')<span class="status-badge-mobile" style="color:#4c98b9;border-color:rgba(76,152,185,0.3);background:rgba(76,152,185,0.08)">Diproses</span>
                        @elseif($order->status === 'Completed')<span class="status-badge-mobile" style="color:#03904a;border-color:rgba(3,144,74,0.3);background:rgba(3,144,74,0.08)">Selesai</span>
                        @elseif($order->status === 'Cancelled')<span class="status-badge-mobile" style="color:var(--pink);border-color:rgba(238,20,177,0.3);background:rgba(238,20,177,0.08)">Batal</span>
                        @endif
                    </div>
                    <div class="mobile-order-field">
                        <span class="mobile-order-label">Pelanggan</span>
                        <span class="mobile-order-value">{{ $order->customer_name }}</span>
                    </div>
                    <div class="mobile-order-field">
                        <span class="mobile-order-label">Produk</span>
                        <span class="mobile-order-value">{{ $order->product_name }}</span>
                    </div>
                    @if($order->nomor_plat || $order->tipe_motor)
                    <div class="mobile-order-field">
                        <span class="mobile-order-label">Motor</span>
                        <span class="mobile-order-value">@if($order->tipe_motor){{ $order->tipe_motor }}@endif @if($order->nomor_plat) &middot; {{ $order->nomor_plat }}@endif</span>
                    </div>
                    @endif
                    <div class="mobile-order-field">
                        <span class="mobile-order-label">Tanggal</span>
                        <span class="mobile-order-value" style="font-size:11px;color:#666;">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="mobile-order-footer">
                        <span class="timeline-count"><span class="timeline-count-dot"></span>{{ $order->timeline_count }} Progress</span>
                        <div style="display:flex;gap:6px;align-items:center;">
                            @if($order->customer_phone)
                                @php
                                    $waPhone = preg_replace('/[^0-9]/', '', $order->customer_phone);
                                    if (str_starts_with($waPhone, '0')) $waPhone = '62' . substr($waPhone, 1);
                                    $waMsg = rawurlencode("Halo Kak *{$order->customer_name}*, pesanan Anda telah terdaftar.\n\nNomor Surat: *{$order->nomor_surat}*\nProduk: {$order->product_name}\n\nGunakan nomor surat atau nomor HP Anda untuk melacak progres pengerjaan di website kami:\nhttps://suryapainting18indonesia.com\n\nTerima kasih telah mempercayakan pengerjaan kepada SuryaPainting18 \u{1F64F}");
                                @endphp
                                <a href="https://wa.me/{{ $waPhone }}?text={{ $waMsg }}" target="_blank" rel="noopener" class="action-wa" title="Kirim kode via WhatsApp" style="width:36px;height:36px;">
                                    <svg style="width:15px;height:15px" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </a>
                            @endif
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="action-manage">Kelola</a>
                            <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" onsubmit="return confirm('Hapus pesanan ini?')">@csrf @method('DELETE')<button type="submit" class="action-delete"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button></form>
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
            <form action="{{ route('admin.orders.store') }}" method="POST" style="display:flex;flex-direction:column;flex:1;overflow:hidden;">
                @csrf
                <div class="modal-body">
                <div class="modal-field"><label for="nomor_surat">Nomor Surat *</label><input type="text" name="nomor_surat" id="nomor_surat" placeholder="Contoh: 001" required></div>
                <div class="modal-field"><label for="customer_name">Nama Pelanggan *</label><input type="text" name="customer_name" id="customer_name" placeholder="Contoh: Budi Santoso" required></div>
                <div class="modal-field"><label for="customer_phone">No. HP / WhatsApp</label><input type="tel" name="customer_phone" id="customer_phone" placeholder="Contoh: 08123456789"></div>
                <div class="modal-field"><label for="nomor_plat">Nomor Plat Kendaraan</label><input type="text" name="nomor_plat" id="nomor_plat" placeholder="Contoh: B 1234 ABC"></div>
                <div class="modal-field"><label for="tipe_motor">Tipe Motor</label>
                    <select name="tipe_motor" id="tipe_motor" style="width:100%;padding:12px 16px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:14px;outline:none;transition:border-color 0.25s;-webkit-appearance:none;appearance:none;cursor:pointer;background-image:url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23555' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E&quot;);background-repeat:no-repeat;background-position:right 14px center;padding-right:40px;">
                        <option value="">— Pilih Tipe Motor —</option>
                        <option value="Matic">Matic</option>
                        <option value="Kopling">Kopling</option>
                    </select>
                </div>
                <div class="modal-field"><label for="detail_motor">Detail Motor</label><input type="text" name="detail_motor" id="detail_motor" placeholder="Contoh: Honda Beat 2020, warna merah"></div>
                <div class="modal-field"><label for="product_name">Produk / Jasa *</label><input type="text" name="product_name" id="product_name" placeholder="Contoh: Cat Velg Motor Beat" required></div>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="orderModalOpen = false" class="modal-btn-cancel">Batal</button>
                    <button type="submit" class="modal-btn-submit">Simpan Order</button>
                </div>
            </form>
        </div>
    </div>
    <footer class="admin-footer"><div class="admin-footer-inner"><p>&copy; {{ date('Y') }} SuryaPainting18. Hak Cipta Dilindungi.</p></div></footer>
</body>
</html>
