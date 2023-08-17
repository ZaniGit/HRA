<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Company;
use App\Models\Employe;
use Illuminate\Http\Request;
use App\Http\Requests\ExamStoreRequest;
use App\Http\Requests\ExamUpdateRequest;

class ExamController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Exam::class);

        $search = $request->get('search', '');

        $exams = Exam::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.exams.index', compact('exams', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Exam::class);

        $companies = Company::pluck('name', 'id');
        $employes = Employe::pluck('name', 'id');

        return view('app.exams.create', compact('companies', 'employes'));
    }

    /**
     * @param \App\Http\Requests\ExamStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamStoreRequest $request)
    {
        $this->authorize('create', Exam::class);

        $validated = $request->validated();

        $exam = Exam::create($validated);

        return redirect()
            ->route('exams.edit', $exam)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Exam $exam)
    {
        $this->authorize('view', $exam);

        return view('app.exams.show', compact('exam'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Exam $exam)
    {
        $this->authorize('update', $exam);

        $companies = Company::pluck('name', 'id');
        $employes = Employe::pluck('name', 'id');

        return view('app.exams.edit', compact('exam', 'companies', 'employes'));
    }

    /**
     * @param \App\Http\Requests\ExamUpdateRequest $request
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function update(ExamUpdateRequest $request, Exam $exam)
    {
        $this->authorize('update', $exam);

        $validated = $request->validated();

        $exam->update($validated);

        return redirect()
            ->route('exams.edit', $exam)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Exam $exam)
    {
        $this->authorize('delete', $exam);

        $exam->delete();

        return redirect()
            ->route('exams.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
