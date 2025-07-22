<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Property;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display all agents
     */
    public function index()
    {
        $agents = Agent::with(['properties'])
            ->where('status', 'active')
            ->paginate(12);

        return view('frontend.pages.agents', compact('agents'));
    }

    /**
     * Show single agent profile
     */
    public function show($slug)
    {
        $agent = Agent::where('slug', $slug)
            ->where('status', 'active')
            ->with(['properties' => function($query) {
                $query->where('status', 'active')->limit(6);
            }])
            ->firstOrFail();

        $totalProperties = $agent->properties()->where('status', 'active')->count();

        return view('frontend.pages.agent-single', compact('agent', 'totalProperties'));
    }

    /**
     * Get agent properties via AJAX
     */
    public function properties($id, Request $request)
    {
        $agent = Agent::findOrFail($id);

        $properties = $agent->properties()
            ->where('status', 'active')
            ->when($request->type, function($query, $type) {
                return $query->where('type', $type);
            })
            ->when($request->min_price, function($query, $minPrice) {
                return $query->where('price', '>=', $minPrice);
            })
            ->when($request->max_price, function($query, $maxPrice) {
                return $query->where('price', '<=', $maxPrice);
            })
            ->paginate(9);

        if ($request->ajax()) {
            return view('frontend.components.property-grid', compact('properties'))->render();
        }

        return response()->json($properties);
    }
}
