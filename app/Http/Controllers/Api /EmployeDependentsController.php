<?php

namespace App\Http\Controllers\Api;

use App\Models\Employe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DependentResource;
use App\Http\Resources\DependentCollection;

class EmployeDependentsController extends Controller
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

        $dependents = $employe
            ->dependents()
            ->search($search)
            ->latest()
            ->paginate();

        return new DependentCollection($dependents);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employe $employe
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Employe $employe)
    {
        $this->authorize('create', Dependent::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'birth' => ['required', 'date'],
            'document_cpf' => ['required', 'max:255', 'string'],
            'kinship' => ['required', 'max:255', 'string'],
            'dependent_ir' => ['required', 'max:255'],
        ]);

        $dependent = $employe->dependents()->create($validated);

        return new DependentResource($dependent);
    }
}
