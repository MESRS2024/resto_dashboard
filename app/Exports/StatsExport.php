<?php

namespace App\Exports;

use App\Models\Mealstats;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;


class StatsExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        return Mealstats::all();
    }


    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'create_date',	'resto_name',	'dou_code',	'id',	'id_progres',	'count',	'breakfast',	'launch',	'dinner'
        ];
    }
}
