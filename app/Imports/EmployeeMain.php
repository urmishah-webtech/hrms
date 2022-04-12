<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\FirstSheetImport;
use App\Imports\SecondSheetImport;
use App\Imports\ThirdSheetImport;
use App\Imports\FourthSheetImport;

class EmployeeMain implements ToCollection,WithMultipleSheets
{
    public function sheets(): array
    {
        
        return [
            0 => new FirstSheetImport(),
           
        ];
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }
}
