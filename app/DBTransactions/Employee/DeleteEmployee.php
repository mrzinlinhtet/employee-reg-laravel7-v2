<?php

namespace App\DBTransactions\Employee;

use App\Models\Employee;
use App\Classes\DBTransaction;
use App\Models\EmployeeUpload;
use Illuminate\Support\Facades\File;


/**
 *
 *
 * @author
 * @create
 */
/**
 * DeleteEmployee to delete employee.
 * @author Zin Lin Htet
 * @created 22/6/2023
 */
class DeleteEmployee extends DBTransaction
{
    private $id;


    public function __construct($id)
    {
        $this->id = $id;
    }
    /**
     * Delete the data of employee in DB
     * @author Zin Lin Htet
     * @create 22/6/2023
     * @return array
     */
    public function process()
    {
        $id = $this->id;
        $employee = Employee::find($id);

        // Update the employee's photo data in the database
        $employeeUpload = EmployeeUpload::where("employee_id", $employee->employee_id)->first();
        $emp = $employee->forceDelete();

        if ($employeeUpload) {
            // Delete the old photo file
            $oldFilePath = public_path('uploads') . '/' . $employeeUpload->file_name;
            File::delete($oldFilePath);
        }

        if (!$emp) {
            return ['status' => false, 'error' => 'Failed'];
        }
        return ['status' => true, 'error' => ''];
    }
}
