<?php

namespace App\Repositories;

use App\Models\EmployeeUpload;
use App\Interfaces\EmployeeUploadInterface;

/**
 * Data retrieving from employees
 * Create EmployeeRepository
 * @author Zin Lin Htet
 * @created 21/06/2023
 */
class EmployeeUploadRepository implements EmployeeUploadInterface
{
    /**
     * Get one employee data from employee upload table
     * @author Zin Lin Htet
     * @created 22/06/2023
     * @param $employee_id
     * @return object
     */
    public function getEmployeeUploadByEmpId($employee_id)
    {
        return EmployeeUpload::where('employee_id', $employee_id)->first();
    }

}
