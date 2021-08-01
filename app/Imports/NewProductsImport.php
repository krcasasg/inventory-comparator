<?php

namespace App\Imports;

use App\Models\NewProduct;
use App\Models\Option;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Throwable;


class NewProductsImport implements ToCollection, WithHeadingRow, SkipsOnError, SkipsOnFailure, WithCustomCsvSettings, WithChunkReading, ShouldQueue
{
    use Importable, SkipsErrors, SkipsFailures;

    /**
    * @param Collection $rows
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection( Collection $rows)
    {
        $option = Option::where(['name' => 'primary_key_new'])->first();

        $column_values = "Quantity On Hand";
        $column_values = strtolower(str_replace(' ', '_', $column_values));
        $column_key = strtolower(str_replace(' ', '_', $option->value));

        foreach ($rows as $row){

            if(!isset($row[$column_key])){
                return null;
            }

            NewProduct::updateOrCreate(
                ['key' => $row[$column_key]],
                ['quantity_on_hand' => $row[$column_values]]
            );

        }
    }

    public function onError(Throwable $e)
    {

    }

    public function getCsvSettings(): array
    {
        $csv_delimiter = Option::where('name', 'csv_delimiter')->first();
        $csv_enclosure = Option::where('name', 'csv_enclosure')->first();
        $csv_input_encoding = Option::where('name', 'csv_input_encoding')->first();
        return [
            'delimiter'        => $csv_delimiter->value ?? ';',
            'enclosure'        => $csv_enclosure->value ?? '"',
            'escape_character' => '\\',
            'contiguous'       => true,
            'input_encoding'   => $csv_input_encoding->value ?? 'UTF-8',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
