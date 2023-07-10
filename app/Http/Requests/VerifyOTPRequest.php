<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * VerifyOTPRequest for validation when change the password.
 * @author Zin Lin Htet
 * @created 10/07/2023
 */
class VerifyOTPRequest extends FormRequest
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
            'otp' => 'required|numeric',
        ];
    }
}
