<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class AttendanceCustomExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithStyles,
    WithColumnFormatting
{
    protected $records;
    private $rowNumber = 0;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        return $this->records;
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Nama Pegawai',
            'Departemen',
            'Jam Masuk',
            'Jam Pulang',
            'Kode Absen',
            'Kategori',
            'Telat (menit)',
            'Lembur (menit)',
            'Keterangan',
        ];
    }

    public function map($record): array
    {
        $this->rowNumber++;

        // Cari ulang data Masuk dan Pulang dari DB agar akurat
        $masuk = Attendance::where('user_id', $record->user_id)
            ->whereDate('created_at', $record->created_at->format('Y-m-d'))
            ->where('tipe_absen', 'Masuk')
            ->first();

        $pulang = Attendance::where('user_id', $record->user_id)
            ->whereDate('created_at', $record->created_at->format('Y-m-d'))
            ->where('tipe_absen', 'Pulang')
            ->first();

        $tanggal    = $record->created_at->format('d/m/Y');
        $nama       = $record->user->name ?? '-';
        $departemen = $record->user->department ?? '-';

        $jamMasuk   = $masuk  ? $masuk->created_at->format('H:i')  : '-';
        $jamPulang  = $pulang ? $pulang->created_at->format('H:i') : '-';

        // ======================================================
        // KODE ABSEN & KATEGORI
        // ======================================================
        $kode = $masuk?->kode_absen ?? $masuk?->status ?? $record->status ?? '-';

        $kodeInfo = Attendance::getKodeInfo($kode);
        $kodeDisplay = $kodeInfo
            ? "{$kode} — {$kodeInfo['label']}"
            : $kode;

        $kategori = $kodeInfo['kategori'] ?? '-';
        $kategoriDisplay = ucfirst($kategori);

        // ======================================================
        // TELAT & LEMBUR
        // ======================================================
        $menitTelat  = $masuk?->menit_telat ?? 0;
        $menitLembur = $pulang?->menit_lembur ?? 0;

        // ======================================================
        // KETERANGAN (HANYA NOTES — TANPA INFO TELAT)
        // ======================================================
        $keterangan = [];
        if ($masuk && $masuk->notes) {
            $keterangan[] = $masuk->notes;
        }
        if ($pulang && $pulang->notes && $pulang->notes !== ($masuk->notes ?? null)) {
            $keterangan[] = $pulang->notes;
        }
        $keteranganStr = count($keterangan) > 0 ? implode(' | ', $keterangan) : '-';

        return [
            $this->rowNumber,
            $tanggal,
            $nama,
            $departemen,
            $jamMasuk,
            $jamPulang,
            $kodeDisplay,
            $kategoriDisplay,
            $menitTelat > 0  ? $menitTelat  : '-',
            $menitLembur > 0 ? $menitLembur : '-',
            $keteranganStr,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'I' => '0', // Telat
            'J' => '0', // Lembur
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // ======================================================
        // HEADER STYLE
        // ======================================================
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => [
                'bold'  => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size'  => 11,
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2563EB'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(24);

        $lastRow = $sheet->getHighestRow();

        // ======================================================
        // BODY ALIGNMENT
        // ======================================================
        $sheet->getStyle("A2:K{$lastRow}")->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Kolom tengah
        foreach (['A', 'B', 'E', 'F', 'G', 'H', 'I', 'J'] as $col) {
            $sheet->getStyle("{$col}2:{$col}{$lastRow}")
                ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // ======================================================
        // WARNA KHUSUS KOLOM TELAT & LEMBUR
        // ======================================================
        $sheet->getStyle("I2:I{$lastRow}")->getFont()->getColor()->setRGB('DC2626');
        $sheet->getStyle("J2:J{$lastRow}")->getFont()->getColor()->setRGB('16A34A');

        // ======================================================
        // WARNA BARIS BERDASARKAN KODE ABSEN
        // ======================================================
        for ($row = 2; $row <= $lastRow; $row++) {
            $kodeCell = $sheet->getCell("G{$row}")->getValue();
            $kode = trim(explode('—', (string) $kodeCell)[0] ?? '');

            $kodeInfo = Attendance::getKodeInfo($kode);
            $warnaHex = null;

            if ($kodeInfo) {
                $warnaHex = match ($kodeInfo['warna']) {
                    'success' => 'DCFCE7',
                    'warning' => 'FEF3C7',
                    'danger'  => 'FEE2E2',
                    'info'    => 'DBEAFE',
                    'primary' => 'EDE9FE',
                    default   => 'F3F4F6',
                };
            }

            if ($warnaHex) {
                $sheet->getStyle("G{$row}:H{$row}")->applyFromArray([
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $warnaHex],
                    ],
                ]);
            }
        }

        // ======================================================
        // BORDER TABEL
        // ======================================================
        $sheet->getStyle("A1:K{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color'       => ['rgb' => 'D1D5DB'],
                ],
            ],
        ]);

        return [];
    }
}