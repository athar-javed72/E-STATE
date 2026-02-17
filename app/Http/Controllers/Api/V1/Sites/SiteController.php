<?php

namespace App\Http\Controllers\Api\V1\Sites;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Site::class);

        $query = Site::query();

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            });
        }

        $sites = $query->paginate($request->integer('per_page', 20));

        return response()->json($sites);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Site::class);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'customer_name' => ['nullable', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50', 'unique:sites,code'],
            'address_line1' => ['nullable', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:50'],
            'country' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'timezone' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'max:50'],
            'metadata' => ['nullable', 'array'],
        ]);

        /** @var \App\Models\Site $site */
        $site = Site::create($data);

        return response()->json([
            'data' => $site,
        ], 201);
    }

    public function show(Site $site)
    {
        $this->authorize('view', $site);

        return response()->json([
            'data' => $site->load(['projects', 'tasks', 'schedules']),
        ]);
    }

    public function update(Request $request, Site $site)
    {
        $this->authorize('update', $site);

        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'customer_name' => ['nullable', 'string', 'max:255'],
            'code' => ['sometimes', 'string', 'max:50', 'unique:sites,code,' . $site->id],
            'address_line1' => ['nullable', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:50'],
            'country' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'timezone' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'max:50'],
            'metadata' => ['nullable', 'array'],
        ]);

        $site->update($data);

        return response()->json([
            'data' => $site,
        ]);
    }

    public function destroy(Site $site)
    {
        $this->authorize('delete', $site);

        $site->delete();

        return response()->json([], 204);
    }
}

