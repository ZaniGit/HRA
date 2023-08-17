<?php

namespace App\Http\Controllers\Api;

use App\Models\Employe;
use Illuminate\Http\Request;
use App\Http\Resources\ExamResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamCollection;

class EmployeExamsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employe $employe
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Employe $employe)
    {
        $this->authorize('view', $employe);

        $search = $request->get('search', '');

        $exams = $employe
            ->exams()
            ->search($search)
            ->latest()
            ->paginate();

        return new ExamCollection($exams);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employe $employe
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Employe $employe)
    {
        $this->authorize('create', Exam::class);

        $validated = $request->validate([
            'company_id' => ['required', 'exists:companies,id'],
            'units' => ['required', 'max:255', 'string'],
            'type_exam' => ['required', 'max:255', 'string'],
            'done' => ['required', 'max:1'],
        ]);

        $exam = $employe->exams()->create($validated);

        return new ExamResource($exam);
    }
}
