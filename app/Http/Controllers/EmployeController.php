<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\JobFunctions;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EmployeStoreRequest;
use App\Http\Requests\EmployeUpdateRequest;

class EmployeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Employe::class);

        $search = $request->get('search', '');

        $employes = Employe::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.employes.index', compact('employes', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Employe::class);

        $companies = Company::pluck('name', 'id');
        $allJobFunctions = JobFunctions::pluck('name', 'id');

        return view(
            'app.employes.create',
            compact('companies', 'allJobFunctions')
        );
    }

    /**
     * @param \App\Http\Requests\EmployeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeStoreRequest $request)
    {
        $this->authorize('create', Employe::class);

        $validated = $request->validated();
        if ($request->hasFile('document')) {
            $validated['document'] = $request
                ->file('document')
                ->store('public');
        }

        $employe = Employe::create($validated);

        return redirect()
            ->route('employes.edit', $employe)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employe $employe
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Employe $employe)
    {
        $this->authorize('view', $employe);

        return view('app.employes.show', compact('employe'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employe $employe
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Employe $employe)
    {
        $this->authorize('update', $employe);

        $companies = Company::pluck('name', 'id');
        $allJobFunctions = JobFunctions::pluck('name', 'id');

        return view(
            'app.employes.edit',
            compact('employe', 'companies', 'allJobFunctions')
        );
    }

    /**
     * @param \App\Http\Requests\EmployeUpdateRequest $request
     * @param \App\Models\Employe $employe
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeUpdateRequest $request, Employe $employe)
    {
        $this->authorize('update', $employe);

        $validated = $request->validated();
        if ($request->hasFile('document')) {
            if ($employe->document) {
                Storage::delete($employe->document);
            }

            $validated['document'] = $request
                ->file('document')
                ->store('public');
        }

        $employe->update($validated);

        return redirect()
            ->route('employes.edit', $employe)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employe $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Employe $employe)
    {
        $this->authorize('delete', $employe);

        if ($employe->document) {
            Storage::delete($employe->document);
        }

        $employe->delete();

        return redirect()
            ->route('employes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
