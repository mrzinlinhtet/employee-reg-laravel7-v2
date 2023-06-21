<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use App\Interfaces\EmployeeInterface;

/**
 * Handles employee CRUD functionality
 * @author Zin Lin Htet
 * @created 21/6/2023
 */
class EmployeeController extends Controller
{
    use ResponseAPI;

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
     * Show the lists of the employee, Index page
     * @author Zin Lin Htet
     * @created 21/6/2023
     * @return object
     */
    public function index()
    {
        try {
            $employees = $this->employeeInterface->pagination();
            if (!$employees) return $this->error("No Data", 404);
            return view('employee.index',['employees'=>$employees]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
