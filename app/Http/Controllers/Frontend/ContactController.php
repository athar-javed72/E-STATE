<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Show contact page
     */
    public function index()
    {
        return view('frontend.pages.contact');
    }

    /**
     * Store contact form submission
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the errors below.');
        }

        try {
            // Store in database (general contact form)
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'type' => 'general',
                'status' => 'new'
            ]);

            // Send email notification (optional)
            // Mail::to('admin@findstate.com')->send(new ContactFormSubmitted($request->all()));

            return back()->with('success', 'Thank you for your message! We will get back to you soon.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }

    /**
     * Property inquiry form (AJAX)
     */
    public function propertyInquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'property_id' => 'required|exists:properties,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|min:10'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill all required fields correctly.'
            ], 422);
        }

        try {
            Contact::create([
                'property_id' => $request->property_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => 'Property Inquiry - ID: ' . $request->property_id,
                'message' => $request->message,
                'status' => 'new',
                'type' => 'property_inquiry'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your inquiry has been sent successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    /**
     * Newsletter subscription
     */
    public function newsletterSubscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
        ]);

        $existing = NewsletterSubscriber::where('email', $validated['email'])->first();
        if ($existing) {
            $existing->update(['is_active' => true]);
            return response()->json([
                'success' => true,
                'message' => 'You are already subscribed. We will keep you updated!',
            ]);
        }

        NewsletterSubscriber::create([
            'email' => $validated['email'],
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing to our newsletter!',
        ]);
    }
}
