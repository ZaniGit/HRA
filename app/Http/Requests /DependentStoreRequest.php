<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DependentStoreRequest extends FormRequest
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
            'employe_id' => ['required', 'exists:employes,id'],
            'name' => ['required', 'max:255', 'string'],
            'birth' => ['required', 'date'],
            'document_cpf' => ['required', 'max:255', 'string'],
            'kinship' => ['required', 'max:255', 'string'],
            'dependent_ir' => ['required', 'max:255'],
        ];
    }
}
