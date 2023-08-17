<?php

namespace App\Http\Controllers\Api;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Resources\ExamResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamCollection;
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
            ->paginate();

        return new ExamCollection($exams);
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

        return new ExamResource($exam);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Exam $exam)
    {
        $this->authorize('view', $exam);

        return new ExamResource($exam);
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

        return new ExamResource($exam);
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

        return response()->noContent();
    }
}
