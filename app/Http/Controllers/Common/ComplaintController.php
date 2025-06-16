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
            'attachment.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048', 
        ]);

        $complaint = new Complaint($validated);
        $complaint->status = 'pending';

        // File upload logic 
        if ($request->hasFile('attachment')) {
            $paths = [];
            foreach ($request->file('attachment') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/complaints', $filename, 'public');
                $paths[] = $path;
            }
            $complaint->attachment = json_encode($paths); 
        }

        $complaint->save();

        // Send mail to admin
        Mail::to('atul800498@gmail.com')->send(new ComplaintMail($complaint));

        // Send mail to user
        if ($complaint->email) {
            Mail::to($complaint->email)->send(new ComplaintConfirmation($complaint));
        }

        return response()->json([
            'success' => true,
            'message' => '✅ Your complaint has been submitted successfully!',
        ]);
    }

}
