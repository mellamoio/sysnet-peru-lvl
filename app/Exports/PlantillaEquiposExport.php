<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PlantillaEquiposExport implements FromArray, WithHeadings, WithStyles, WithColumnFormatting
{
    public function array(): array
    {
        return [
            [
                'imei'          => '123456789012345',
                'modelo'        => 'FMB920',
                'estado_id'     => 1,
                'disponible'    => 1,
                'observaciones' => 'Equipo nuevo en caja'
            ],
            [
                'imei'          => '987654321098765',
                'modelo'        => 'FMT100',
                'estado_id'     => 2,
                'disponible'    => 0,
                'observaciones' => 'Para revisión técnica'
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'imei',
            'modelo',
            'estado_id',
            'disponible',
            'observaciones'
        ];
    }

    /**
     * Formatear la columna A (IMEI) como Texto Explícito
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}