<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'fantasy_name' => ['nullable', 'max:255', 'string'],
            'document_cnpj' => ['required', 'max:255', 'string'],
            'zip_code' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'number' => ['required', 'max:255', 'string'],
            'district' => ['required', 'max:255', 'string'],
            'complement' => ['nullable', 'max:255', 'string'],
            'city' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:2'],
            'telephone' => ['nullable', 'max:255', 'string'],
            'cell_phone' => ['nullable', 'max:255', 'string'],
        ];
    }
}
