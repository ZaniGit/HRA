<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Http\Request;
use App\Http\Requests\TransportStoreRequest;
use App\Http\Requests\TransportUpdateRequest;

class TransportController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Transport::class);

        $search = $request->get('search', '');

        $transports = Transport::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.transports.index', compact('transports', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Transport::class);

        return view('app.transports.create');
    }

    /**
     * @param \App\Http\Requests\TransportStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransportStoreRequest $request)
    {
        $this->authorize('create', Transport::class);

        $validated = $request->validated();

        $transport = Transport::create($validated);

        return redirect()
            ->route('transports.edit', $transport)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Transport $transport)
    {
        $this->authorize('view', $transport);

        return view('app.transports.show', compact('transport'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Transport $transport)
    {
        $this->authorize('update', $transport);

        return view('app.transports.edit', compact('transport'));
    }

    /**
     * @param \App\Http\Requests\TransportUpdateRequest $request
     * @param \App\Models\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function update(
        TransportUpdateRequest $request,
        Transport $transport
    ) {
        $this->authorize('update', $transport);

        $validated = $request->validated();

        $transport->update($validated);

        return redirect()
            ->route('transports.edit', $transport)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Transport $transport)
    {
        $this->authorize('delete', $transport);

        $transport->delete();

        return redirect()
            ->route('transports.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
