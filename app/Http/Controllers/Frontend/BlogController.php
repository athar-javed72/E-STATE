<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display all blog posts
     */
    public function index(Request $request)
    {
        $blogs = Blog::where('status', 'published')
            ->when($request->category, function($query, $category) {
                return $query->where('category', $category);
            })
            ->when($request->search, function($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                           ->orWhere('content', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(9);

        $categories = Blog::where('status', 'published')
            ->distinct()
            ->pluck('category')
            ->filter();

        $recentPosts = Blog::where('status', 'published')
            ->latest()
            ->limit(5)
            ->get();

        return view('frontend.pages.blog', compact('blogs', 'categories', 'recentPosts'));
    }

    /**
     * Show single blog post
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Increment view count
        $blog->increment('views');

        $relatedPosts = Blog::where('status', 'published')
            ->where('category', $blog->category)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->limit(3)
            ->get();

        $recentPosts = Blog::where('status', 'published')
            ->latest()
            ->limit(5)
            ->get();

        return view('frontend.pages.blog-single', compact('blog', 'relatedPosts', 'recentPosts'));
    }
}
