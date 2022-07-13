<?php

namespace App\Exports;

use App\Models\FuelTest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class FuelTestsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('fuel_test_records')->orderBy('SampleNo', 'desc')->get();
    }
}
