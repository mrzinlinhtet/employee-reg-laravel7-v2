<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * ChangePasswordRequest for validation when change the password.
 * @author Zin Lin Htet
 * @created 10/07/2023
 */
class ChangePasswordRequest extends FormRequest
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
     * Rules for change password validation
     * @author Zin Lin Htet
     * @created 10/07/2023
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|required_with:confirm_password|same:confirm_password|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^A-Za-z0-9]).{4,8}$/',
            'confirm_password' => 'required',
        ];
    }
}
