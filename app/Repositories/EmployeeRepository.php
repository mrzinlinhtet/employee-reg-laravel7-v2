<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Interfaces\EmployeeInterface;

/**
 * Data retrieving from employees
 * Create EmployeeRepository
 * @author Zin Lin Htet
 * @created 21/06/2023
 */
class EmployeeRepository implements EmployeeInterface
{
    /**
     * Get all data from employees table with the condition
     * @author Zin Lin Htet
     * @created 21/06/2023
     * @return object
     */
    public function getAllEmployees($searchEmployeeID = null, $searchEmployeeCode = null, $searchEmployeeName = null, $searchEmailAddress = null)
    {
        $query = Employee::query()->withTrashed();

        $query->when(!empty($searchEmployeeID), function ($query) use ($searchEmployeeID) {
            return $query->where('employee_id', 'LIKE', '%' . $searchEmployeeID . '%');
        });

        $query->when(!empty($searchEmployeeCode), function ($query) use ($searchEmployeeCode) {
            return $query->where('employee_code', 'LIKE', '%' . $searchEmployeeCode . '%');
        });

        $query->when(!empty($searchEmployeeName), function ($query) use ($searchEmployeeName) {
            return $query->where('employee_name', 'LIKE', '%' . $searchEmployeeName . '%');
        });

        $query->when(!empty($searchEmailAddress), function ($query) use ($searchEmailAddress) {
            return $query->where('email_address', 'LIKE', '%' . $searchEmailAddress . '%');
        });


        return $query->orderBy('id', 'desc')->paginate(20)->appends([
            'search_employee_id' => $searchEmployeeID,
            'search_employee_code' => $searchEmployeeCode,
            'search_employee_name' => $searchEmployeeName,
            'search_email_address' => $searchEmailAddress
        ]);
    }

    /**
     * Get all data from employees table with the condition for download
     * @author Zin Lin Htet
     * @created 21/06/2023
     * @return object
     */
    public function getDownloadEmployees($searchEmployeeID = null, $searchEmployeeCode = null, $searchEmployeeName = null, $searchEmailAddress = null)
    {
        $query = Employee::query()->withTrashed();

        $query->when(!empty($searchEmployeeID), function ($query) use ($searchEmployeeID) {
            return $query->where('employee_id', 'LIKE', '%' . $searchEmployeeID . '%');
        });

        $query->when(!empty($searchEmployeeCode), function ($query) use ($searchEmployeeCode) {
            return $query->where('employee_code', 'LIKE', '%' . $searchEmployeeCode . '%');
        });

        $query->when(!empty($searchEmployeeName), function ($query) use ($searchEmployeeName) {
            return $query->where('employee_name', 'LIKE', '%' . $searchEmployeeName . '%');
        });

        $query->when(!empty($searchEmailAddress), function ($query) use ($searchEmailAddress) {
            return $query->where('email_address', 'LIKE', '%' . $searchEmailAddress . '%');
        });


        return $query->orderBy('id', 'desc')->get();
    }

    /**
     * Get one employee from employees table
     * @author Zin Lin Htet
     * @created 21/06/2023
     * @param $id
     * @return object
     */
    public function getEmployeeById($id)
    {
        return Employee::withTrashed()->find($id);
    }

    /**
     * Use for row count of all employees
     * @author Zin Lin Htet
     * @created 21/06/2023
     * @return object
     */
    public function count()
    {
        return Employee::withTrashed()->count();
    }

    /**
     * Use for previous page
     * @author Zin Lin Htet
     * @created 21/06/2023
     * @return object
     */
}
