<?php

namespace App\DBTransactions\Employee;

use App\Models\Employee;
use App\Classes\DBTransaction;
use Illuminate\Support\Facades\Hash;


/**
 *
 *
 * @author
 * @create
 */
/**
 * SaveEmployee to register employee.
 * @author Zin Lin Htet
 * @created 22/06/2023
 */
class SaveEmployee extends DBTransaction
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
    /**
     * Save the data of employee in DB
     * @author Zin Lin Htet
     * @create 22/06/2023
     * @return array
     */
    public function process()
    {
        $request = $this->request;
        $emp = new Employee();
        $emp->employee_id = $request->employee_id;
        $emp->employee_code = $request->employee_code;
        $emp->employee_name = $request->employee_name;
        $emp->nrc_number = $request->nrc_number;
        $emp->password = Hash::make($request->password);
        $emp->email_address = $request->email_address;
        $emp->gender = $request->gender;
        $emp->date_of_birth = $request->date_of_birth;
        $emp->marital_status = $request->marital_status;
        $emp->address = $request->address;
        $emp = $emp->save();

        if (!$emp) {
            return ['status' => false, 'error' => 'Failed'];
        }
        return ['status' => true, 'error' => ''];
    }
}
