<?php

namespace App\Http\Controllers\Api;

use App\Models\Dependent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DependentResource;
use App\Http\Resources\DependentCollection;
use App\Http\Requests\DependentStoreRequest;
use App\Http\Requests\DependentUpdateRequest;

class DependentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Dependent::class);

        $search = $request->get('search', '');

        $dependents = Dependent::search($search)
            ->latest()
            ->paginate();

        return new DependentCollection($dependents);
    }

    /**
     * @param \App\Http\Requests\DependentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DependentStoreRequest $request)
    {
        $this->authorize('create', Dependent::class);

        $validated = $request->validated();

        $dependent = Dependent::create($validated);

        return new DependentResource($dependent);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Dependent $dependent
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Dependent $dependent)
    {
        $this->authorize('view', $dependent);

        return new DependentResource($dependent);
    }

    /**
     * @param \App\Http\Requests\DependentUpdateRequest $request
     * @param \App\Models\Dependent $dependent
     * @return \Illuminate\Http\Response
     */
    public function update(
        DependentUpdateRequest $request,
        Dependent $dependent
    ) {
        $this->authorize('update', $dependent);

        $validated = $request->validated();

        $dependent->update($validated);

        return new DependentResource($dependent);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Dependent $dependent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Dependent $dependent)
    {
        $this->authorize('delete', $dependent);

        $dependent->delete();

        return response()->noContent();
    }
}
