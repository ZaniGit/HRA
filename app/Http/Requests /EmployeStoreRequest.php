<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'telephone_emergency' => ['nullable', 'max:255', 'string'],
            'telephone' => ['nullable', 'max:255', 'string'],
            'cell_phone' => ['required', 'max:255', 'string'],
            'birth' => ['required', 'date'],
            'nationality' => ['required', 'max:255', 'string'],
            'gender' => ['required', 'max:255', 'string'],
            'color' => ['required'],
            'civil_status' => ['required', 'max:255', 'string'],
            'scholarity' => ['required', 'max:255', 'string'],
            'sons' => ['nullable', 'max:255', 'string'],
            'name_dad' => ['nullable', 'max:255', 'string'],
            'name_mother' => ['nullable', 'max:255', 'string'],
            'zip_code' => ['required', 'max:255', 'string'],
            'andress' => ['required', 'max:255', 'string'],
            'number' => ['required', 'max:255', 'string'],
            'district' => ['required', 'max:255', 'string'],
            'complement' => ['nullable', 'max:255', 'string'],
            'city' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:2'],
            'document_rg' => ['required', 'max:255', 'string'],
            'organization_exp' => ['required', 'max:255', 'string'],
            'date_emission_rg' => ['required', 'date'],
            'document_cpf' => ['required', 'max:255', 'string'],
            'document_pis' => ['required', 'max:255', 'string'],
            'document_ctps' => ['required', 'max:255', 'string'],
            'document_ctps_serie' => ['required', 'max:255', 'string'],
            'date_emission_ctps' => ['required', 'date'],
            'document_title' => ['nullable', 'max:255', 'string'],
            'document_title_zone' => ['nullable', 'max:255', 'string'],
            'document_title_session' => ['nullable', 'max:255', 'string'],
            'date_emission_title' => ['nullable', 'date'],
            'document_reservist' => ['nullable', 'max:255', 'string'],
            'document_cnh' => ['nullable', 'max:255', 'string'],
            'document_cnh_category' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'job_functions_id' => ['required', 'exists:job_functions,id'],
            'date_admission' => ['required', 'date'],
            'document' => ['file', 'max:1024'],
        ];
    }
}
