<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Contact;
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

    /**
     * Toggle wishlist (session-based for guests)
     */
    public function toggleWishlist(Property $property)
    {
        $wishlist = session()->get('wishlist', []);
        $id = $property->id;

        if (in_array($id, $wishlist)) {
            $wishlist = array_values(array_diff($wishlist, [$id]));
            $added = false;
        } else {
            $wishlist[] = $id;
            $added = true;
        }

        session()->put('wishlist', $wishlist);

        return response()->json([
            'success' => true,
            'in_wishlist' => $added,
            'message' => $added ? 'Added to wishlist.' : 'Removed from wishlist.',
        ]);
    }

    /**
     * Submit property inquiry (contact agent)
     */
    public function contactAgent(Request $request, Property $property)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|min:10',
        ]);

        Contact::create([
            'property_id' => $property->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => 'Inquiry: ' . $property->title,
            'message' => $validated['message'],
            'type' => 'property_inquiry',
            'status' => 'new',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your inquiry has been sent. We will get back to you soon.',
        ]);
    }

    /**
     * Search suggestions for autocomplete
     */
    public function searchSuggestions(Request $request)
    {
        $q = $request->get('q', '');
        if (strlen($q) < 2) {
            return response()->json(['suggestions' => []]);
        }

        $properties = Property::where('status', 'active')
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                    ->orWhere('address', 'like', "%{$q}%")
                    ->orWhere('city', 'like', "%{$q}%");
            })
            ->limit(8)
            ->get(['id', 'title', 'slug', 'city', 'price']);

        $suggestions = $properties->map(function ($p) {
            return [
                'id' => $p->id,
                'title' => $p->title,
                'url' => route('properties.show', $p->slug),
                'city' => $p->city,
                'price' => number_format($p->price),
            ];
        });

        return response()->json(['suggestions' => $suggestions]);
    }
}
