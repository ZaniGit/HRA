<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamUpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'company_id' => ['required', 'exists:companies,id'],
            'employe_id' => ['required', 'exists:employes,id'],
            'units' => ['required', 'max:255', 'string'],
            'type_exam' => ['required', 'max:255', 'string'],
            'done' => ['required', 'max:1'],
        ];
    }
}
