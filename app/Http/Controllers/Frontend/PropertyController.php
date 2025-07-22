<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Agent;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display all properties with filtering and search
     */
    public function index(Request $request)
    {
        $query = Property::where('status', 'active');

        // Search by title/description
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('address', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by property type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status (for sale/for rent)
        if ($request->filled('listing_type')) {
            $query->where('listing_type', $request->listing_type);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by bedrooms
        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '>=', $request->bedrooms);
        }

        // Filter by location/city
        if ($request->filled('location')) {
            $query->where('city', 'like', '%' . $request->location . '%');
        }

        // Sort options
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        $properties = $query->with('agent')->paginate(12);

        // Get filter options for dropdown
        $propertyTypes = Property::distinct()->pluck('type')->filter();
        $cities = Property::distinct()->pluck('city')->filter();
        $maxPrice = Property::max('price');

        return view('frontend.pages.properties', compact(
            'properties',
            'propertyTypes',
            'cities',
            'maxPrice'
        ));
    }

    /**
     * Display single property
     */
    public function show($slug)
    {
        $property = Property::where('slug', $slug)
            ->where('status', 'active')
            ->with(['agent'])
            ->firstOrFail();

        // Get related properties (same type, different property)
        $relatedProperties = Property::where('status', 'active')
            ->where('type', $property->type)
            ->where('id', '!=', $property->id)
            ->limit(3)
            ->get();

        // Increment views count
        $property->increment('views');

        return view('frontend.pages.property-single', compact('property', 'relatedProperties'));
    }

    /**
     * Get properties by type (AJAX)
     */
    public function getByType($type)
    {
        $properties = Property::where('status', 'active')
            ->where('type', $type)
            ->with('agent')
            ->latest()
            ->paginate(12);

        return response()->json($properties);
    }
}
