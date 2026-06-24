<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Order | SuryaPainting18</title>
    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <link rel="apple-touch-icon" href="/assets/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,400;0,600;0,700;0,800;0,900;1,700;1,800;1,900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root{--pink:#ee14b1;--pink-dark:#c0108f;--dark:#0d0d0d;--gray:#888;--border:rgba(255,255,255,0.08)}
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Inter',sans-serif;background-color:#0a0a0a;color:#fff;min-height:100vh;display:flex;flex-direction:column;overflow-x:hidden;background-image:radial-gradient(ellipse at 50% 0%,rgba(238,20,177,0.04) 0%,transparent 60%),radial-gradient(ellipse at 80% 100%,rgba(238,20,177,0.03) 0%,transparent 50%);background-attachment:fixed}

        .admin-main{flex:1;max-width:1280px;width:100%;margin:0 auto;padding:40px 24px}
        @media(min-width:1024px){.admin-main{padding:48px}}
        .page-header{display:flex;flex-wrap:wrap;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:32px}
        .page-header-label{font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--pink);display:flex;align-items:center;gap:12px;margin-bottom:10px}
        .page-header-label-line{width:36px;height:2px;background:var(--pink)}
        .page-heading{font-family:'Barlow Condensed',sans-serif;font-size:clamp(24px,4vw,40px);font-weight:900;font-style:italic;text-transform:uppercase;color:#fff;line-height:1}
        .page-heading-code{font-family:'Barlow Condensed',sans-serif;font-size:14px;font-weight:800;letter-spacing:2px;text-transform:uppercase;color:#fff;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);padding:4px 10px;display:inline-block}
        .status-badge{display:inline-block;font-size:9px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;padding:5px 12px;border:1px solid}
        .status-badge--pending{color:#f6e500;border-color:rgba(246,229,0,0.25);background:rgba(246,229,0,0.08)}
        .status-badge--processing{color:#4c98b9;border-color:rgba(76,152,185,0.25);background:rgba(76,152,185,0.08)}
        .status-badge--completed{color:#03904a;border-color:rgba(3,144,74,0.25);background:rgba(3,144,74,0.08)}
        .status-badge--cancelled{color:var(--pink);border-color:rgba(238,20,177,0.25);background:rgba(238,20,177,0.08)}
        .alert-success{background:rgba(3,144,74,0.1);border:1px solid rgba(3,144,74,0.25);border-left:3px solid #03904a;padding:16px 20px;margin-bottom:28px;display:flex;align-items:flex-start;gap:12px;position:relative}
        .alert-success-icon{width:20px;height:20px;background:#03904a;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
        .alert-success-icon svg{width:12px;height:12px;color:#fff}
        .alert-success-title{font-weight:700;color:#fff;margin-bottom:2px}
        .alert-success-text{font-size:13px;color:rgba(255,255,255,0.7)}
        .alert-close{position:absolute;top:12px;right:14px;background:none;border:none;color:rgba(255,255,255,0.3);cursor:pointer;padding:4px;transition:color 0.2s}
        .alert-close:hover{color:#fff}
        .alert-error{background:rgba(238,20,177,0.1);border:1px solid rgba(238,20,177,0.25);border-left:3px solid var(--pink);padding:16px 20px;margin-bottom:28px;display:flex;align-items:flex-start;gap:12px}
        .alert-error-icon{width:20px;height:20px;background:var(--pink);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
        .alert-error-icon svg{width:12px;height:12px;color:#fff}
        .admin-card{background:#111;border:1px solid rgba(255,255,255,0.08);padding:28px;position:relative}
        .info-stack .admin-card:not(:last-child)::after{content:'';position:absolute;bottom:-12px;left:20px;right:20px;height:1px;background:linear-gradient(to right,transparent,rgba(238,20,177,0.1),transparent)}
        .admin-card-title{font-family:'Barlow Condensed',sans-serif;font-size:16px;font-weight:800;font-style:italic;text-transform:uppercase;color:#fff;display:flex;align-items:center;gap:10px;margin-bottom:20px}
        .admin-card-title svg{width:16px;height:16px;color:var(--pink)}
        .admin-field{margin-bottom:16px}
        .admin-field-label{font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:var(--gray);display:block;margin-bottom:4px}
        .admin-field-value{font-weight:700;font-size:15px;color:#fff}
        .admin-field-divider{border-bottom:1px solid rgba(255,255,255,0.06);padding-bottom:16px;margin-bottom:16px}
        .admin-field-box{background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.07);padding:12px 14px;margin-bottom:6px;display:flex;align-items:baseline;justify-content:space-between}
        .admin-field-box .admin-field-label{font-size:9px;margin-bottom:0;min-width:80px}
        .admin-field-box .admin-field-value{font-size:13px;text-align:right}
        .admin-input{width:100%;padding:12px 16px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:14px;outline:none;transition:border-color 0.25s}
        .admin-input:focus{border-color:var(--pink)}
        .admin-input::placeholder{color:#444}
        .admin-select{width:100%;padding:12px 16px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:14px;outline:none;transition:border-color 0.25s;-webkit-appearance:none;appearance:none;cursor:pointer;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23555' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center;padding-right:40px}
        .admin-select:focus{border-color:var(--pink)}
        .admin-select option{background:#0d0d0d;color:#fff}
        .form-label{display:block;font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#888;margin-bottom:8px}
        .btn-red-sm{display:inline-flex;align-items:center;justify-content:center;gap:8px;background:var(--pink);color:#fff;font-family:'Barlow Condensed',sans-serif;font-size:12px;font-weight:800;font-style:italic;letter-spacing:2px;text-transform:uppercase;padding:11px 22px;border:2px solid var(--pink);transition:background 0.25s,transform 0.15s;cursor:pointer;text-decoration:none}
        .btn-red-sm:hover{background:var(--pink-dark);border-color:var(--pink-dark);transform:translateY(-1px)}
        .btn-outline-sm{display:inline-flex;align-items:center;justify-content:center;gap:8px;background:transparent;color:rgba(255,255,255,0.6);font-family:'Barlow Condensed',sans-serif;font-size:12px;font-weight:700;font-style:italic;letter-spacing:2px;text-transform:uppercase;padding:11px 22px;border:1px solid rgba(255,255,255,0.12);transition:border-color 0.2s,color 0.2s;cursor:pointer;text-decoration:none}
        .btn-outline-sm:hover{border-color:rgba(255,255,255,0.4);color:#fff}
        .upload-zone{border:2px dashed rgba(255,255,255,0.1);padding:24px;position:relative;transition:border-color 0.3s;background:rgba(255,255,255,0.02)}
        .upload-zone:hover{border-color:rgba(255,255,255,0.2)}
        .upload-zone input[type="file"]{position:absolute;inset:0;width:100%;height:100%;opacity:0;cursor:pointer;z-index:10}
        .upload-placeholder{text-align:center}
        .upload-placeholder svg{width:32px;height:32px;color:#444;margin-bottom:8px}
        .upload-placeholder p{font-size:12px;color:#555;line-height:1.6}
        .upload-placeholder small{font-size:10px;color:#444}
        .upload-preview{position:relative;max-width:260px;margin:0 auto}
        .upload-preview img{width:100%;height:120px;object-fit:cover;border:1px solid rgba(255,255,255,0.08)}
        .upload-preview-remove{position:absolute;top:-8px;right:-8px;width:24px;height:24px;background:var(--pink);border:none;border-radius:50%;color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;z-index:20;font-size:12px}
        .timeline-empty{text-align:center;padding:48px 16px;color:#555}
        .timeline-empty svg{width:32px;height:32px;color:#444;margin:0 auto 12px;display:block}
        .timeline-empty p{font-size:13px}
        .timeline-wrap{position:relative;padding-left:28px;border-left:2px solid rgba(255,255,255,0.08);margin-left:8px}
        .timeline-item{position:relative;padding-bottom:32px}
        .timeline-item:last-child{padding-bottom:0}
        .timeline-node{position:absolute;left:-36px;top:2px;width:14px;height:14px;background:var(--pink);border:2px solid var(--dark)}
        .timeline-node.inactive{background:#333;border-color:#555}
        .timeline-card{background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);padding:20px 24px;position:relative;transition:border-color 0.2s}
        .timeline-card:hover{border-color:rgba(255,255,255,0.1)}
        .timeline-card-title{font-weight:700;font-size:14px;color:#fff;margin-bottom:4px;padding-right:32px}
        .timeline-card-date{font-size:10px;color:#555;font-weight:600;letter-spacing:0.5px;text-transform:uppercase;display:block;margin-bottom:10px}
        .timeline-card-desc{font-size:13px;color:rgba(255,255,255,0.6);line-height:1.7}
        .timeline-card-img{margin-top:12px;max-width:320px;cursor:pointer;overflow:hidden}
        .timeline-card-img img{width:100%;height:140px;object-fit:cover;display:block;border:1px solid rgba(255,255,255,0.06);transition:transform 0.5s}
        .timeline-card-img:hover img{transform:scale(1.03)}
        .timeline-delete{position:absolute;top:16px;right:16px;width:28px;height:28px;background:transparent;border:1px solid rgba(255,255,255,0.08);color:#555;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:border-color 0.2s,color 0.2s;opacity:0}
        .timeline-card:hover .timeline-delete{opacity:1}
        .timeline-delete:hover{border-color:var(--pink);color:var(--pink);background:rgba(238,20,177,0.08)}
        .timeline-delete svg{width:12px;height:12px}
        .status-form{width:100%}
        .status-form-row{display:flex;gap:8px}
        .status-form-field{flex:1;min-width:0}
        @media(max-width:640px){.status-form-row{flex-direction:column}}
        .lightbox-overlay{position:fixed;inset:0;z-index:200;background:rgba(0,0,0,0.96);display:flex;align-items:center;justify-content:center;padding:16px}
        .lightbox-close{position:absolute;top:20px;right:24px;background:none;border:none;color:rgba(255,255,255,0.6);font-size:36px;cursor:pointer;line-height:1;transition:color 0.2s}
        .lightbox-close:hover{color:#fff}
        .lightbox-content{max-width:900px;width:100%;display:flex;flex-direction:column;align-items:center;gap:16px}
        .lightbox-content img{max-width:100%;max-height:80vh;object-fit:contain;display:block}
        .lightbox-title{font-family:'Barlow Condensed',sans-serif;font-size:20px;font-weight:700;font-style:italic;text-transform:uppercase;color:#fff}
        .admin-footer{border-top:1px solid rgba(255,255,255,0.06);background:#070707;padding:24px 0}
        .admin-footer p{font-size:11px;color:#444;letter-spacing:1px;text-align:center}
        .grid-layout{display:grid;grid-template-columns:1fr;gap:28px}
        .info-stack{gap:24px}
        @media(min-width:1024px){.grid-layout{grid-template-columns:5fr 7fr;gap:32px}.info-stack{gap:32px}}
        @media(max-width:640px){
            .admin-nav-inner{padding:0 14px;height:56px}
            .admin-main{padding:20px 16px}
            .page-header{margin-bottom:24px}
            .page-heading{font-size:22px}
            .admin-card{padding:20px 16px;background:#131313;border-color:rgba(255,255,255,0.06)}
            .page-header-label{font-size:9px;letter-spacing:2px}
            .grid-layout{gap:16px}
            .info-stack{gap:16px}
            .info-stack .admin-card:not(:last-child)::after{bottom:-9px;left:16px;right:16px}
            .admin-card-title{font-size:15px;margin-bottom:18px}
            .admin-field{margin-bottom:14px}
            .admin-field-divider{padding-bottom:14px;margin-bottom:14px}
            .admin-field-label{font-size:9px;letter-spacing:2px}
            .admin-field-value{font-size:14px}
            .admin-field-box{padding:10px 12px;margin-bottom:5px}
            .admin-field-box .admin-field-label{font-size:9px;min-width:75px}
            .admin-field-box .admin-field-value{font-size:13px}
            .timeline-card{padding:16px 14px;background:rgba(255,255,255,0.02)}
            .timeline-card-title{font-size:13px;padding-right:0}
            .timeline-card-desc{font-size:12px}
            .timeline-wrap{padding-left:20px;margin-left:6px;border-left-width:2px}
            .timeline-node{left:-28px;width:12px;height:12px}
            .timeline-item{padding-bottom:24px}
            .timeline-delete{opacity:1;position:absolute;top:12px;right:12px;width:32px;height:32px;margin-top:0}
            .btn-red-sm{padding:11px 18px;font-size:12px;width:100%;justify-content:center}
            .btn-outline-sm{width:100%;justify-content:center}
            .upload-zone{padding:20px 16px}
            .upload-zone p{font-size:11px}
            .status-form-row{flex-direction:column;gap:6px}
            .admin-input{padding:11px 14px;font-size:13px}
            .admin-select{padding:11px 14px;font-size:13px}
            .form-label{font-size:9px;letter-spacing:1.5px;margin-bottom:6px}
        }
        @media(max-width:480px){
            .page-header-label .page-header-label-line{width:24px}
            .admin-field-value{font-size:13px}
            .admin-card{padding:16px 14px}
            .admin-card-title{font-size:14px}
            .timeline-card{padding:14px 12px}
            .timeline-card-title{font-size:12px}
            .btn-ghost-admin{padding:8px 14px;font-size:10px;letter-spacing:1.5px}
            .admin-field-box{padding:8px 10px}
            .admin-field-box .admin-field-label{font-size:8px;min-width:65px}
            .admin-field-box .admin-field-value{font-size:12px}
        }
        @media(max-width:380px){
            .admin-main{padding:16px 12px}
            .admin-card{padding:14px 10px}
            .page-heading{font-size:18px}
            .grid-layout{gap:12px}
            .admin-nav-inner{padding:0 10px}
        }
        [x-cloak]{display:none!important}
    </style>
</head>
<body x-data="orderManager()">
    @include('admin.partials.navbar')

    <main class="admin-main">
        <div class="page-header">
            <div>
                <div class="page-header-label"><span class="page-header-label-line"></span>Kelola Progres</div>
                <h1 class="page-heading">Kelola Progres Pesanan</h1>
                <div style="margin-top:10px;display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
                    <span class="page-heading-code">{{ $order->nomor_surat }}</span>
                    @if($order->status === 'Pending')<span class="status-badge status-badge--pending">Menunggu</span>
                    @elseif($order->status === 'Processing')<span class="status-badge status-badge--processing">Diproses</span>
                    @elseif($order->status === 'Completed')<span class="status-badge status-badge--completed">Selesai</span>
                    @elseif($order->status === 'Cancelled')<span class="status-badge status-badge--cancelled">Dibatalkan</span>
                    @endif
                    <button @click="editModalOpen = true" class="btn-ghost-admin" style="font-size:10px;padding:6px 12px;letter-spacing:1.5px;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Edit Pesanan
                    </button>
                </div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn-outline-sm">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Kembali ke Dashboard
            </a>
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
            <div>
                <div style="font-weight:700;color:#fff;margin-bottom:4px;">Perhatian!</div>
                <ul style="margin:0;padding:0;list-style-position:inside;">
                    @foreach($errors->all() as $error)<li style="font-size:13px;color:rgba(255,255,255,0.7);line-height:1.6;">{{ $error }}</li>@endforeach
                </ul>
            </div>
        </div>
        @endif

        <div class="grid-layout">
            <div style="display:grid;grid-template-columns:1fr;gap:24px;" class="info-stack">
                <!-- Order Info -->
                <div class="admin-card">
                    <div class="admin-card-title"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>Informasi Pesanan</div>
                    <div class="admin-field-box">
                        <span class="admin-field-label">Nomor Surat</span>
                        <span class="admin-field-value">{{ $order->nomor_surat }}</span>
                    </div>
                    <div class="admin-field-box">
                        <span class="admin-field-label">Cabang</span>
                        @if($order->cabang)
                            <span class="admin-field-value">{{ $order->cabang }}</span>
                        @else
                            <span class="admin-field-value" style="color:#555;font-weight:400;font-size:12px;">—</span>
                        @endif
                    </div>
                    <div class="admin-field-box">
                        <span class="admin-field-label">Nama Pelanggan</span>
                        <span class="admin-field-value">{{ $order->customer_name }}</span>
                    </div>
                    <div class="admin-field admin-field-divider">
                        <span class="admin-field-label">No. HP / WhatsApp</span>
                        @if($order->customer_phone)
                            @php
                                $waPhone = preg_replace('/[^0-9]/', '', $order->customer_phone);
                                if (str_starts_with($waPhone, '0')) $waPhone = '62' . substr($waPhone, 1);
                                $waMsg = urlencode("Halo Kak *{$order->customer_name}*, pesanan Anda telah terdaftar.\n\nNomor Surat: *{$order->nomor_surat}*\nProduk: {$order->product_name}\n\nGunakan nomor surat atau nomor HP Anda untuk melacak progres pengerjaan di website kami:\nhttps://suryapainting18indonesia.com\n\nTerima kasih telah mempercayakan pengerjaan kepada SuryaPainting18 🙏");
                            @endphp
                            <div style="display:flex;align-items:center;gap:12px;margin-top:4px;">
                                <span class="admin-field-value" style="color:#25d366;">{{ $order->customer_phone }}</span>
                                <a href="https://wa.me/{{ $waPhone }}?text={{ $waMsg }}" target="_blank" rel="noopener"
                                   style="display:inline-flex;align-items:center;gap:6px;background:rgba(37,211,102,0.1);border:1px solid rgba(37,211,102,0.35);color:#25d366;font-family:'Barlow Condensed',sans-serif;font-size:11px;font-weight:700;font-style:italic;letter-spacing:1.5px;text-transform:uppercase;padding:6px 14px;text-decoration:none;transition:background 0.2s;">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    Kirim Kode via WA
                                </a>
                            </div>
                        @else
                            <span class="admin-field-value" style="color:#555;font-weight:400;font-size:13px;">Tidak ada nomor HP</span>
                        @endif
                    </div>
                    <div class="admin-field-box">
                        <span class="admin-field-label">Nomor Plat</span>
                        @if($order->nomor_plat)
                            <span class="admin-field-value">{{ $order->nomor_plat }}</span>
                        @else
                            <span class="admin-field-value" style="color:#555;font-weight:400;font-size:12px;">—</span>
                        @endif
                    </div>
                    <div class="admin-field-box">
                        <span class="admin-field-label">Tipe Motor</span>
                        @if($order->tipe_motor)
                            <span class="admin-field-value">{{ $order->tipe_motor }}</span>
                        @else
                            <span class="admin-field-value" style="color:#555;font-weight:400;font-size:12px;">—</span>
                        @endif
                    </div>
                    <div class="admin-field-box">
                        <span class="admin-field-label">Detail</span>
                        @if($order->detail_motor)
                            <span class="admin-field-value">{{ $order->detail_motor }}</span>
                        @else
                            <span class="admin-field-value" style="color:#555;font-weight:400;font-size:12px;">—</span>
                        @endif
                    </div>
                    <div class="admin-field-box">
                        <span class="admin-field-label">Produk</span>
                        <span class="admin-field-value">{{ $order->product_name }}</span>
                    </div>
                    <div class="admin-field admin-field-divider">
                        <span class="admin-field-label">Status Saat Ini</span>
                        <div style="margin-top:6px;">
                            @if($order->status === 'Pending')
                                <span class="status-badge status-badge--pending" style="font-size:10px;padding:6px 14px;display:inline-flex;align-items:center;gap:6px;">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    Menunggu (Pending)
                                </span>
                            @elseif($order->status === 'Processing')
                                <span class="status-badge status-badge--processing" style="font-size:10px;padding:6px 14px;display:inline-flex;align-items:center;gap:6px;">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                                    Diproses (Processing)
                                </span>
                            @elseif($order->status === 'Completed')
                                <span class="status-badge status-badge--completed" style="font-size:10px;padding:6px 14px;display:inline-flex;align-items:center;gap:6px;">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                    Selesai (Completed)
                                </span>
                            @elseif($order->status === 'Cancelled')
                                <span class="status-badge status-badge--cancelled" style="font-size:10px;padding:6px 14px;display:inline-flex;align-items:center;gap:6px;">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    Dibatalkan (Cancelled)
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="admin-field-box">
                        <span class="admin-field-label">Tanggal</span>
                        <span class="admin-field-value">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>

                <!-- Add Timeline -->
                <div class="admin-card">
                    <div class="admin-card-title"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="6" y1="3" x2="6" y2="15"/><circle cx="18" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path d="M18 9a9 9 0 0 1-9 9"/></svg>Tambah Update Progres</div>
                    <form action="{{ route('admin.orders.addTimeline', $order->id) }}" method="POST" enctype="multipart/form-data" @submit="onFormSubmit($event)">
                        @csrf
                        <div class="admin-field">
                            <label for="title" class="form-label">Judul Status Progres *</label>
                            <input type="text" name="title" id="title" class="admin-input" placeholder="Contoh: Proses Produksi Awal, QC Selesai" required>
                        </div>
                        <div class="admin-field">
                            <label for="status" class="form-label">Status Pesanan *</label>
                            <select name="status" id="status" class="admin-select" required>
                                <option value="Pending" @selected($order->status === 'Pending')>Menunggu (Pending)</option>
                                <option value="Processing" @selected($order->status === 'Processing')>Diproses (Processing)</option>
                                <option value="Completed" @selected($order->status === 'Completed')>Selesai (Completed)</option>
                                <option value="Cancelled" @selected($order->status === 'Cancelled')>Dibatalkan (Cancelled)</option>
                            </select>
                        </div>
                        <div class="admin-field">
                            <label for="description" class="form-label">Keterangan / Detail</label>
                            <textarea name="description" id="description" rows="3" class="admin-input" placeholder="Tuliskan catatan progres produk secara detail di sini..." style="resize:vertical;min-height:80px;"></textarea>
                        </div>
                        <div class="admin-field">
                            <label class="form-label">Upload Foto Bukti</label>

                            {{-- Two separate hidden inputs for gallery vs camera. --}}
                            {{-- Only the active one has name="image" at submit time to avoid conflict. --}}
                            <input type="file" id="upload-gallery" name="image" accept="image/*,.heic,.heif" style="display:none" @change="previewImage($event, 'gallery')">
                            <input type="file" id="upload-camera" accept="image/*" capture="environment" style="display:none" @change="previewImage($event, 'camera')">

                            {{-- Preview zone (shown after file is selected) --}}
                            <div class="upload-zone" x-show="imagePreview || isConverting" x-cloak style="padding:12px;">
                                <div class="upload-preview" x-show="imagePreview && !isConverting" x-cloak>
                                    <img :src="imagePreview">
                                    <button type="button" class="upload-preview-remove" @click.stop="clearPreview()">&#10005;</button>
                                </div>
                                <div class="heic-loading" x-show="isConverting" x-cloak style="padding:10px;">
                                    <div class="heic-spinner"></div>
                                    <span class="heic-loading-text">Mengonversi HEIC...</span>
                                </div>
                            </div>

                            {{-- Upload buttons (shown when no file selected) --}}
                            <div x-show="!imagePreview && !isConverting" style="display:flex;flex-direction:column;gap:8px;margin-top:4px;">
                                {{-- Galeri button --}}
                                <button type="button"
                                    onclick="document.getElementById('upload-gallery').click()"
                                    style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:14px 16px;background:rgba(255,255,255,0.03);border:1.5px dashed rgba(255,255,255,0.15);color:rgba(255,255,255,0.7);font-family:'Inter',sans-serif;font-size:13px;font-weight:500;cursor:pointer;transition:border-color 0.2s,background 0.2s;-webkit-tap-highlight-color:transparent;"
                                    onmouseover="this.style.borderColor='rgba(238,20,177,0.5)';this.style.background='rgba(238,20,177,0.05)'"
                                    onmouseout="this.style.borderColor='rgba(255,255,255,0.15)';this.style.background='rgba(255,255,255,0.03)'">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                                    Pilih dari Galeri / File
                                </button>
                                {{-- Kamera button --}}
                                <button type="button"
                                    onclick="document.getElementById('upload-camera').click()"
                                    style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:14px 16px;background:rgba(255,255,255,0.03);border:1.5px dashed rgba(255,255,255,0.15);color:rgba(255,255,255,0.7);font-family:'Inter',sans-serif;font-size:13px;font-weight:500;cursor:pointer;transition:border-color 0.2s,background 0.2s;-webkit-tap-highlight-color:transparent;"
                                    onmouseover="this.style.borderColor='rgba(238,20,177,0.5)';this.style.background='rgba(238,20,177,0.05)'"
                                    onmouseout="this.style.borderColor='rgba(255,255,255,0.15)';this.style.background='rgba(255,255,255,0.03)'">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                                    Ambil Foto dari Kamera
                                </button>
                                <p style="font-size:10px;color:#555;text-align:center;margin-top:2px;">Maks. 20MB &bull; JPG, PNG, WEBP, HEIC, GIF, BMP</p>
                            </div>
                        </div>
                        <button type="submit" class="btn-red-sm" style="width:100%;margin-top:8px;" :disabled="submitting">
                            <template x-if="!submitting">
                                <span style="display:flex;align-items:center;gap:8px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                                    Simpan Progres
                                </span>
                            </template>
                            <template x-if="submitting">
                                <span style="display:flex;align-items:center;gap:8px;">
                                    <svg style="animation:spin 1s linear infinite" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                                    Mengunggah...
                                </span>
                            </template>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Timeline -->
            <div class="admin-card">
                <div class="admin-card-title"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Riwayat Progres Saat Ini</div>

                @if($order->timeline->isEmpty())
                    <div class="timeline-empty">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <p>Belum ada progres yang ditambahkan.</p>
                    </div>
                @else
                    <div class="timeline-wrap">
                        @foreach($order->timeline as $index => $step)
                        <div class="timeline-item">
                            <span class="timeline-node @if($index !== 0) inactive @endif"></span>
                            <div class="timeline-card">
                                <form action="{{ route('admin.orders.deleteTimeline', $step->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus update progres ini?')" class="timeline-delete">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="background:none;border:none;color:inherit;cursor:pointer;display:flex;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button>
                                </form>
                                <div class="timeline-card-title">{{ $step->title }}</div>
                                <div style="display:flex;flex-wrap:wrap;align-items:center;gap:8px;margin-bottom:8px;">
                                    <span class="timeline-card-date" style="margin:0;">{{ $step->created_at->format('d/m/Y H:i') }} ({{ $step->created_at->diffForHumans() }})</span>
                                </div>
                                <div class="timeline-card-desc">{{ $step->description ?? 'Tidak ada keterangan.' }}</div>
                                @if($step->image_url)
                                    @if($step->is_heic)
                                        {{-- HEIC: converted client-side via heic2any WebAssembly --}}
                                        <div class="heic-container"
                                             data-heic-src="{{ $step->image_url }}"
                                             data-title="{{ addslashes($step->title) }}">
                                            <div class="heic-loading">
                                                <div class="heic-spinner"></div>
                                                <span class="heic-loading-text">Memproses foto...</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="timeline-card-img" @click="openLightbox('{{ $step->image_url }}', '{{ $step->title }}')">
                                            <img src="{{ $step->image_url }}" alt="{{ $step->title }}">
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Edit Order Modal -->
    <div x-show="editModalOpen" x-transition:opacity.duration.300ms class="fixed inset-0 z-50 flex items-center justify-center" style="display:none;background:rgba(0,0,0,0.88);padding:24px" @click="editModalOpen = false" @keydown.escape.window="editModalOpen = false" x-cloak>
        <div @click.stop style="width:100%;max-width:480px;max-height:85vh;background:#111;border:1px solid rgba(255,255,255,0.1);position:relative;overflow:hidden;display:flex;flex-direction:column;">
            <div style="position:absolute;top:0;left:0;right:0;height:3px;background:var(--pink);z-index:1;"></div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid rgba(255,255,255,0.06);flex-shrink:0;">
                <div style="font-family:'Barlow Condensed',sans-serif;font-size:18px;font-weight:800;font-style:italic;text-transform:uppercase;color:#fff;display:flex;align-items:center;gap:10px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--pink)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit Pesanan
                </div>
                <button @click="editModalOpen = false" style="background:none;border:none;color:rgba(255,255,255,0.3);cursor:pointer;padding:4px;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
            </div>
            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" style="display:flex;flex-direction:column;flex:1;overflow:hidden;">
                @csrf @method('PATCH')
                <div style="padding:16px 20px;overflow-y:auto;flex:1;">
                    <div style="margin-bottom:14px;">
                        <label style="display:block;font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#888;margin-bottom:8px;">Nomor Surat *</label>
                        <input type="text" name="nomor_surat" value="{{ old('nomor_surat', $order->nomor_surat) }}" style="width:100%;padding:12px 16px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:14px;outline:none;" required>
                    </div>
                    <div style="margin-bottom:14px;">
                        <label style="display:block;font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#888;margin-bottom:8px;">Cabang *</label>
                        <select name="cabang" required style="width:100%;padding:12px 16px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:14px;outline:none;-webkit-appearance:none;appearance:none;cursor:pointer;background-image:url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23555' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E&quot;);background-repeat:no-repeat;background-position:right 14px center;padding-right:40px;">
                            <option value="" @selected(!$order->cabang)>— Pilih Cabang —</option>
                            <option value="Bekasi" @selected($order->cabang === 'Bekasi')>Bekasi</option>
                            <option value="Cikarang" @selected($order->cabang === 'Cikarang')>Cikarang</option>
                        </select>
                    </div>
                    <div style="margin-bottom:14px;">
                        <label style="display:block;font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#888;margin-bottom:8px;">Nama Pelanggan *</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name', $order->customer_name) }}" style="width:100%;padding:12px 16px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:14px;outline:none;" required>
                    </div>
                    <div style="margin-bottom:14px;">
                        <label style="display:block;font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#888;margin-bottom:8px;">No. HP / WhatsApp</label>
                        <input type="tel" name="customer_phone" value="{{ old('customer_phone', $order->customer_phone) }}" style="width:100%;padding:12px 16px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:14px;outline:none;" placeholder="Contoh: 08123456789">
                    </div>
                    <div style="margin-bottom:14px;">
                        <label style="display:block;font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#888;margin-bottom:8px;">Nomor Plat</label>
                        <input type="hidden" name="nomor_plat" :value="platDigits.join('')">
                        <div style="display:flex;gap:10px;">
                        <template x-for="(digit, idx) in platDigits" :key="idx">
                            <input type="text" :id="'plat-digit-'+idx" inputmode="numeric" maxlength="1" pattern="[0-9]" autocomplete="off"
                                   x-model="platDigits[idx]"
                                   @input="focusNextPlat(platDigits[idx], idx)"
                                   @keydown="handlePlatKeydown($event, idx)"
                                   @paste="handlePlatPaste($event, idx)"
                                   @focus="platFocused = idx"
                                   style="width:60px;height:60px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.12);color:#fff;font-family:'Inter',sans-serif;font-size:22px;font-weight:700;text-align:center;outline:none;transition:border-color 0.25s;"
                                   :style="platFocused === idx ? 'border-color:#ee14b1;box-shadow:0 0 0 2px rgba(238,20,177,0.15);' : ''">
                        </template>
                        </div>
                    </div>
                    <div style="margin-bottom:14px;">
                        <label style="display:block;font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#888;margin-bottom:8px;">Tipe Motor</label>
                        <select name="tipe_motor" style="width:100%;padding:12px 16px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:14px;outline:none;-webkit-appearance:none;appearance:none;cursor:pointer;background-image:url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23555' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E&quot;);background-repeat:no-repeat;background-position:right 14px center;padding-right:40px;">
                            <option value="" @selected(!$order->tipe_motor)>— Pilih Tipe Motor —</option>
                            <option value="Matic" @selected($order->tipe_motor === 'Matic')>Matic</option>
                            <option value="Kopling" @selected($order->tipe_motor === 'Kopling')>Kopling</option>
                        </select>
                    </div>
                    <div style="margin-bottom:14px;">
                        <label style="display:block;font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#888;margin-bottom:8px;">Detail Motor</label>
                        <input type="text" name="detail_motor" value="{{ old('detail_motor', $order->detail_motor) }}" style="width:100%;padding:12px 16px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:14px;outline:none;" placeholder="Contoh: Honda Beat 2020, warna merah">
                    </div>
                    <div style="margin-bottom:14px;">
                        <label style="display:block;font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#888;margin-bottom:8px;">Produk / Jasa *</label>
                        <input type="text" name="product_name" value="{{ old('product_name', $order->product_name) }}" style="width:100%;padding:12px 16px;background:#0d0d0d;border:1px solid rgba(255,255,255,0.1);color:#fff;font-family:'Inter',sans-serif;font-size:14px;outline:none;" required>
                    </div>
                </div>
                <div style="padding:14px 20px;border-top:1px solid rgba(255,255,255,0.06);flex-shrink:0;display:flex;gap:8px;">
                    <button type="button" @click="editModalOpen = false" style="flex:1;background:transparent;border:1px solid rgba(255,255,255,0.12);color:rgba(255,255,255,0.6);font-family:'Barlow Condensed',sans-serif;font-size:12px;font-weight:700;font-style:italic;letter-spacing:2px;text-transform:uppercase;padding:11px 18px;cursor:pointer;text-align:center;">Batal</button>
                    <button type="submit" style="flex:1;background:var(--pink);border:2px solid var(--pink);color:#fff;font-family:'Barlow Condensed',sans-serif;font-size:12px;font-weight:800;font-style:italic;letter-spacing:2px;text-transform:uppercase;padding:11px 18px;cursor:pointer;">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Lightbox -->
    <div x-show="lightboxOpen" x-transition:opacity.duration.300ms class="lightbox-overlay" @click="lightboxOpen = false" @keydown.escape.window="lightboxOpen = false" x-cloak>
        <button class="lightbox-close" @click="lightboxOpen = false">&times;</button>
        <div class="lightbox-content" @click.stop>
            <img :src="lightboxImg" :alt="lightboxTitle">
            <h4 class="lightbox-title" x-text="lightboxTitle"></h4>
        </div>
    </div>

    <footer class="admin-footer"><p>&copy; {{ date('Y') }} SuryaPainting18. Hak Cipta Dilindungi.</p></footer>

    <style>
        @keyframes spin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
        .heic-container{position:relative;margin-top:12px;max-width:320px;overflow:hidden;cursor:pointer;min-height:80px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);display:flex;align-items:center;justify-content:center;}
        .heic-container img{width:100%;height:140px;object-fit:cover;display:block;transition:transform 0.5s;}
        .heic-container:hover img{transform:scale(1.03);}
        .heic-loading{display:flex;flex-direction:column;align-items:center;gap:10px;padding:20px;}
        .heic-spinner{width:28px;height:28px;border:2px solid rgba(255,255,255,0.1);border-top-color:var(--pink);border-radius:50%;animation:spin 0.8s linear infinite;}
        .heic-loading-text{font-size:11px;color:#666;letter-spacing:1px;text-transform:uppercase;}
        .heic-error{display:flex;flex-direction:column;align-items:center;gap:8px;padding:16px;text-align:center;}
        .heic-error-text{font-size:11px;color:#555;line-height:1.5;}
        .heic-error a{font-size:11px;color:var(--pink);text-decoration:none;border-bottom:1px dashed rgba(238,20,177,0.4);padding-bottom:1px;}
    </style>
    <script>
        function orderManager(){
            const platRaw = '{{ addslashes(old('nomor_plat', $order->nomor_plat)) }}'.replace(/\D/g, '').slice(0, 4).split('');
            const platInit = ['', '', '', ''];
            for (let i = 0; i < platRaw.length; i++) platInit[i] = platRaw[i];
            return{
                imagePreview:null,
                isConverting:false,
                submitting:false,
                lightboxOpen:false,
                lightboxImg:'',
                lightboxTitle:'',
                editModalOpen:false,
                sidebarOpen:false,
                platDigits: platInit,
                platFocused: 0,
                focusNextPlat(current, idx){
                    if(current.length === 1 && idx < 3){
                        this.platFocused = idx + 1;
                        this.$nextTick(() => {
                            const next = document.getElementById('plat-digit-'+(idx+1));
                            if(next) next.focus();
                        });
                    }
                },
                handlePlatKeydown(e, idx){
                    if(e.key === 'Backspace' && !this.platDigits[idx] && idx > 0){
                        this.platFocused = idx - 1;
                        this.$nextTick(() => {
                            const prev = document.getElementById('plat-digit-'+(idx-1));
                            if(prev){ prev.focus(); prev.select(); }
                        });
                    }
                },
                handlePlatPaste(e, startIdx){
                    e.preventDefault();
                    const paste = (e.clipboardData.getData('text') || '').replace(/\D/g, '').slice(0, 4);
                    for(let i = 0; i < 4; i++){ this.platDigits[i] = paste[i] || ''; }
                    if(paste.length < 4){
                        this.platFocused = paste.length;
                        this.$nextTick(() => {
                            const next = document.getElementById('plat-digit-'+paste.length);
                            if(next) next.focus();
                        });
                    }
                },
                previewImage(e, source){
                    const f = e.target.files[0];
                    if(!f) return;

                    const ext  = f.name && f.name.includes('.') ? f.name.split('.').pop().toLowerCase() : '';
                    const mime = f.type ? f.type.toLowerCase() : '';
                    const isHeic = ext === 'heic' || ext === 'heif'
                                || mime === 'image/heic' || mime === 'image/heif'
                                || mime === 'image/x-heic' || mime === 'image/x-heif';

                    const galleryInput = document.getElementById('upload-gallery');
                    const cameraInput  = document.getElementById('upload-camera');

                    const ensureInGalleryInput = (file) => {
                        if (typeof DataTransfer !== 'undefined') {
                            try {
                                const dt = new DataTransfer();
                                dt.items.add(file);
                                galleryInput.files = dt.files;
                                return;
                            } catch(err) {}
                        }

                        galleryInput.removeAttribute('name');
                        cameraInput.setAttribute('name', 'image');
                    };

                    if(isHeic) {
                        this.isConverting = true;
                        this.imagePreview = null;

                        const loadLib = window.heic2any ? Promise.resolve() : new Promise((res, rej) => {
                            const s = document.createElement('script');
                            s.src = "https://cdn.jsdelivr.net/npm/heic2any@0.0.4/dist/heic2any.min.js";
                            s.onload = res;
                            s.onerror = rej;
                            document.head.appendChild(s);
                        });

                        loadLib
                        .then(() => heic2any({ blob: f, toType: 'image/jpeg', quality: 0.8 }))
                        .then((jpegBlob) => {
                            this.imagePreview = URL.createObjectURL(jpegBlob);
                            const newName = (f.name || 'photo').replace(/\.heic$/i, '.jpg').replace(/\.heif$/i, '.jpg');
                            const converted = new File([jpegBlob], newName, { type: 'image/jpeg' });
                            ensureInGalleryInput(converted);
                            this.isConverting = false;
                        }).catch((err) => {
                            alert('Gagal memproses file HEIC. Harap gunakan format JPG/PNG/WEBP.');
                            this.clearPreview();
                        });

                    } else {
                        ensureInGalleryInput(f);

                        const r = new FileReader();
                        r.onload  = (ev) => { this.imagePreview = ev.target.result; };
                        r.onerror = () => { this.imagePreview = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEAAAAALAAAAAABAAEAAAI='; };
                        r.readAsDataURL(f);
                    }
                },
                onFormSubmit(e){
                    this.submitting = true;
                },
                clearPreview(){
                    this.imagePreview=null;
                    this.isConverting=false;
                    const galleryInput = document.getElementById('upload-gallery');
                    const cameraInput  = document.getElementById('upload-camera');
                    const inputs = document.querySelectorAll('input[type="file"]');
                    inputs.forEach(i => { i.value = ''; });
                    galleryInput.setAttribute('name', 'image');
                    if(cameraInput) cameraInput.removeAttribute('name');
                },
                openLightbox(url,title){
                    this.lightboxImg=url;
                    this.lightboxTitle=title;
                    this.lightboxOpen=true;
                },
                init(){
                    // Listen for HEIC converted images requesting lightbox
                    window.addEventListener('heic-lightbox', (e) => {
                        this.openLightbox(e.detail.url, e.detail.title);
                    });
                }
            }
        }
    </script>

    {{-- heic2any: client-side HEIC → JPEG conversion via WebAssembly --}}
    @php $heicImages = $order->timeline->filter(fn($t) => $t->is_heic); @endphp
    @if($heicImages->isNotEmpty())
    <script src="https://cdn.jsdelivr.net/npm/heic2any@0.0.4/dist/heic2any.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var containers = document.querySelectorAll('.heic-container[data-heic-src]');
        containers.forEach(function (container) {
            var src   = container.dataset.heicSrc;
            var title = container.dataset.title || '';

            fetch(src)
                .then(function (r) { return r.blob(); })
                .then(function (blob) {
                    return heic2any({ blob: blob, toType: 'image/jpeg', quality: 0.82 });
                })
                .then(function (jpegBlob) {
                    var blobUrl = URL.createObjectURL(jpegBlob);
                    var img = document.createElement('img');
                    img.src = blobUrl;
                    img.alt = title;
                    container.innerHTML = '';
                    container.appendChild(img);
                    // Wire up lightbox click
                    container.addEventListener('click', function () {
                        window.dispatchEvent(new CustomEvent('heic-lightbox', {
                            detail: { url: blobUrl, title: title }
                        }));
                    });
                })
                .catch(function (err) {
                    console.warn('heic2any failed:', err);
                    container.innerHTML =
                        '<div class="heic-error">'
                        + '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="rgba(238,20,177,0.5)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>'
                        + '<span class="heic-error-text">Gagal memproses foto HEIC.<br><a href="' + src + '" download>Klik untuk unduh</a></span>'
                        + '</div>';
                });
        });
    });
    </script>
    @endif
</body>
</html>
