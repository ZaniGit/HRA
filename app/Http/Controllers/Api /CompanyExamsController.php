<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Resources\ExamResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamCollection;

class CompanyExamsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Company $company)
    {
        $this->authorize('view', $company);

        $search = $request->get('search', '');

        $exams = $company
            ->exams()
            ->search($search)
            ->latest()
            ->paginate();

        return new ExamCollection($exams);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
        $this->authorize('create', Exam::class);

        $validated = $request->validate([
            'employe_id' => ['required', 'exists:employes,id'],
            'units' => ['required', 'max:255', 'string'],
            'type_exam' => ['required', 'max:255', 'string'],
            'done' => ['required', 'max:1'],
        ]);

        $exam = $company->exams()->create($validated);

        return new ExamResource($exam);
    }
}
