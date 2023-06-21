<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeAuthRequest extends FormRequest
{
    /**
     * Create EmployeeAuthRequest for validation.
     * @author Zin Lin Htet
     * @created 21/6/2023
     */
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
     * Rules for employee validation
     * @author Zin Lin Htet
     * @created 21/6/2023
     * @return array
     */
    public function rules()
    {
        return [
            "employee_id"=>"required|integer|exists:employees,employee_id",
            "password"=>"required"
        ];
    }

    /**
     * Messages for employee validation
     * @author Zin Lin Htet
     * @created 21/6/2023
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
