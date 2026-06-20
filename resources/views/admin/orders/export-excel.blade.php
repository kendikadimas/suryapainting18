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

{{-- ── Data table ── --}}
<table class="data-table">
    <!-- Company banner (centered across all 12 columns) -->
    <tr>
        <td colspan="12" class="co-banner" align="center" style="text-align:center; border:none;">🎨 &nbsp; SuryaPainting18</td>
    </tr>
    <tr>
        <td colspan="12" class="co-sub" align="center" style="text-align:center; border:none;">Jasa Pengecatan Motor Profesional &nbsp;·&nbsp; suryapainting18indonesia.com</td>
    </tr>
    <tr>
        <td colspan="12" class="co-divider" style="background:#ee14b1; height:4px; font-size:1pt; border:none; padding:0;">&nbsp;</td>
    </tr>
    
    <!-- Spacer row -->
    <tr style="height:6px; font-size:1pt;">
        <td colspan="12" style="border:none;">&nbsp;</td>
    </tr>

    <!-- Report meta (centered across all 12 columns) -->
    <tr>
        <td colspan="12" class="meta-row" align="center" style="text-align:center; background:#f7f9fc; font-size:9pt; color:#555; padding:8px 10px; border-bottom:1px solid #dde4ef; border-top:none; border-left:none; border-right:none;">
            <span class="meta-label">Laporan&nbsp;:</span>&nbsp; Daftar Pesanan{{ $search ? ' &nbsp;·&nbsp; Filter: "' . e($search) . '"' : '' }}
            &nbsp;&nbsp;&nbsp;
            <span class="meta-label">Diekspor&nbsp;:</span>&nbsp; {{ now()->format('d/m/Y') }} pukul {{ now()->format('H:i') }} WIB
            &nbsp;&nbsp;&nbsp;
            <span class="meta-label">Total Pesanan&nbsp;:</span>&nbsp; <strong>{{ $orders->count() }}</strong>
        </td>
    </tr>

    <!-- Spacer row -->
    <tr style="height:12px; font-size:1pt;">
        <td colspan="12" style="border:none;">&nbsp;</td>
    </tr>

    <thead>
        <tr>
            <th rowspan="1" style="width:38px;" align="center">No.</th>
            <th align="center">Nomor Surat</th>
            <th align="center">Nama Pelanggan</th>
            <th align="center">No. HP / WhatsApp</th>
            <th align="center">Nomor Plat</th>
            <th align="center">Tipe Motor</th>
            <th align="center">Detail Motor</th>
            <th align="center">Produk / Jasa</th>
            <th style="width:90px;" align="center">Status</th>
            <th style="width:120px;" align="center">Durasi Pengerjaan</th>
            <th style="width:70px;" align="center">Update</th>
            <th style="width:110px;" align="center">Tanggal Masuk</th>
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

            // Calculate duration
            $duration = '—';
            if ($order->status === 'Completed') {
                $latestTimeline = $order->timeline->first(); // ordered by created_at desc
                $completionTime = $latestTimeline ? $latestTimeline->created_at : $order->updated_at;
                
                $diff = $order->created_at->diff($completionTime);
                $parts = [];
                if ($diff->d > 0) {
                    $parts[] = $diff->d . ' hari';
                }
                if ($diff->h > 0) {
                    $parts[] = $diff->h . ' jam';
                }
                if ($diff->i > 0 && $diff->d == 0) {
                    $parts[] = $diff->i . ' menit';
                }
                if (empty($parts)) {
                    $parts[] = '< 1 menit';
                }
                $duration = implode(' ', $parts);
            } elseif (in_array($order->status, ['Pending', 'Processing'])) {
                $duration = 'Dalam proses';
            }
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
            <td style="text-align:center;font-size:9.5pt;color:#333;">{{ $duration }}</td>
            <td class="col-count">{{ $order->timeline_count }}</td>
            <td class="col-date">{{ $order->created_at->format('d/m/Y') }}<br><span style="color:#aaa;font-size:8pt;">{{ $order->created_at->format('H:i') }}</span></td>
        </tr>
        @empty
        <tr>
            <td colspan="12" style="text-align:center;color:#aaa;padding:24px;font-style:italic;">
                Tidak ada data pesanan ditemukan.
            </td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="10" class="foot-label">Total Pesanan</td>
            <td class="foot-value">{{ $orders->count() }}</td>
            <td class="foot-value">&nbsp;</td>
        </tr>
        <!-- Document watermark/footer -->
        <tr>
            <td colspan="12" align="center" style="text-align:center; font-size:8pt; color:#bbb; padding:16px 6px 6px; border:none; border-top:1px solid #e0e8f4;">
                &copy; {{ date('Y') }} SuryaPainting18 &nbsp;&mdash;&nbsp; Dokumen ini digenerate otomatis oleh sistem pada {{ now()->format('d/m/Y H:i') }} WIB
            </td>
        </tr>
    </tfoot>
</table>

</body>
</html>
