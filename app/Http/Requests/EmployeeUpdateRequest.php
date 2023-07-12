<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * EmployeeUpdateRequest to update employee for validation.
 * @author Zin Lin Htet
 * @created 28/06/2023
 */
class EmployeeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    /**
     * Rules for update employee validation
     * @author Zin Lin Htet
     * @created 28/06/2023
     * @return array
     */
    public function rules()
    {
        // $employee = Employee::where("employee_id", request()->employee_id)->first();
        $id = $this->route('employee');
        return [
            'employee_code' => 'required',
            'employee_name' => 'required',
            'nrc_number' => 'required|regex:/^[a-zA-Z0-9\/()]+$/',
            'email_address' => 'required|email', Rule::unique('employees', 'email_address')->ignore($id),
            'date_of_birth' => 'required|date_format:Y-m-d|before_or_equal:' . date('Y-m-d'),
            'photo' => 'mimes:jpeg,png,jpg,gif|max:10485760', // 10MB
        ];
    }
}
