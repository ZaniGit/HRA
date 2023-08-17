<?php

namespace App\Http\Controllers;

use App\Models\JobFunctions;
use Illuminate\Http\Request;
use App\Http\Requests\JobFunctionsStoreRequest;
use App\Http\Requests\JobFunctionsUpdateRequest;

class JobFunctionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', JobFunctions::class);

        $search = $request->get('search', '');

        $allJobFunctions = JobFunctions::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_job_functions.index',
            compact('allJobFunctions', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', JobFunctions::class);

        return view('app.all_job_functions.create');
    }

    /**
     * @param \App\Http\Requests\JobFunctionsStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobFunctionsStoreRequest $request)
    {
        $this->authorize('create', JobFunctions::class);

        $validated = $request->validated();

        $jobFunctions = JobFunctions::create($validated);

        return redirect()
            ->route('all-job-functions.edit', $jobFunctions)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobFunctions $jobFunctions
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, JobFunctions $jobFunctions)
    {
        $this->authorize('view', $jobFunctions);

        return view('app.all_job_functions.show', compact('jobFunctions'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobFunctions $jobFunctions
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, JobFunctions $jobFunctions)
    {
        $this->authorize('update', $jobFunctions);

        return view('app.all_job_functions.edit', compact('jobFunctions'));
    }

    /**
     * @param \App\Http\Requests\JobFunctionsUpdateRequest $request
     * @param \App\Models\JobFunctions $jobFunctions
     * @return \Illuminate\Http\Response
     */
    public function update(
        JobFunctionsUpdateRequest $request,
        JobFunctions $jobFunctions
    ) {
        $this->authorize('update', $jobFunctions);

        $validated = $request->validated();

        $jobFunctions->update($validated);

        return redirect()
            ->route('all-job-functions.edit', $jobFunctions)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobFunctions $jobFunctions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, JobFunctions $jobFunctions)
    {
        $this->authorize('delete', $jobFunctions);

        $jobFunctions->delete();

        return redirect()
            ->route('all-job-functions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
