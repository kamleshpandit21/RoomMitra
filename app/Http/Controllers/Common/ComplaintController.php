<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Mail\ComplaintConfirmation;
use App\Mail\ComplaintMail;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ComplaintController extends Controller
{
    //
    public function index()
    {
        return view('common.complaint');
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'user_type' => 'required|in:user,room_owner,guest',
            'category' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment' => 'nullable',
        ]);

        $complaint = new Complaint();

        $complaint->name = $validated['name'];
        $complaint->email = $validated['email'];
        $complaint->phone = $validated['phone'];
        $complaint->user_type = $validated['user_type'];
        $complaint->category = $validated['category'];
        $complaint->subject = $validated['subject'];
        $complaint->description = $validated['description'];


        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/complaints', $filename, 'public');
                // save $path as needed
                $complaint->attachment = $path;
            }
        }


        $complaint->status = 'pending';

        $complaint->save();
        Mail::to('atul800498@gmail.com')->send(new ComplaintMail($complaint));


        if ($complaint->email) {
            Mail::to($complaint->email)->send(new ComplaintConfirmation($complaint));
        }
        return response()->json([
            'success' => true,
            'message' => '✅ Your request has been submitted successfully!',
        ]);

    }
}
