<?php

namespace App\Http\Controllers\Api;

use App\Models\JobFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeResource;
use App\Http\Resources\EmployeCollection;

class JobFunctionsEmployesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobFunctions $jobFunctions
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, JobFunctions $jobFunctions)
    {
        $this->authorize('view', $jobFunctions);

        $search = $request->get('search', '');

        $employes = $jobFunctions
            ->employes()
            ->search($search)
            ->latest()
            ->paginate();

        return new EmployeCollection($employes);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobFunctions $jobFunctions
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JobFunctions $jobFunctions)
    {
        $this->authorize('create', Employe::class);

        $validated = $request->validate([
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
            'date_admission' => ['required', 'date'],
            'document' => ['file', 'max:1024'],
        ]);

        if ($request->hasFile('document')) {
            $validated['document'] = $request
                ->file('document')
                ->store('public');
        }

        $employe = $jobFunctions->employes()->create($validated);

        return new EmployeResource($employe);
    }
}
