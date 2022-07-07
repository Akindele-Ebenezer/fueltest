<?php

namespace App\Exports;

use App\Models\FuelTest;
use Maatwebsite\Excel\Concerns\FromCollection;

class FuelTestsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FuelTest::all();
    }
}
