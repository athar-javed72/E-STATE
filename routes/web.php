<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PropertyController;
use App\Http\Controllers\Frontend\AgentController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Frontend Web Routes
|--------------------------------------------------------------------------
|
| All public routes for the FindState real estate website
| Clean, SEO-friendly URLs with proper naming
|
*/

// Authentication (simple login for admin area)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Home & Static Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');

// Properties Routes
Route::prefix('properties')->name('properties.')->group(function () {
    Route::get('/', [PropertyController::class, 'index'])->name('index');
    Route::get('/type/{type}', [PropertyController::class, 'getByType'])->name('by-type');
    Route::get('/{slug}', [PropertyController::class, 'show'])->name('show');
});

// Agents Routes
Route::prefix('agents')->name('agents.')->group(function () {
    Route::get('/', [AgentController::class, 'index'])->name('index');
    Route::get('/{slug}', [AgentController::class, 'show'])->name('show');
});

// Blog Routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/category/{category}', [BlogController::class, 'category'])->name('category');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

// Contact Routes
Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});

// Additional Frontend Routes (AJAX)
Route::group(['prefix' => 'api/frontend', 'as' => 'api.'], function () {
    Route::post('property/wishlist/{property}', [PropertyController::class, 'toggleWishlist'])->name('property.wishlist');
    Route::post('property/contact/{property}', [PropertyController::class, 'contactAgent'])->name('property.contact');
    Route::post('contact/property-inquiry', [ContactController::class, 'propertyInquiry'])->name('contact.property-inquiry');
    Route::get('search/suggestions', [PropertyController::class, 'searchSuggestions'])->name('search.suggestions');
    Route::post('newsletter/subscribe', [ContactController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');
});

// SEO & Utility Routes
Route::get('/sitemap.xml', function () {
    return response()->view('sitemap')->header('Content-Type', 'text/xml');
})->name('sitemap');

Route::get('/robots.txt', function () {
    return response("User-agent: *\nDisallow: /admin\nDisallow: /api\n\nSitemap: " . url('/sitemap.xml'))
        ->header('Content-Type', 'text/plain');
})->name('robots');

// Admin area (protected by authentication)
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    });
