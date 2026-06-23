<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithCustomStartCell, WithEvents
{
    protected $orders;
    protected $search;
    protected $startDate;
    protected $endDate;
    private $rowNumber = 0;

    public function __construct($orders, $search = null, $startDate = null, $endDate = null)
    {
        $this->orders = $orders;
        $this->search = $search;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return $this->orders;
    }

    public function startCell(): string
    {
        return 'A7';
    }

    public function headings(): array
    {
        return [
            'No.', 
            'Nomor Surat', 
            'Cabang',
            'Nama Pelanggan', 
            'No. HP / WhatsApp', 
            'Nomor Plat', 
            'Tipe Motor', 
            'Detail Motor', 
            'Produk / Jasa', 
            'Status', 
            'Durasi Pengerjaan', 
            'Update', 
            'Tanggal Masuk',
            'Tanggal Keluar'
        ];
    }

    public function map($order): array
    {
        $this->rowNumber++;

        // Calculate duration
        $duration = '—';
        if ($order->status === 'Completed') {
            $latestTimeline = $order->timeline->first();
            $completionTime = $latestTimeline ? $latestTimeline->created_at : $order->updated_at;
            
            $diff = $order->created_at->diff($completionTime);
            $parts = [];
            if ($diff->d > 0) $parts[] = $diff->d . ' hari';
            if ($diff->h > 0) $parts[] = $diff->h . ' jam';
            if ($diff->i > 0 && $diff->d == 0) $parts[] = $diff->i . ' menit';
            if (empty($parts)) $parts[] = '< 1 menit';
            $duration = implode(' ', $parts);
        } elseif (in_array($order->status, ['Pending', 'Processing'])) {
            $duration = 'Dalam proses';
        }

        $statusLabel = match($order->status) {
            'Pending'    => 'Menunggu',
            'Processing' => 'Diproses',
            'Completed'  => 'Selesai',
            'Cancelled'  => 'Dibatalkan',
            default      => $order->status,
        };

        return [
            $this->rowNumber,
            $order->nomor_surat,
            $order->cabang ?: '—',
            $order->customer_name,
            $order->customer_phone ?: '—',
            $order->nomor_plat ?: '—',
            $order->tipe_motor ?: '—',
            $order->detail_motor ?: '—',
            $order->product_name,
            $statusLabel,
            $duration,
            $order->timeline_count,
            $order->created_at->format('d/m/Y H:i'),
            in_array($order->status, ['Completed', 'Cancelled'])
                ? $order->updated_at->format('d/m/Y H:i')
                : '—'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,   // No
            'B' => 16,  // Nomor Surat
            'C' => 14,  // Cabang
            'D' => 24,  // Nama Pelanggan
            'E' => 20,  // WhatsApp
            'F' => 16,  // Nomor Plat
            'G' => 14,  // Tipe Motor
            'H' => 30,  // Detail Motor
            'I' => 24,  // Produk / Jasa
            'J' => 14,  // Status
            'K' => 20,  // Durasi Pengerjaan
            'L' => 10,  // Update
            'M' => 20,  // Tanggal Masuk
            'N' => 20,  // Tanggal Keluar
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->setShowGridlines(true);
                $totalRows = count($this->orders);
                $endRowIndex = 7 + $totalRows;

                // 1. Company Banner Header (Row 1)
                $sheet->mergeCells('A1:N1');
                $sheet->setCellValue('A1', 'SuryaPainting18');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                        'size' => 16,
                        'name' => 'Calibri',
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '3C096C'],
                    ],
                ]);
                $sheet->getRowDimension(1)->setRowHeight(35);

                // 2. Sub-banner (Row 2)
                $sheet->mergeCells('A2:N2');
                $sheet->setCellValue('A2', 'Jasa Pengecatan Motor Profesional  ·  suryapainting18indonesia.com');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'color' => ['rgb' => 'FFD166'],
                        'size' => 9.5,
                        'name' => 'Calibri',
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '5A189A'],
                    ],
                ]);
                $sheet->getRowDimension(2)->setRowHeight(20);

                // 3. Pink Divider (Row 3) - Now Yellow
                $sheet->mergeCells('A3:N3');
                $sheet->getStyle('A3')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFD166'],
                    ],
                ]);
                $sheet->getRowDimension(3)->setRowHeight(4);

                // 4. Spacer row (A4:L4)
                $sheet->getRowDimension(4)->setRowHeight(12);

                // 5. Meta Information Row (Row 5)
                $sheet->mergeCells('A5:N5');
                $metaText = 'Laporan: Daftar Pesanan';
                if ($this->search) $metaText .= ' | Filter: "' . $this->search . '"';
                if ($this->startDate) $metaText .= ' | Dari: ' . date('d/m/Y', strtotime($this->startDate));
                if ($this->endDate) $metaText .= ' | Sampai: ' . date('d/m/Y', strtotime($this->endDate));
                $metaText .= ' | Diekspor: ' . now()->format('d/m/Y H:i') . ' WIB | Total Pesanan: ' . $totalRows;
                
                $sheet->setCellValue('A5', $metaText);
                $sheet->getStyle('A5')->applyFromArray([
                    'font' => [
                        'size' => 9,
                        'color' => ['rgb' => '444444'],
                        'name' => 'Calibri',
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'F6F2FC'],
                    ],
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'E5DCF2'],
                        ],
                    ],
                ]);
                $sheet->getRowDimension(5)->setRowHeight(22);

                // Spacer row (A6:L6)
                $sheet->getRowDimension(6)->setRowHeight(12);

                // 6. Headers Styling (Row 7)
                for ($col = 1; $col <= 14; $col++) {
                    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
                    $sheet->getStyle($colLetter . '7')->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'color' => ['rgb' => 'FFFFFF'],
                            'size' => 10,
                            'name' => 'Calibri',
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER,
                            'wrapText' => true,
                        ],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => '3C096C'],
                        ],
                        'borders' => [
                            'outline' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => '240046'],
                            ],
                        ],
                    ]);
                }
                $sheet->getRowDimension(7)->setRowHeight(25);

                // 7. Data Styling (Rows 8 to endRowIndex)
                for ($r = 8; $r <= $endRowIndex; $r++) {
                    $bgColor = (($r - 8) % 2 === 0) ? 'FFFFFF' : 'F6F2FC';
                    
                    $statusVal = $sheet->getCell("I{$r}")->getValue();
                    $statusBg = 'FFFFFF';
                    $statusText = '000000';
                    
                    if ($statusVal === 'Menunggu') {
                        $statusBg = 'FEFCE8';
                        $statusText = '854D0E';
                    } elseif ($statusVal === 'Diproses') {
                        $statusBg = 'EFF6FF';
                        $statusText = '1E40AF';
                    } elseif ($statusVal === 'Selesai') {
                        $statusBg = 'F0FDF4';
                        $statusText = '166534';
                    } elseif ($statusVal === 'Dibatalkan') {
                        $statusBg = 'FFF0F0';
                        $statusText = '991B1B';
                    }

                    for ($c = 1; $c <= 14; $c++) {
                        $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($c);
                        $cellRef = $colLetter . $r;

                        $style = [
                            'font' => [
                                'size' => 9.5,
                                'name' => 'Calibri',
                            ],
                            'alignment' => [
                                'vertical' => Alignment::VERTICAL_CENTER,
                            ],
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => $bgColor],
                            ],
                            'borders' => [
                                'outline' => [
                                    'borderStyle' => Border::BORDER_THIN,
                                    'color' => ['rgb' => 'E5DCF2'],
                                ],
                            ],
                        ];

                        if (in_array($c, [1, 2, 3, 6, 7, 11, 12, 13, 14])) {
                            $style['alignment']['horizontal'] = Alignment::HORIZONTAL_CENTER;
                        }
                        if ($c === 2) {
                            $style['font']['bold'] = true;
                            $style['font']['color'] = ['rgb' => '3C096C'];
                        }
                        if ($c === 4) {
                            $style['font']['bold'] = true;
                        }
                        if ($c === 5) {
                            $style['font']['color'] = ['rgb' => '1A7A3A'];
                        }
                        if ($c === 10) {
                            $style['fill']['startColor']['rgb'] = $statusBg;
                            $style['font']['color'] = ['rgb' => $statusText];
                            $style['font']['bold'] = true;
                            $style['alignment']['horizontal'] = Alignment::HORIZONTAL_CENTER;
                        }
                        if ($c === 12) {
                            $style['font']['bold'] = true;
                            $style['font']['color'] = ['rgb' => '3C096C'];
                        }

                        $sheet->getStyle($cellRef)->applyFromArray($style);
                    }
                    $sheet->getRowDimension($r)->setRowHeight(20);
                }

                // 8. Footer Row (Row endRowIndex + 1)
                $footRow = $endRowIndex + 1;
                $sheet->mergeCells("A{$footRow}:K{$footRow}");
                $sheet->setCellValue("A{$footRow}", 'Total Pesanan');
                $sheet->setCellValue("L{$footRow}", $totalRows);
                $sheet->setCellValue("M{$footRow}", '');
                $sheet->setCellValue("N{$footRow}", '');

                $footerStyle = [
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                        'size' => 10,
                        'name' => 'Calibri',
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '3C096C'],
                    ],
                    'borders' => [
                        'outline' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '240046'],
                        ],
                    ],
                ];

                for ($c = 1; $c <= 14; $c++) {
                    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($c);
                    $sheet->getStyle($colLetter . $footRow)->applyFromArray($footerStyle);
                }
                $sheet->getStyle("A{$footRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle("A{$footRow}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle("L{$footRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("L{$footRow}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle("L{$footRow}")->applyFromArray([
                    'font' => ['color' => ['rgb' => 'FFD166']],
                ]);

                $sheet->getRowDimension($footRow)->setRowHeight(22);

                // 9. Watermark Row (Row endRowIndex + 2)
                $watermarkRow = $footRow + 1;
                $sheet->mergeCells("A{$watermarkRow}:N{$watermarkRow}");
                $sheet->setCellValue("A{$watermarkRow}", '© ' . date('Y') . ' SuryaPainting18  ·  Dokumen ini digenerate otomatis oleh sistem pada ' . now()->format('d/m/Y H:i') . ' WIB');
                $sheet->getStyle("A{$watermarkRow}")->applyFromArray([
                    'font' => [
                        'size' => 8,
                        'color' => ['rgb' => 'BBBBBB'],
                        'name' => 'Calibri',
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'E5DCF2'],
                        ],
                    ],
                ]);
                $sheet->getRowDimension($watermarkRow)->setRowHeight(25);
            }
        ];
    }
}
