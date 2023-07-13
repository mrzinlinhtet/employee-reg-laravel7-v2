<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\EmployeeUpload;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EmployeeAuthRequest;

/**
 * EmployeeAuthController for login and logout.
 * @author Zin Lin Htet
 * @created 21/06/2023
 */
class EmployeeAuthController extends Controller
{
    /**
     * When employee login, call this function with passing EmployeeAuthRequest and goto Index page
     * @author Zin Lin Htet
     * @create 21/06/2023
     * @param EmployeeAuthRequest $request
     * @return 'redirect'
     */
    public function login(EmployeeAuthRequest $request)
    {
        $employee = Employee::where('employee_id', $request->employee_id)->first();
        if ($employee) {
            if (Hash::check($request->password, $employee->password)) {
                session()->put('employee', $employee);
                $photo = EmployeeUpload::where('employee_id', $employee->employee_id)->first();
                if ($photo) {
                    session()->put('photo', 'uploads/' . $photo->file_name);
                } else {
                    session()->put('photo', 'images/user.png');
                }
                return redirect()->route('employees.index');
            } else {
                return redirect()->back()->withErrors(['error' => 'Employee ID and password are not match!']);
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid employee ID or password!']);
        }
    }

    /**
     * When employee login, validation is not passed, call this function and goto Login page
     * @author Zin Lin Htet
     * @created 21/06/2023
     * @return 'view'
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * When employee logout, call this function with passing Request
     * @author Zin Lin Htet
     * @created 21/06/2023
     * @param Request $request
     * @return 'redirect'

     */
    public function logout(Request $request)
    {
        // Clear the employee's session
        session()->forget('employee');

        // Clear the previous route
        session()->forget('back-previous');

        // Redirect to the login page
        return redirect()->route('login.show');
    }
}
