<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of contacts.
     */
    public function index(Request $request)
    {
        $query = Contact::with('property')->latest();

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('subject', 'like', '%'.$search.'%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $contacts = $query->paginate(15)->withQueryString();

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Display a single contact message.
     */
    public function show(Contact $contact)
    {
        $contact->loadMissing('property');

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Update a contact's status.
     */
    public function updateStatus(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'status' => 'required|in:new,read,replied',
        ]);

        $contact->update(['status' => $data['status']]);

        return back()->with('success', 'Contact status updated.');
    }
}
