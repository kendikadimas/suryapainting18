<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
    <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
    <meta charset="UTF-8">
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>Daftar Pesanan</x:Name>
                    <x:WorksheetOptions>
                        <x:DisplayGridlines/>
                        <x:Print>
                            <x:FitHeight>1</x:FitHeight>
                            <x:ValidPrinterInfo/>
                            <x:HorizontalResolution>600</x:HorizontalResolution>
                            <x:VerticalResolution>600</x:VerticalResolution>
                        </x:Print>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11pt; }
        table { border-collapse: collapse; width: 100%; }
        th {
            background-color: #1a1a2e;
            color: #ffffff;
            font-weight: bold;
            border: 1px solid #333;
            padding: 8px 12px;
            text-align: left;
            white-space: nowrap;
        }
        td {
            border: 1px solid #cccccc;
            padding: 6px 10px;
            vertical-align: top;
        }
        tr:nth-child(even) td { background-color: #f7f7f7; }
        tr:nth-child(odd) td { background-color: #ffffff; }
        .header-section {
            margin-bottom: 16px;
        }
        .company-name {
            font-size: 16pt;
            font-weight: bold;
            color: #1a1a2e;
        }
        .export-title {
            font-size: 13pt;
            color: #444;
            margin-top: 4px;
        }
        .export-meta {
            font-size: 9pt;
            color: #888;
            margin-top: 2px;
        }
        .status-pending    { color: #b58700; font-weight: bold; }
        .status-processing { color: #1565c0; font-weight: bold; }
        .status-completed  { color: #1b5e20; font-weight: bold; }
        .status-cancelled  { color: #b71c1c; font-weight: bold; }
        .badge-no  { text-align: center; font-weight: bold; color: #555; }
        .num-cell  { text-align: center; }
    </style>
</head>
<body>
    <div class="header-section">
        <div class="company-name">SuryaPainting18</div>
        <div class="export-title">Laporan Daftar Pesanan{{ $search ? ' — Pencarian: "' . $search . '"' : '' }}</div>
        <div class="export-meta">Diekspor pada: {{ now()->translatedFormat('d F Y, H:i') }} WIB &nbsp;|&nbsp; Total: {{ $orders->count() }} pesanan</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor Surat</th>
                <th>Nama Pelanggan</th>
                <th>No. HP / WhatsApp</th>
                <th>Nomor Plat</th>
                <th>Tipe Motor</th>
                <th>Detail Motor</th>
                <th>Produk / Jasa</th>
                <th>Status</th>
                <th>Jumlah Update</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $i => $order)
            <tr>
                <td class="num-cell">{{ $i + 1 }}</td>
                <td><strong>{{ $order->nomor_surat }}</strong></td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_phone ?? '-' }}</td>
                <td>{{ $order->nomor_plat ?? '-' }}</td>
                <td>{{ $order->tipe_motor ?? '-' }}</td>
                <td>{{ $order->detail_motor ?? '-' }}</td>
                <td>{{ $order->product_name }}</td>
                <td class="
                    @if($order->status === 'Pending')     status-pending
                    @elseif($order->status === 'Processing') status-processing
                    @elseif($order->status === 'Completed')  status-completed
                    @elseif($order->status === 'Cancelled')  status-cancelled
                    @endif
                ">
                    @if($order->status === 'Pending')      Menunggu
                    @elseif($order->status === 'Processing') Diproses
                    @elseif($order->status === 'Completed')  Selesai
                    @elseif($order->status === 'Cancelled')  Dibatalkan
                    @else {{ $order->status }}
                    @endif
                </td>
                <td class="num-cell">{{ $order->timeline_count }}</td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="11" style="text-align:center;color:#999;padding:20px;">Tidak ada data pesanan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <p style="margin-top:20px;font-size:9pt;color:#aaa;">
        &copy; {{ date('Y') }} SuryaPainting18 &mdash; Dokumen ini digenerate secara otomatis oleh sistem.
    </p>
</body>
</html>
