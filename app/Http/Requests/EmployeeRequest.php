<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * EmployeeRequest to register employee for validation.
 * @author Zin Lin Htet
 * @created 22/06/2023
 */
class EmployeeRequest extends FormRequest
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
     * Rules for register employee validation
     * @author Zin Lin Htet
     * @created 22/06/2023
     * @return array
     */
    public function rules()
    {
        return [
            'employee_code' => 'required|max:25',
            'employee_name' => 'required|max:25',
            'nrc_number' => 'required|regex:/^[a-zA-Z0-9\/()]+$/',
            'password' => 'required|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^A-Za-z0-9]).{4,8}$/',
            'email_address' => 'required|email|unique:employees,email_address',
            'date_of_birth' => 'required|date_format:Y-m-d|before_or_equal:' . date('Y-m-d'),
            'photo' => 'mimes:jpeg,png,jpg,gif|max:10485760', // 10MB
        ];
    }

    /**
     * Messages for register employee validation
     * @author Zin Lin Htet
     * @created 22/06/2023
     * @return array
     */
    public function messages()
    {
        return [
            'date_of_birth.before_or_equal' => 'The date of birth cannot be greater than the current date.',
        ];
    }
}
