<?php

namespace App\Http\Controllers\Api;

use App\Models\Employe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\EmployeCollection;
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
            ->paginate();

        return new EmployeCollection($employes);
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

        return new EmployeResource($employe);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employe $employe
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Employe $employe)
    {
        $this->authorize('view', $employe);

        return new EmployeResource($employe);
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

        return new EmployeResource($employe);
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

        return response()->noContent();
    }
}
