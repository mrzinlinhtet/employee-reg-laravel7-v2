<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * ImportRequest to validate the excel import.
 * @author Zin Lin Htet
 * @created 23/6/2023
 */
class ImportRequest extends FormRequest
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
     * Rules of validate the excel import.
     * @author Zin Lin Htet
     * @create 23/6/2023
     * @return array
     */
    public function rules()
    {
        return [
            'import_file' => 'required|file|mimes:xlsx'
        ];
    }
}
