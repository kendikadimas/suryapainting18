<html>
<head>
    <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
    <meta charset="UTF-8">
    <style>
        * { font-family: Calibri, Arial, sans-serif; }

        /* ── Company header ─────────────────── */
        .co-banner {
            background: #0f2a4a;
            color: #ffffff;
            font-size: 18pt;
            font-weight: bold;
            text-align: center;
            padding: 14px 10px 6px;
            letter-spacing: 1px;
        }
        .co-sub {
            background: #163d6e;
            color: #a8c8f0;
            font-size: 9pt;
            text-align: center;
            padding: 4px 10px 12px;
            letter-spacing: 0.5px;
        }
        .co-divider {
            background: #ee14b1;
            height: 4px;
            font-size: 1pt;
        }

        /* ── Report meta ────────────────────── */
        .meta-row {
            background: #f7f9fc;
            font-size: 9pt;
            color: #555;
            padding: 5px 10px;
            border-bottom: 1px solid #dde4ef;
        }
        .meta-label {
            color: #999;
            font-weight: bold;
        }

        /* ── Table ──────────────────────────── */
        table.data-table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 12px;
        }

        /* Column headers */
        table.data-table thead th {
            background: #0f2a4a;
            color: #ffffff;
            font-size: 10pt;
            font-weight: bold;
            text-align: center;
            padding: 9px 12px;
            border: 1px solid #1a4070;
            white-space: nowrap;
            vertical-align: middle;
        }
        /* Second header row (sub-labels, optional accent) */
        table.data-table thead tr.subhead th {
            background: #1c4080;
            color: #b8d0f0;
            font-size: 8pt;
            font-weight: normal;
            padding: 4px 10px;
            border: 1px solid #1a4070;
        }

        /* Data rows */
        table.data-table tbody tr.row-odd td {
            background: #ffffff;
        }
        table.data-table tbody tr.row-even td {
            background: #eef4fb;
        }
        table.data-table tbody td {
            border: 1px solid #c8d8ec;
            padding: 7px 11px;
            font-size: 10pt;
            vertical-align: middle;
        }

        /* No. column */
        .col-no {
            text-align: center;
            color: #666;
            font-size: 9pt;
            width: 36px;
        }
        /* Nomor surat */
        .col-code {
            font-weight: bold;
            color: #0f2a4a;
            text-align: center;
            white-space: nowrap;
            font-size: 10pt;
        }
        /* Phone */
        .col-phone { color: #1a7a3a; font-size: 9.5pt; }
        /* Date */
        .col-date { color: #555; font-size: 9pt; white-space: nowrap; text-align: center; }
        /* Count */
        .col-count { text-align: center; font-weight: bold; color: #0f2a4a; }

        /* Status cells */
        .status-pending {
            background: #fefce8 !important;
            color: #854d0e;
            font-weight: bold;
            text-align: center;
            border-left: 3px solid #eab308 !important;
        }
        .status-processing {
            background: #eff6ff !important;
            color: #1e40af;
            font-weight: bold;
            text-align: center;
            border-left: 3px solid #3b82f6 !important;
        }
        .status-completed {
            background: #f0fdf4 !important;
            color: #166534;
            font-weight: bold;
            text-align: center;
            border-left: 3px solid #22c55e !important;
        }
        .status-cancelled {
            background: #fff0f0 !important;
            color: #991b1b;
            font-weight: bold;
            text-align: center;
            border-left: 3px solid #ef4444 !important;
        }

        /* Footer / summary row */
        table.data-table tfoot td {
            background: #0f2a4a;
            color: #ffffff;
            font-weight: bold;
            font-size: 10pt;
            padding: 9px 12px;
            border: 1px solid #1a4070;
        }
        table.data-table tfoot td.foot-label {
            text-align: right;
            letter-spacing: 0.5px;
        }
        table.data-table tfoot td.foot-value {
            text-align: center;
            color: #a8d8f0;
        }

        /* Caption / watermark footer */
        .doc-footer {
            margin-top: 14px;
            font-size: 8pt;
            color: #bbb;
            text-align: center;
            padding: 6px;
            border-top: 1px solid #e0e8f4;
        }
    </style>
</head>
<body>

{{-- ── Company banner ── --}}
<table width="100%" cellpadding="0" cellspacing="0">
    <tr><td class="co-banner">🎨 &nbsp; SuryaPainting18</td></tr>
    <tr><td class="co-sub">Jasa Pengecatan Motor Profesional &nbsp;·&nbsp; suryapainting18indonesia.com</td></tr>
    <tr><td class="co-divider">&nbsp;</td></tr>
</table>

{{-- ── Report meta ── --}}
<table width="100%" cellpadding="0" cellspacing="0" style="margin-top:8px;">
    <tr>
        <td class="meta-row">
            <span class="meta-label">Laporan&nbsp;:</span>&nbsp; Daftar Pesanan{{ $search ? ' &nbsp;·&nbsp; Filter: "' . e($search) . '"' : '' }}
            &nbsp;&nbsp;&nbsp;
            <span class="meta-label">Diekspor&nbsp;:</span>&nbsp; {{ now()->format('d/m/Y') }} pukul {{ now()->format('H:i') }} WIB
            &nbsp;&nbsp;&nbsp;
            <span class="meta-label">Total Pesanan&nbsp;:</span>&nbsp; <strong>{{ $orders->count() }}</strong>
        </td>
    </tr>
</table>

{{-- ── Data table ── --}}
<table class="data-table">
    <thead>
        <tr>
            <th rowspan="1" style="width:38px;">No.</th>
            <th>Nomor Surat</th>
            <th>Nama Pelanggan</th>
            <th>No. HP / WhatsApp</th>
            <th>Nomor Plat</th>
            <th>Tipe Motor</th>
            <th>Detail Motor</th>
            <th>Produk / Jasa</th>
            <th style="width:90px;">Status</th>
            <th style="width:70px;">Update</th>
            <th style="width:110px;">Tanggal Masuk</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $i => $order)
        @php
            $rowClass = ($i % 2 === 0) ? 'row-odd' : 'row-even';
            $statusClass = match($order->status) {
                'Pending'    => 'status-pending',
                'Processing' => 'status-processing',
                'Completed'  => 'status-completed',
                'Cancelled'  => 'status-cancelled',
                default      => '',
            };
            $statusLabel = match($order->status) {
                'Pending'    => 'Menunggu',
                'Processing' => 'Diproses',
                'Completed'  => 'Selesai',
                'Cancelled'  => 'Dibatalkan',
                default      => $order->status,
            };
        @endphp
        <tr class="{{ $rowClass }}">
            <td class="col-no">{{ $i + 1 }}</td>
            <td class="col-code">{{ $order->nomor_surat }}</td>
            <td style="font-weight:600;">{{ $order->customer_name }}</td>
            <td class="col-phone">{{ $order->customer_phone ?: '—' }}</td>
            <td style="text-align:center;">{{ $order->nomor_plat ?: '—' }}</td>
            <td style="text-align:center;">{{ $order->tipe_motor ?: '—' }}</td>
            <td style="font-size:9.5pt;color:#444;">{{ $order->detail_motor ?: '—' }}</td>
            <td>{{ $order->product_name }}</td>
            <td class="{{ $statusClass }}">{{ $statusLabel }}</td>
            <td class="col-count">{{ $order->timeline_count }}</td>
            <td class="col-date">{{ $order->created_at->format('d/m/Y') }}<br><span style="color:#aaa;font-size:8pt;">{{ $order->created_at->format('H:i') }}</span></td>
        </tr>
        @empty
        <tr>
            <td colspan="11" style="text-align:center;color:#aaa;padding:24px;font-style:italic;">
                Tidak ada data pesanan ditemukan.
            </td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="9" class="foot-label">Total Pesanan</td>
            <td class="foot-value">{{ $orders->count() }}</td>
            <td class="foot-value">&nbsp;</td>
        </tr>
    </tfoot>
</table>

<div class="doc-footer">
    &copy; {{ date('Y') }} SuryaPainting18 &nbsp;&mdash;&nbsp; Dokumen ini digenerate otomatis oleh sistem pada {{ now()->format('d/m/Y H:i') }} WIB
</div>

</body>
</html>
