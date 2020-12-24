<?php

namespace App\Exports;

use App\jual;
use Maatwebsite\Excel\Concerns\FromCollection;

class jualExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return jual::all();
    }
}
