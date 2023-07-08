<?php

namespace App\Exports;

use App\Exports\GenderExport;
use App\Exports\EmployeeExport;
use App\Exports\MaritalStatusExport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * ExportExcelRegister to call the sheets WithMultipleSheets
 * @author Zin Lin Htet
 * @created 23/6/2023
 */
class ExportExcelRegister implements WithMultipleSheets
{
    /**
     * @return \Illuminate\Support\Collection
     */

    /**
     * Call EmployeeRegistration,Gender and Marital Status to export
     * @author Zin Lin Htet
     * @create 23/6/2023
     * @return array
     */
    public function sheets(): array
    {
        return [
            'EmployeeRegistration' => new EmployeeExport(),
            'Gender' => new GenderExport(),
            'Marital Status' => new MaritalStatusExport(),
        ];
    }
}
