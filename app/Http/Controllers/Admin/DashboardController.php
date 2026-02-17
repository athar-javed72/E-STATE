<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Property;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    /**
     * Show a simple admin overview dashboard.
     */
    public function index()
    {
        $stats = [
            'properties_total' => Property::count(),
            'properties_active' => Property::where('status', 'active')->count(),
            'properties_sold' => Property::where('status', 'sold')->count(),
            'agents_total' => Agent::count(),
            'blogs_published' => Blog::where('status', 'published')->count(),
            'testimonials_active' => Testimonial::where('status', 'active')->count(),
            'contacts_new' => Contact::where('status', 'new')->count(),
            'contacts_total' => Contact::count(),
        ];

        $recentProperties = Property::latest()->limit(5)->get();
        $recentContacts   = Contact::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProperties', 'recentContacts'));
    }
}
