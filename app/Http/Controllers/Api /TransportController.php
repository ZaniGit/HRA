<?php

namespace App\Http\Controllers\Api;

use App\Models\Transport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransportResource;
use App\Http\Resources\TransportCollection;
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
            ->paginate();

        return new TransportCollection($transports);
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

        return new TransportResource($transport);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Transport $transport)
    {
        $this->authorize('view', $transport);

        return new TransportResource($transport);
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

        return new TransportResource($transport);
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

        return response()->noContent();
    }
}
