<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Agent;
use App\Models\Blog;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        // Get featured properties (latest 6)
        $featuredProperties = Property::where('status', 'active')
            ->where('featured', true)
            ->latest()
            ->limit(6)
            ->get();

        // Get top agents (latest 4)
        $topAgents = Agent::where('status', 'active')
            ->latest()
            ->limit(4)
            ->get();

        // Get latest blog posts (latest 3)
        $latestBlogs = Blog::where('status', 'published')
            ->latest()
            ->limit(3)
            ->get();

        // Get testimonials
        $testimonials = Testimonial::where('status', 'active')
            ->latest()
            ->limit(6)
            ->get();

        // Property stats for hero section
        $propertyStats = [
            'total_properties' => Property::where('status', 'active')->count(),
            'properties_sold' => Property::where('status', 'sold')->count(),
            'happy_customers' => Testimonial::where('status', 'active')->count(),
            'total_agents' => Agent::where('status', 'active')->count(),
        ];

        return view('frontend.pages.home', compact(
            'featuredProperties',
            'topAgents',
            'latestBlogs',
            'testimonials',
            'propertyStats'
        ));
    }

    /**
     * Display the about page
     */
    public function about()
    {
        $agents = Agent::where('status', 'active')
            ->latest()
            ->get();

        $testimonials = Testimonial::where('status', 'active')
            ->latest()
            ->limit(8)
            ->get();

        return view('frontend.pages.about', compact('agents', 'testimonials'));
    }

    /**
     * Display the services page
     */
    public function services()
    {
        return view('frontend.pages.services');
    }
}
