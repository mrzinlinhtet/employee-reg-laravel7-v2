<?php

namespace App\DBTransactions\Employee;

use App\Models\Employee;
use App\Classes\DBTransaction;

/**
 *
 *
 * @author
 * @create
 */
/**
 * UpdateEmployee to update employee.
 * @author Zin Lin Htet
 * @created 28/06/2023
 */
class UpdateEmployee extends DBTransaction
{
    private $request, $id;

    public function __construct($request, $id)
    {
        $this->request = $request;
        $this->id = $id;
    }
    /**
     * Update the data of employee in DB
     * @author Zin Lin Htet
     * @create 28/06/2023
     * @return array
     */
    public function process()
    {
        $request = $this->request;
        $id = $this->id;
        // Get the specified employee
        $emp = Employee::find($id);
        $emp->employee_code = $request->employee_code;
        $emp->employee_name = $request->employee_name;
        $emp->nrc_number = $request->nrc_number;
        $emp->email_address = $request->email_address;
        $emp->gender = $request->gender;
        $emp->date_of_birth = $request->date_of_birth;
        $emp->marital_status = $request->marital_status;
        $emp->address = $request->address;
        $emp = $emp->update();

        if (session('employee')->id == $this->id) {
            //update session
            session()->put('employee', Employee::find($this->id));
        }

        if ($emp) {
            return ['status' => true, 'error' => ''];
        } else {
            return ['status' => false, 'error' => 'Failed to update employee'];
        }
    }
}
