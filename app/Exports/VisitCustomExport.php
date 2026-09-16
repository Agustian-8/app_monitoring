<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VisitCustomExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
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
        // Kolom Foto Kunjungan dihilangkan dari header
        return [
            'No', 
            'Nama Sales', 
            'Toko/Klien', 
            'Waktu Kunjungan', 
            'Catatan'
        ];
    }

    public function map($record): array
    {
        $this->rowNumber++;

        // Data foto tidak lagi di-mapping ke dalam sel
        return [
            $this->rowNumber,
            $record->user->name ?? '-',
            $record->outlet->name ?? '-',
            $record->created_at ? $record->created_at->format('d/m/Y H:i') : '-',
            $record->notes ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}