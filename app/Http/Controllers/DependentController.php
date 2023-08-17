<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Dependent;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.dependents.index', compact('dependents', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Dependent::class);

        $employes = Employe::pluck('name', 'id');

        return view('app.dependents.create', compact('employes'));
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

        return redirect()
            ->route('dependents.edit', $dependent)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Dependent $dependent
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Dependent $dependent)
    {
        $this->authorize('view', $dependent);

        return view('app.dependents.show', compact('dependent'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Dependent $dependent
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Dependent $dependent)
    {
        $this->authorize('update', $dependent);

        $employes = Employe::pluck('name', 'id');

        return view('app.dependents.edit', compact('dependent', 'employes'));
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

        return redirect()
            ->route('dependents.edit', $dependent)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('dependents.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
