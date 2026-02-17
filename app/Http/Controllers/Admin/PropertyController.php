<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Agent;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    /**
     * Display a listing of properties.
     */
    public function index(Request $request)
    {
        $query = Property::with('agent');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('city', 'like', '%' . $request->search . '%')
                    ->orWhere('address', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $properties = $query->latest()->paginate(15)->withQueryString();

        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        $agents = Agent::where('status', 'active')->orderBy('name')->get();

        return view('admin.properties.create', compact('agents'));
    }

    /**
     * Store a newly created property.
     */
    public function store(StorePropertyRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('properties', 'public');
        }

        $data['featured'] = $request->boolean('featured');
        $data['slug'] = Str::slug($data['title']);

        Property::create($data);

        return redirect()->route('admin.properties.index')
            ->with('success', 'Property created successfully.');
    }

    /**
     * Show the form for editing the specified property.
     */
    public function edit(Property $property)
    {
        $agents = Agent::where('status', 'active')->orderBy('name')->get();

        return view('admin.properties.edit', compact('property', 'agents'));
    }

    /**
     * Update the specified property.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $data = $request->validated();

        if ($request->hasFile('featured_image')) {
            if ($property->featured_image) {
                Storage::disk('public')->delete($property->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('properties', 'public');
        }

        $data['featured'] = $request->boolean('featured');
        if (!empty($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $property->update($data);

        return redirect()->route('admin.properties.index')
            ->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified property.
     */
    public function destroy(Property $property)
    {
        if ($property->featured_image) {
            Storage::disk('public')->delete($property->featured_image);
        }

        $property->delete();

        return redirect()->route('admin.properties.index')
            ->with('success', 'Property deleted successfully.');
    }
}
