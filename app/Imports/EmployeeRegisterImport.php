<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * EmployeeRegisterImport to call the sheets WithMultipleSheets
 * @author Zin Lin Htet
 * @created 23/06/2023
 */
class EmployeeRegisterImport implements WithMultipleSheets
{
    public $statusImport, $errorImport;
    /**
     * Method sheets to call the multiple sheets
     * @author Zin Lin Htet
     * @create 23/06/2023
     * @return array
     */
    public function sheets(): array
    {
        return [
            0 => new FirstSheetImport()
        ];
    }
}

/**
 * FirstSheetImport to save the database with validation
 * @author Zin Lin Htet
 * @created 23/06/2023
 */
class FirstSheetImport implements ToCollection
{
    /**
     * Define the column names of table
     * @author Zin Lin Htet
     * @create 26/06/2023
     * @return array
     */
    public function attributeNames()
    {
        return [
            '0' => 'Employee Code',
            '1' => 'Employee Name',
            '2' => 'NRC Number',
            '3' => 'Password',
            '4' => 'Email Address',
            '5' => 'Gender',
            '6' => 'Date of Birth',
            '7' => 'Marital Status',
            '8' => 'Address',
        ];
    }
    /**
     * @param Collection $collection
     */
    /**
     * Collection for importing the data with excel
     * @author Zin Lin Htet
     * @create 23/06/2023
     * @param Collection $rows
     * @return 'redirect'
     */
    public function collection(Collection $rows)
    {
        //remove the heading row
        $dataRows = $rows->slice(1);

        //to check the define excel format
        $defaultHeading = [
            '0' => "Employee Code",
            '1' => "Employee Name",
            '2' => "NRC Number",
            '3' => "Password",
            '4' => "Email Address",
            '5' => "Gender",
            '6' => "Date of Birth",
            '7' => "Marital Status",
            '8' => "Address"
        ];
        $differenceArray = array_diff($rows[0]->toArray(), $defaultHeading);
        if (!empty($differenceArray)) {
            return redirect()->back()->with(['error' => "Invalid Excel Input Format, please check again!"]);
        }

        if (count($dataRows) == 0) {
            return redirect()->back()->with(['error' => "No Data in file, please check again!"]);
        }

        $errors = [];
        //check the all rows for the validation
        foreach ($dataRows as $rowIndex => $row) {
            $rules = [
                '0' => 'required',
                '1' => 'required',
                '2' => 'required|regex:/^[a-zA-Z0-9\/()]+$/',
                '3' => 'required|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^A-Za-z0-9]).{4,8}$/',
                '4' => 'required|email|unique:employees,email_address',
                '5' => 'nullable|in:1,2',
                '6' => 'required|date_format:Y-m-d',
                '7' => 'nullable|in:1,2,3',
                '8' => 'nullable'
            ];
            $validator = Validator::make($row->toArray(), $rules, [], $this->attributeNames());
            if ($validator->fails()) {
                $columnErrors = $validator->errors()->all();
                foreach ($columnErrors as $columnError) {
                    $errors[] = [
                        'error' =>  $columnError . ' in row ' . ($rowIndex + 1)
                    ];
                }
            }
        }

        if (!empty($errors)) {
            // Handle errors here, e.g., redirect back with error messages
            return redirect()->back()->with(['error' => $errors]);
        }



        // Call the Employee model to store data
        $newEmployee = new Employee();

        // Get the current maximum employee ID from the database
        $maxEmployeeId = Employee::max('employee_id');

        // Set a counter variable to keep track of the number of rows processed
        $rowCount = 0;


        //rows count max 100 condition
        if (count($dataRows) > 100) {
            return redirect()->route('employees.index')->with('error', "Excel upload file can allow employee data maximum 100 rows.");
        } else {
            try {
                // Iterate through the first 100 rows
                foreach ($dataRows as $row) {

                    $employeeId = $maxEmployeeId + $rowCount + 1; // Generate a new employee ID
                    DB::beginTransaction();
                    $newEmployee = new Employee();
                    $newEmployee->employee_id = $employeeId;
                    $newEmployee->employee_code = $row[0];
                    $newEmployee->employee_name = $row[1];
                    $newEmployee->nrc_number = $row[2];
                    $newEmployee->password = Hash::make($row[3]);
                    $newEmployee->email_address = $row[4];
                    $newEmployee->gender = $row[5];
                    $newEmployee->date_of_birth = Date::excelToDateTimeObject($row[6])->format('Y-m-d');
                    $newEmployee->marital_status = $row[7];
                    $newEmployee->address = $row[8];
                    DB::commit();
                    $newEmployee->save();


                    $rowCount++; // Increment the row counter
                }
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect()->back()->with('error', "Email duplicated, please check!");
            }

            return redirect()->route('employees.index')->with('success', "Multi Employee registration is successfully.");
        }
    }
}
