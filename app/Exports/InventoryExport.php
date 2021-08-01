<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class InventoryExport extends StringValueBinder implements FromArray, WithHeadings, WithColumnFormatting, ShouldAutoSize, WithCustomValueBinder
{
    //array of items
    protected $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * @return array
     * return array items
     */
    public function array(): array
    {
        return $this->items;
    }

    /**
     * @return string[]
     * Headings for excel export
     */
    public function headings(): array
    {
        return [
            'key',
            'quantity old',
            'quantity',
            'status'
        ];
    }

    /**
     * @return array
     * set options display columns
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_GENERAL,
            'C' => NumberFormat::FORMAT_GENERAL,
            'D' => NumberFormat::FORMAT_TEXT,
        ];
    }



}
