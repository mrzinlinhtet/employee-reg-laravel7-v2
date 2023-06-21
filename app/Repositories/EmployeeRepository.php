<?php

namespace App\Repositories;

use App\Employee;
use App\Interfaces\EmployeeInterface;

/**
 * Data retrieving from employees
 * Create EmployeeRepository
 * @author Zin Lin Htet
 * @created 21/6/2023
 */
class EmployeeRepository implements EmployeeInterface
{
    /**
     * Get all data from employees table
     * @author Zin Lin Htet
     * @created 21/6/2023
     * @return object
     */
    public function getAllEmployees()
    {
        return Employee::all();
    }

    /**
     * Get one employee from employees table
     * @author Zin Lin Htet
     * @created 21/6/2023
     * @param $id
     * @return object
     */
    public function getEmployeeById($id)
    {
        return Employee::find($id);
    }

    /**
     * Use for pagination 20
     * @author Zin Lin Htet
     * @created 21/6/2023
     * @return object
     */
    public function pagination()
    {
        return Employee::paginate(20);
    }
}



?>
