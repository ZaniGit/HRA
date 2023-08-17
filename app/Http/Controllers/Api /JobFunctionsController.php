<?php

namespace App\Http\Controllers\Api;

use App\Models\JobFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobFunctionsResource;
use App\Http\Resources\JobFunctionsCollection;
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
            ->paginate();

        return new JobFunctionsCollection($allJobFunctions);
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

        return new JobFunctionsResource($jobFunctions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobFunctions $jobFunctions
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, JobFunctions $jobFunctions)
    {
        $this->authorize('view', $jobFunctions);

        return new JobFunctionsResource($jobFunctions);
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

        return new JobFunctionsResource($jobFunctions);
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

        return response()->noContent();
    }
}
