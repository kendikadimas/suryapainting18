<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat Pesanan {{ $order->nomor_surat }} | SuryaPainting18</title>
    <style>
        /* ── Reset ──────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { font-size: 12pt; }
        body {
            font-family: 'Arial', 'Helvetica Neue', sans-serif;
            color: #111;
            background: #fff;
            padding: 0;
        }

        /* ── Print toolbar (screen only) ──────── */
        .print-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 14px 32px;
            background: #1a1a2e;
            color: #fff;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .print-toolbar span { font-size: 13px; opacity: 0.8; }
        .toolbar-actions { display: flex; gap: 10px; }
        .btn-print {
            display: inline-flex; align-items: center; gap: 8px;
            background: #ee14b1; color: #fff;
            border: none; padding: 10px 22px;
            font-family: Arial, sans-serif; font-size: 12px; font-weight: 700;
            letter-spacing: 1.5px; text-transform: uppercase;
            cursor: pointer; transition: background 0.2s;
        }
        .btn-print:hover { background: #c0108f; }
        .btn-back {
            display: inline-flex; align-items: center; gap: 8px;
            background: transparent; color: rgba(255,255,255,0.7);
            border: 1px solid rgba(255,255,255,0.2); padding: 10px 18px;
            font-family: Arial, sans-serif; font-size: 12px;
            cursor: pointer; text-decoration: none; transition: color 0.2s;
        }
        .btn-back:hover { color: #fff; border-color: rgba(255,255,255,0.5); }

        /* ── Document wrapper ──────────────────── */
        .document {
            max-width: 794px; /* A4 width */
            margin: 36px auto;
            padding: 48px 56px;
            background: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        }

        /* ── Letterhead ────────────────────────── */
        .letterhead {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;
            padding-bottom: 20px;
            border-bottom: 3px solid #1a1a2e;
            margin-bottom: 28px;
        }
        .letterhead-logo {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .logo-mark {
            width: 52px; height: 52px;
            background: #1a1a2e;
            display: flex; align-items: center; justify-content: center;
            color: #ee14b1;
            font-family: Arial, sans-serif;
            font-size: 22px; font-weight: 900;
            letter-spacing: -1px;
        }
        .company-name {
            font-size: 20pt;
            font-weight: 900;
            color: #1a1a2e;
            line-height: 1;
            letter-spacing: -0.5px;
        }
        .company-tagline {
            font-size: 8.5pt;
            color: #888;
            margin-top: 3px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .letterhead-right {
            text-align: right;
        }
        .doc-label {
            font-size: 8pt;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: #888;
        }
        .doc-number {
            font-size: 18pt;
            font-weight: 900;
            color: #1a1a2e;
            letter-spacing: 1px;
            margin-top: 2px;
        }
        .doc-date {
            font-size: 9pt;
            color: #666;
            margin-top: 4px;
        }

        /* ── Status banner ─────────────────────── */
        .status-banner {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 18px;
            margin-bottom: 28px;
            border-left: 4px solid #333;
            background: #f8f8f8;
        }
        .status-banner.pending    { border-color: #f6a800; background: #fffbeb; }
        .status-banner.processing { border-color: #1565c0; background: #eff6ff; }
        .status-banner.completed  { border-color: #1b5e20; background: #f0fdf4; }
        .status-banner.cancelled  { border-color: #b71c1c; background: #fff0f0; }
        .status-label {
            font-size: 8pt; font-weight: 700;
            letter-spacing: 2px; text-transform: uppercase; color: #888;
        }
        .status-text {
            font-size: 12pt; font-weight: 800; color: #1a1a2e;
        }
        .status-banner.pending    .status-text { color: #b58700; }
        .status-banner.processing .status-text { color: #1565c0; }
        .status-banner.completed  .status-text { color: #1b5e20; }
        .status-banner.cancelled  .status-text { color: #b71c1c; }

        /* ── Section heading ───────────────────── */
        .section-title {
            font-size: 8pt;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #888;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }
        .section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e5e5;
        }

        /* ── Info grid ─────────────────────────── */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            margin-bottom: 32px;
            border: 1px solid #e0e0e0;
        }
        .info-cell {
            padding: 10px 14px;
            border-right: 1px solid #e0e0e0;
            border-bottom: 1px solid #e0e0e0;
        }
        .info-cell:nth-child(even) { border-right: none; }
        .info-cell.full {
            grid-column: 1 / -1;
            border-right: none;
        }
        .info-cell:nth-last-child(1),
        .info-cell:nth-last-child(2):not(.full) {
            border-bottom: none;
        }
        .info-cell.full:last-child { border-bottom: none; }
        .cell-label {
            font-size: 7.5pt;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #999;
            display: block;
            margin-bottom: 3px;
        }
        .cell-value {
            font-size: 11pt;
            font-weight: 700;
            color: #1a1a2e;
            line-height: 1.3;
        }
        .cell-value.muted { font-weight: 400; color: #666; font-size: 10pt; }

        /* ── Timeline ──────────────────────────── */
        .timeline { margin-bottom: 32px; }
        .timeline-item {
            display: flex;
            gap: 16px;
            padding-bottom: 22px;
            position: relative;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 28px;
            bottom: 0;
            width: 1px;
            background: #e0e0e0;
        }
        .timeline-item:last-child::before { display: none; }
        .timeline-dot {
            width: 30px; height: 30px;
            background: #1a1a2e;
            flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            color: #ee14b1;
            font-size: 10pt;
            font-weight: 900;
            position: relative;
            z-index: 1;
        }
        .timeline-dot.first { background: #ee14b1; color: #fff; }
        .timeline-body { flex: 1; padding-top: 4px; }
        .timeline-title {
            font-size: 11pt; font-weight: 800;
            color: #1a1a2e;
            margin-bottom: 2px;
        }
        .timeline-date {
            font-size: 8pt; color: #999;
            font-weight: 600; letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .timeline-desc {
            font-size: 10pt; color: #444;
            line-height: 1.65;
        }
        .timeline-img {
            margin-top: 8px;
        }
        .timeline-img img {
            max-width: 220px;
            height: auto;
            border: 1px solid #e0e0e0;
            display: block;
        }

        /* ── Footer / Signature ────────────────── */
        .signature-section {
            margin-top: 40px;
            padding-top: 24px;
            border-top: 1px solid #e0e0e0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }
        .sig-box { text-align: center; }
        .sig-label {
            font-size: 8pt; font-weight: 700;
            letter-spacing: 1.5px; text-transform: uppercase;
            color: #888; margin-bottom: 60px;
        }
        .sig-line {
            border-top: 1px solid #333;
            padding-top: 6px;
            font-size: 9pt; color: #444;
        }
        .doc-footer {
            margin-top: 24px;
            text-align: center;
            font-size: 8pt;
            color: #aaa;
            border-top: 1px solid #eee;
            padding-top: 12px;
        }

        /* ── Print media query ─────────────────── */
        @media print {
            .print-toolbar { display: none !important; }
            body { padding: 0; background: #fff; }
            .document {
                max-width: 100%;
                margin: 0;
                padding: 24px 32px;
                border: none;
                box-shadow: none;
            }
            .info-grid { page-break-inside: avoid; }
            .timeline-item { page-break-inside: avoid; }
            .signature-section { page-break-inside: avoid; }
        }
        @page {
            size: A4 portrait;
            margin: 15mm 20mm;
        }
    </style>
</head>
<body>
    <!-- ── Print toolbar (hidden on print) ── -->
    <div class="print-toolbar">
        <span>Pratinjau Surat Pesanan &mdash; {{ $order->nomor_surat }}</span>
        <div class="toolbar-actions">
            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-back">
                ← Kembali
            </a>
            <button class="btn-print" onclick="window.print()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                Cetak / Print
            </button>
        </div>
    </div>

    <!-- ── Document ── -->
    <div class="document">

        <!-- Letterhead -->
        <div class="letterhead">
            <div class="letterhead-logo">
                <div class="logo-mark">S18</div>
                <div>
                    <div class="company-name">SuryaPainting18</div>
                    <div class="company-tagline">Jasa Pengecatan Motor Profesional</div>
                </div>
            </div>
            <div class="letterhead-right">
                <div class="doc-label">Nomor Surat</div>
                <div class="doc-number">{{ $order->nomor_surat }}</div>
                <div class="doc-date">{{ $order->created_at->translatedFormat('d F Y') }}</div>
            </div>
        </div>

        <!-- Status Banner -->
        @php
            $statusClass = strtolower($order->status);
            $statusText = match($order->status) {
                'Pending'    => 'Menunggu Pengerjaan',
                'Processing' => 'Sedang Dalam Pengerjaan',
                'Completed'  => 'Pengerjaan Selesai',
                'Cancelled'  => 'Pesanan Dibatalkan',
                default      => $order->status,
            };
        @endphp
        <div class="status-banner {{ $statusClass }}">
            <div>
                <div class="status-label">Status Pesanan</div>
                <div class="status-text">{{ $statusText }}</div>
            </div>
        </div>

        <!-- Customer & Order Info -->
        <div class="section-title">Detail Pelanggan &amp; Kendaraan</div>
        <div class="info-grid">
            <div class="info-cell">
                <span class="cell-label">Nama Pelanggan</span>
                <span class="cell-value">{{ $order->customer_name }}</span>
            </div>
            <div class="info-cell">
                <span class="cell-label">No. HP / WhatsApp</span>
                <span class="cell-value {{ $order->customer_phone ? '' : 'muted' }}">
                    {{ $order->customer_phone ?? '—' }}
                </span>
            </div>
            <div class="info-cell">
                <span class="cell-label">Nomor Plat</span>
                <span class="cell-value {{ $order->nomor_plat ? '' : 'muted' }}">
                    {{ $order->nomor_plat ?? '—' }}
                </span>
            </div>
            <div class="info-cell">
                <span class="cell-label">Tipe Motor</span>
                <span class="cell-value {{ $order->tipe_motor ? '' : 'muted' }}">
                    {{ $order->tipe_motor ?? '—' }}
                </span>
            </div>
            @if($order->detail_motor)
            <div class="info-cell full">
                <span class="cell-label">Detail Motor</span>
                <span class="cell-value">{{ $order->detail_motor }}</span>
            </div>
            @endif
            <div class="info-cell full">
                <span class="cell-label">Produk / Jasa yang Dipesan</span>
                <span class="cell-value">{{ $order->product_name }}</span>
            </div>
            <div class="info-cell">
                <span class="cell-label">Tanggal Masuk</span>
                <span class="cell-value">{{ $order->created_at->format('d/m/Y — H:i') }} WIB</span>
            </div>
            <div class="info-cell">
                <span class="cell-label">Jumlah Update Progress</span>
                <span class="cell-value">{{ $order->timeline->count() }} catatan</span>
            </div>
        </div>

        <!-- Timeline / Progress -->
        @if($order->timeline->isNotEmpty())
        <div class="section-title">Riwayat Progress Pengerjaan</div>
        <div class="timeline">
            @foreach($order->timeline as $i => $item)
            <div class="timeline-item">
                <div class="timeline-dot {{ $i === 0 ? 'first' : '' }}">{{ $i + 1 }}</div>
                <div class="timeline-body">
                    <div class="timeline-title">{{ $item->title }}</div>
                    <div class="timeline-date">{{ $item->created_at->format('d/m/Y, H:i') }} WIB</div>
                    @if($item->description)
                    <div class="timeline-desc">{{ $item->description }}</div>
                    @endif
                    @if($item->image_path)
                    <div class="timeline-img">
                        <img src="{{ asset('storage/' . $item->image_path) }}"
                             alt="Foto {{ $item->title }}">
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Signature -->
        <div class="signature-section">
            <div class="sig-box">
                <div class="sig-label">Penerima / Pelanggan</div>
                <div class="sig-line">
                    {{ $order->customer_name }}
                </div>
            </div>
            <div class="sig-box">
                <div class="sig-label">Teknisi / Admin SuryaPainting18</div>
                <div class="sig-line">
                    &nbsp;
                </div>
            </div>
        </div>

        <!-- Document footer -->
        <div class="doc-footer">
            &copy; {{ date('Y') }} SuryaPainting18 &mdash;
            Dokumen ini dicetak dari sistem pada {{ now()->format('d/m/Y H:i') }} WIB.
            Lacak progres: <strong>suryapainting18indonesia.com</strong>
        </div>

    </div><!-- /.document -->

    <script>
        // Auto-trigger print dialog when opened directly
        // Remove this if you prefer manual print click only
        // window.addEventListener('load', () => setTimeout(() => window.print(), 300));
    </script>
</body>
</html>
