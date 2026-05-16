<?php

namespace App\Http\Controllers;

use App\Mail\InquiryReceived;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        $inquiry = Inquiry::create($validated);

        try {
            $recipient = env('MAIL_TO_ADDRESS', config('mail.from.address', env('MAIL_FROM_ADDRESS', 'hello@example.com')));
            Mail::to($recipient)->send(new InquiryReceived($inquiry));
        } catch (\Throwable $exception) {
            report($exception);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully! I\'ll get back to you soon.',
            ], 201);
        }

        return back()->with('success', 'Message sent successfully! I\'ll get back to you soon.');
    }
} 
