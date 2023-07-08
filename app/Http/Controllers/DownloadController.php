<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Illuminate\Http\Request;
use App\Exports\DownloadExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Interfaces\EmployeeInterface;

/**
 * DownloadController to download excel and pdf file.
 * @author Zin Lin Htet
 * @created 26/6/2023
 */
class DownloadController extends Controller
{
    protected $employeeInterface;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(EmployeeInterface $employeeInterface)
    {
        $this->employeeInterface = $employeeInterface;
    }
    /**
     * If action Excel Download btn, call this function inorder to download in the list
     * @author Zin Lin Htet
     * @create 26/6/2023
     * @param Request $request
     * @return 'DownloadExport'
     */
    public function exportExcel(Request $request)
    {
        //perform search logic and fetch the relevant search results
        $searchEmployeeID = $request->input('search_employee_id');
        $searchEmployeeCode = $request->input('search_employee_code');
        $searchEmployeeName = $request->input('search_employee_name');
        $searchEmailAddress = $request->input('search_email_address');
        $employees = $this->employeeInterface->getAllEmployees($searchEmployeeID, $searchEmployeeCode, $searchEmployeeName, $searchEmailAddress);
        //download excel using DownloadExport class
        return Excel::download(new DownloadExport($employees), 'EmployeesList.xlsx');
    }

    /**
     * if action PDF Download btn, call this function inorder to download in the list
     * @author Zin Lin Htet
     * @create 26/6/2023
     * @param Request $request
     */
    public function downloadPDF(Request $request)
    {
        //perform search logic and fetch the relevant search results
        $searchEmployeeID = $request->input('search_employee_id');
        $searchEmployeeCode = $request->input('search_employee_code');
        $searchEmployeeName = $request->input('search_employee_name');
        $searchEmailAddress = $request->input('search_email_address');
        $employees = $this->employeeInterface->getAllEmployees($searchEmployeeID, $searchEmployeeCode, $searchEmployeeName, $searchEmailAddress);

        $html = view('employee.download-pdf', ['employees' => $employees])->render();
        $pdf = new Mpdf();
        $pdf->WriteHTML($html);
        //download pdf
        $pdf->Output('search-employees.pdf', 'D');
    }
}
