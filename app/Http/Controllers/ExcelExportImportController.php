<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportExcelRegister;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeeRegisterImport;

/**
 * Create ExcelExportImportController to excel export and import.
 * @author Zin Lin Htet
 * @created 23/6/2023
 */
class ExcelExportImportController extends Controller
{
    /**
     * Employee registration Excel file export
     * @author Zin Lin Htet
     * @create 23/6/2023
     * @return $excel
     */
    public function export()
    {
        $excel = Excel::download(new ExportExcelRegister, 'employee-registration.xlsx');
        return $excel;
    }

    /**
     * Employee registration Excel file import
     * @author Zin Lin Htet
     * @create 23/6/2023
     * @param Request $request
     * @return 'redirect'
     */
    public function import(ImportRequest $request)
    {
        try {
            //call EmployeeRegisterImport class and import
            $data = Excel::import(new EmployeeRegisterImport, request()->file('import_file'));
            return redirect()->back()->with('success', "Multi Employee registration is successfully.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
