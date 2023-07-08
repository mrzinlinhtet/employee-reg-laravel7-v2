<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Interfaces\EmployeeInterface;
use App\Http\Requests\EmployeeRequest;
use App\Interfaces\EmployeeUploadInterface;
use App\Http\Requests\EmployeeUpdateRequest;
use App\DBTransactions\Employee\SaveEmployee;
use App\DBTransactions\Employee\DeleteEmployee;
use App\DBTransactions\Employee\UpdateEmployee;
use App\DBTransactions\EmployeeUpload\SaveEmployeeUpload;
use App\DBTransactions\EmployeeUpload\UpdateEmployeeUpload;

/**
 * EmployeeController for register employees.
 * @author Zin Lin Htet
 * @created 22/6/2023
 */
class EmployeeController extends Controller
{
    protected $employeeInterface;
    protected $employeeUploadInterface;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(EmployeeInterface $employeeInterface, EmployeeUploadInterface $employeeUploadInterface)
    {
        $this->employeeInterface = $employeeInterface;
        $this->employeeUploadInterface = $employeeUploadInterface;
    }

    /**
     * Display a listing of all employee orderby id, desc and pagination
     * @author Zin Lin Htet
     * @create 28/6/2023
     * @param object
     * @return 'view'
     */
    public function index(Request $request)
    {
        //perform search logic and fetch the relevant search results
        $searchEmployeeID = $request->input('search_employee_id');
        $searchEmployeeCode = $request->input('search_employee_code');
        $searchEmployeeName = $request->input('search_employee_name');
        $searchEmailAddress = $request->input('search_email_address');
        $employees = $this->employeeInterface->getAllEmployees($searchEmployeeID, $searchEmployeeCode, $searchEmployeeName, $searchEmailAddress);
        $counts = $this->employeeInterface->count();
        //return view
        return view('employee.index', ['employees' => $employees, 'counts' => $counts, 'search_employee_id' => $searchEmployeeID, 'search_employee_code' => $searchEmployeeCode, 'search_employee_name' => $searchEmployeeName, 'search_email_address' => $searchEmailAddress]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * When register employee, call this function with auto increase employee_id
     * @author Zin Lin Htet
     * @create 22/6/2023
     * @param object
     * @return 'view'
     */
    public function create()
    {
        //get employee_id with latest
        $employee_id = Employee::latest('id')->withTrashed()->value('id');
        $empId = $employee_id + 10001;
        return view('employee.create', ['empId' => $empId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * When register employee successfully, call this function and store in DB
     * @author Zin Lin Htet
     * @create 22/6/2023
     * @param EmployeeRequest $request
     * @return 'redirect'
     */
    public function store(EmployeeRequest $request)
    {
        //call SaveEmployee from DBTransactions
        $saveEmployee = new SaveEmployee($request);
        $saveEmployee = $saveEmployee->executeProcess();

        //photo optional condition
        if ($request->file('photo')) {
            //call SaveEmployeeUpload from DBTransactions
            $saveEmployeeUpload = new SaveEmployeeUpload($request);
            $saveEmployeeUpload = $saveEmployeeUpload->executeProcess();

            if ($saveEmployee && $saveEmployeeUpload) {
                return redirect()->route('employees.index')->with('success', "Employee created successfully");
            } else {
                return redirect()->route('employees.index')->with('error', "Employee created Failed!");
            }
        }

        if ($saveEmployee) {
            return redirect()->route('employees.index')->with('success', "Employee created successfully");
        } else {
            return redirect()->route('employees.index')->with('error', "Employee created Failed!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified employee.
     * @author Zin Lin Htet
     * @create 26/6/2023
     * @param $id
     * @return 'view'
     */
    public function show($id)
    {
        //Get required employee
        $employee = $this->employeeInterface->getEmployeeById($id);
        if ($employee) {
            $emp_id = $this->employeeUploadInterface->getEmployeeUploadByEmpId($employee->employee_id);
            return view('employee.show', ['employee' => $employee, 'emp_id' => $emp_id]);
        }
        return redirect()->back()->with('error', ' Employee does not exist!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified employee.
     * @author Zin Lin Htet
     * @create 26/6/2023
     * @param $id
     * @return 'view'
     */
    public function edit($id)
    {
        //Get required employee
        $employee = $this->employeeInterface->getEmployeeById($id);
        //to restrict inactive employee to edit
        if ($employee->deleted_at != null) {
            return redirect()->back()->with('error', ' Cannot edit inactive Employee!');
        }
        if ($employee) {
            $emp_id = $this->employeeUploadInterface->getEmployeeUploadByEmpId($employee->employee_id);
            return view('employee.edit', ['employee' => $employee, 'emp_id' => $emp_id]);
        }
        return redirect()->back()->with('error', ' Employee does not exist!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified employee.
     * @author Zin Lin Htet
     * @create 26/6/2023
     * @param Request $request, $id
     * @return 'redirect'
     */
    public function update(EmployeeUpdateRequest $request, $id)
    {
        $previousPage = $this->employeeInterface->previousPage($id);
        // Call UpdateEmployee from DBTransactions
        $updateEmployee = new UpdateEmployee($request, $id);
        $updateResult = $updateEmployee->executeProcess();

        // Check if a new photo is being uploaded
        if ($request->hasFile('photo')) {
            // Call UpdateEmployeeUpload from DBTransactions
            $photoExist = $this->employeeUploadInterface->getEmployeeUploadByEmpId($request->employee_id);
            if ($photoExist) {
                $updateEmployeeUpload = new UpdateEmployeeUpload($request, $id);
                $updateEmployeeUpload = $updateEmployeeUpload->executeProcess();
                if ($updateResult && $updateEmployeeUpload) {
                    return redirect()->route('employees.index', ['page' => $previousPage])->with('success', "Employee updated successfully");
                } else {
                    return redirect()->route('employees.index')->with('error', "Employee updated Failed!");
                }
            } elseif (!$photoExist) {
                //call SaveEmployeeUpload from DBTransactions
                $saveEmployeeUpload = new SaveEmployeeUpload($request);
                $saveEmployeeUpload = $saveEmployeeUpload->executeProcess();
                if ($updateResult && $saveEmployeeUpload) {
                    return redirect()->route('employees.index', ['page' => $previousPage])->with('success', "Employee updated successfully");
                } else {
                    return redirect()->route('employees.index')->with('error', "Employee updated Failed!");
                }
            }
        }

        // Handle the result of the updates
        if ($updateResult) {
            return redirect()->route('employees.index', ['page' => $previousPage])->with('success', "Employee updated successfully");
        } else {
            return redirect()->route('employees.index')->with('error', "Employee updated Failed!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */

    /**
     * Delete the specified employee.
     * @author Zin Lin Htet
     * @create 26/6/2023
     * @param $id
     * @return 'redirect'
     */
    public function destroy($id)
    {
        $employee = $this->employeeInterface->getEmployeeById($id);
        if (!$employee) {
            return redirect()->back()->with('error', ' Employee deleted Failed!');
        }
        //to restrict to delete current login employee
        if (session('employee')->id == $id) {
            return redirect()->back()->with('error', ' Cannot delete the current login Employee!');
        }
        //to restrict to delete inactive employee
        if ($employee->deleted_at != null) {
            return redirect()->back()->with('error', ' Cannot delete the inactive Employee!');
        }
        if ($employee) {
            $deleteEmployee = new DeleteEmployee($id);
            $deleteEmp = $deleteEmployee->executeProcess();
            if ($deleteEmp) {
                return redirect()->back()->with('success', ' Employee has been deleted!');
            } else {
                return redirect()->back()->with('error', ' Employee deleted Failed!');
            }
        }
        return redirect()->back()->with('error', ' Employee does not exist!');
    }

    /**
     *  Restore employee data
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Restore the specified employee.
     * @author Zin Lin Htet
     * @create 28/6/2023
     * @param $id
     * @return 'redirect'
     */
    public function restore($id)
    {
        $employee = $this->employeeInterface->getEmployeeById($id);
        //to restrict active employee to active again
        if ($employee->deleted_at == null) {
            return redirect()->back()->with('error', ' Employee already active!');
        }
        if ($employee) {
            $employee->restore();
            return redirect()->back()->with('success', "Employee active successfully.");
        }
        return redirect()->back()->with('error', ' Employee does not exist!');
    }

    /**
     * Soft delete employee data
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Soft delete the specified employee.
     * @author Zin Lin Htet
     * @create 28/6/2023
     * @param $id
     * @return 'redirect'
     */
    public function softDelete($id)
    {
        $employee = $this->employeeInterface->getEmployeeById($id);
        //to restrict to inactive employee to inactive again
        if ($employee->deleted_at != null) {
            return redirect()->back()->with('error', ' Employee already inactive!');
        }
        //to restrict to inactive current login employee
        if (session('employee')->id == $id) {
            return redirect()->back()->with('error', ' Cannot inactive the current login Employee!');
        }
        if ($employee) {
            $employee->delete();
            return redirect()->back()->with('success', "Employee inactive successfully.");
        }
        return redirect()->back()->with('error', ' Employee does not exist!');
    }
}
