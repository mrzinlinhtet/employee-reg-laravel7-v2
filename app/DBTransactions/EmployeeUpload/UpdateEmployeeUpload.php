<?php

namespace App\DBTransactions\EmployeeUpload;

use App\Models\Employee;
use App\Classes\DBTransaction;
use App\Models\EmployeeUpload;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;


/**
 *
 *
 * @author
 * @create
 */
/**
 * UpdateEmployeeUpload to update employee where photo include.
 * @author Zin Lin Htet
 * @created 22/06/2023
 */
class UpdateEmployeeUpload extends DBTransaction
{
    private $request, $id;

    public function __construct($request, $id)
    {
        $this->request = $request;
        $this->id = $id;
    }
    /**
     * Update the data of employee's photo in DB
     * @author Zin Lin Htet
     * @create 22/06/2023
     * @return array
     */
    public function process()
    {
        $request = $this->request;
        $id = $this->id;
        $employee = Employee::find($id);

        // Get the new photo file
        $newPhoto = $request->file('photo');
        $extensionImg = $newPhoto->extension();
        $imgSize = $newPhoto->getSize();

        // Generate a new file name for the photo
        $newFileName = Carbon::now()->format('Ymd_His') . '_' . $employee->employee_name . '.' . $newPhoto->extension();

        // Move the new photo to the uploads directory
        $newFilePath = $newPhoto->move(public_path('uploads'), $newFileName);

        // Update the employee's photo data in the database
        $employeeUpload = EmployeeUpload::where("employee_id", $employee->employee_id)->first();

        // Delete the old photo file
        $oldFilePath = public_path('uploads') . '/' . $employeeUpload->file_name;
        File::delete($oldFilePath);

        $employeeUpload->file_path = $newFilePath;
        $employeeUpload->file_name = $newFileName;
        $employeeUpload->file_size = $imgSize;
        $employeeUpload->file_extension = $extensionImg;
        $employeeUpload->update();

        if (session('employee')->id == $this->id) {
            //update session photo
            session()->put('photo', 'uploads/' . $employeeUpload->file_name);
        }

        if (!$employeeUpload) {
            return ['status' => false, 'error' => 'Failed'];
        }
        return ['status' => true, 'error' => ''];
    }
}
