<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::latest()->paginate(20);
        return view('admin.inquiries.index', ['inquiries' => $inquiries]);
    }

    public function show(Inquiry $inquiry)
    {
        // Only mark as read if not already responded
        if ($inquiry->status !== 'responded') {
            $inquiry->update(['status' => 'read']);
        }
        return view('admin.inquiries.show', ['inquiry' => $inquiry]);
    }

    public function markResponded(Inquiry $inquiry)
    {
        $inquiry->update([
            'status' => 'responded',
            'responded_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Inquiry marked as responded!');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry deleted!');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:inquiries,id',
        ])['ids'];

        Inquiry::whereIn('id', $ids)->delete();

        return redirect()->route('admin.inquiries.index')->with('success', count($ids) . ' inquiry/inquiries deleted!');
    }
}