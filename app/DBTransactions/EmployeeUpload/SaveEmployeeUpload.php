<?php

namespace App\DBTransactions\EmployeeUpload;

use App\Models\EmployeeUpload;
use App\Classes\DBTransaction;
use Illuminate\Support\Carbon;


/**
 *
 *
 * @author
 * @create
 */
/**
 * SaveEmployeeUpload to register employee where photo include.
 * @author Zin Lin Htet
 * @created 22/06/2023
 */
class SaveEmployeeUpload extends DBTransaction
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
    /**
     * Save the data of employee's photo in DB
     * @author Zin Lin Htet
     * @create 22/06/2023
     * @return array
     */
    public function process()
    {
        $request = $this->request;
        $employee_id = $request->employee_id;
        $name = $request->employee_name;

        // Get the photo file
        $image = $request->file('photo');
        $extensionImg = $image->extension();
        $imgSize = $image->getSize();

        // Generate a file name for the photo
        $imageName = Carbon::now()->format('Ymd_His') . '_' . $name . '.' . $extensionImg;

        // Move the photo to the uploads directory
        $imgSave = $image->move(public_path('uploads'), $imageName);

        // Save the employee's photo data in the database
        $emp_upload = new EmployeeUpload();
        $emp_upload->employee_id = $employee_id;
        $emp_upload->file_path = $imgSave;
        $emp_upload->file_name = $imageName;
        $emp_upload->file_size = $imgSize;
        $emp_upload->file_extension = $extensionImg;
        $emp_upload = $emp_upload->save();

        if (session('employee')->employee_id == $request->employee_id) {
            //store session photo
            session()->put('photo', 'uploads/' . $imageName);
        }

        if (!$emp_upload) {
            return ['status' => false, 'error' => 'Failed!'];
        }
        return ['status' => true, 'error' => ''];
    }
}
