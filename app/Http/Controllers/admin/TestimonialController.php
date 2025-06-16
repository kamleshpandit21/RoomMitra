<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials', compact('testimonials'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required',
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $validatedData['name'];
        $testimonial->role = $validatedData['role'];
        $testimonial->message = $validatedData['message'];
        $testimonial->rating = $validatedData['rating'];
        $testimonial->status = $validatedData['status'];
        // Handle file upload for avatar 
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $filename);
            $testimonial->avatar = 'uploads/testimonials/' . $filename;
        } else {
            $testimonial->avatar = 'uploads/testimonials/avatar.png';
        }
        $testimonial->save();

        return response()->json([
            'message' => 'Testimonial added successfully',
            'success' => true,
            'data' => $testimonial
        ], 200);

    }

    /**
     * ========================================
     * Display the specified resource.
     * ========================================
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|in:1,2',
        ]);

        $testimonial->name = $validatedData['name'];
        $testimonial->role = $validatedData['role'];
        $testimonial->message = $validatedData['message'];
        $testimonial->rating = $validatedData['rating'];
        $testimonial->status = $validatedData['status'];

        if ($request->hasFile('avatar')) {

            if ($testimonial->avatar && $testimonial->avatar != 'uploads/testimonials/avatar.png') {
                $oldPath = public_path($testimonial->avatar);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $filename);
            $testimonial->avatar = 'uploads/testimonials/' . $filename;
        }

        $testimonial->save();

        return response()->json([
            'success' => true,
            'message' => 'Testimonial updated successfully',
            'data' => $testimonial
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if ($testimonial->avatar && file_exists(public_path($testimonial->avatar))) {
            unlink(public_path($testimonial->avatar));
        }
        $testimonial->delete();

        return response()->json([
            'message' => 'Testimonial deleted successfully',
            'success' => true
        ], 200);
    }
    public function toggleStatus($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $testimonial->status = strtolower($testimonial->status) === 'active' ? 'inactive' : 'active';
        $testimonial->save();


        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully.',
            'status' => strtolower($testimonial->status),
        ]);
    }
}
