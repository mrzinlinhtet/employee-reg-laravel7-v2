<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * EmployeeAuthRequest to login validation.
 * @author Zin Lin Htet
 * @created 21/06/2023
 */
class EmployeeAuthRequest extends FormRequest
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
     * Rules for employee login validation
     * @author Zin Lin Htet
     * @created 21/06/2023
     * @return array
     */
    public function rules()
    {
        return [
            "employee_id" => "required|integer|exists:employees,employee_id",
            "password" => "required"
        ];
    }

    /**
     * Messages for employee login validation
     * @author Zin Lin Htet
     * @created 21/06/2023
     * @return array
     */
    public function messages()
    {
        return [
            'employee_id.required' => 'Please type Employee ID',
            'employee_id.integer' => 'Invalid Employee ID',
            'employee_id.exists' => 'Employee ID is not registered yet',
            'password.required' => 'Please type Password',

        ];
    }
}
