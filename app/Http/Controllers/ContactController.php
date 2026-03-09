<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'message' => 'required|string|max:5000',
        ]);

        Mail::to('inquiry@devixx.pro')->send(new ContactInquiry(
            firstName: $validated['first_name'],
            lastName: $validated['last_name'],
            email: $validated['email'],
            phone: $validated['phone'] ?? null,
            userMessage: $validated['message'],
        ));

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
