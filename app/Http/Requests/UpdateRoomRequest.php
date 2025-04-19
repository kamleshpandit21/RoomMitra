<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            //
            'room_number' => 'required',
            'room_title' => 'required|string|max:255',
            'room_description' => 'nullable|string|max:1000',
            'room_price' => 'required|numeric',
            'security_deposit' => 'required|numeric',
            'min_stay_months' => 'required|numeric',
            'single_price' => 'nullable|numeric',
            'double_price' => 'nullable|numeric',
            'triple_price' => 'nullable|numeric',

            'room_capacity' => 'required|numeric',
            'total_beds' => 'nullable|numeric',
            'ac' => 'nullable|string',
            'lift' => 'nullable|string',

            'parking' => 'nullable|string',
            'kitchen' => 'nullable|string',
            'kitchen_type' => 'nullable|string|in:personal,shared',
            'bathroom_type' => 'required|string|in:attached,shared',
            'amenity_name' => 'required|array',
            'amenity_name.*' => 'required|string|max:50',
            'amenity_status' => 'required|array',
            'amenity_status.*' => 'required|string|in:paid,free',
            'amenity_price' => 'required_if:amenity_status,"paid"|array',
            'amenity_price.*' => 'required_if:amenity_status.*,"paid"|numeric',

            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'locality' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|size:6',
            'entry_time' => 'required|date_format:H:i',
            'exit_time' => 'required|date_format:H:i',
            'restrictions' => 'required|string|max:500',
            'room_images' => 'required|array',
            'room_images.*' => 'required|image|mimes:jpeg,png,jpg,gif'

        ];
    }

    public function messages()
    {

        return [
            'room_number.required' => 'Room number is required.',
            'room_number.string' => 'Room number must be a string.',
            'room_number.max' => 'Room number must not exceed 10 characters.',
            'room_number.unique' => 'Room number already exists.',
            'room_title.required' => 'Room title is required.',
            'room_title.string' => 'Room title must be a string.',
            'room_title.max' => 'Room title must not exceed 255 characters.',

            'room_description.string' => 'Room description must be a string.',
            'room_description.max' => 'Room description must not exceed 1000 characters.',
            'room_price.required' => 'Room price is required.',
            'room_price.numeric' => 'Room price must be a number.',
            'security_deposit.required' => 'Security deposit is required.',
            'security_deposit.numeric' => 'Security deposit must be a number.',
            'min_stay_months.required' => 'Minimum stay months is required.',
            'min_stay_months.numeric' => 'Minimum stay months must be a number.',
            'single_price.numeric' => 'Single price must be a number.',
            'double_price.numeric' => 'Double price must be a number.',
            'triple_price.numeric' => 'Triple price must be a number.',
            'room_capacity.required' => 'Room capacity is required.',
            'room_capacity.numeric' => 'Room capacity must be a number.',
            'total_beds.numeric' => 'Total beds must be a number.',
            'ac.string' => 'AC must be a string.',
            'lift.string' => 'Lift must be a string.',
            'parking.string' => 'Parking must be a string.',
            'kitchen.string' => 'Kitchen must be a string.',
            'kitchen_type.string' => 'Kitchen type must be a string.',
            'kitchen_type.in' => 'Kitchen type must be "personal" or "shared".',
            'bathroom_type.required' => 'Bathroom type is required.',
            'bathroom_type.string' => 'Bathroom type must be a string.',
            'bathroom_type.in' => 'Bathroom type must be "personal" or "shared".',
            'address_line1.required' => 'Address line 1 is required.',
            'address_line1.string' => 'Address line 1 must be a string.',
            'address_line1.max' => 'Address line 1 must not exceed 255 characters.',
            'address_line2.string' => 'Address line 2 must be a string.',
            'address_line2.max' => 'Address line 2 must not exceed 255 characters.',
            'locality.required' => 'Locality is required.',
            'locality.string' => 'Locality must be a string.',
            'locality.max' => 'Locality must not exceed 100 characters.',
            'city.required' => 'City is required.',
            'city.string' => 'City must be a string.',
            'city.max' => 'City must not exceed 100 characters.',
            'state.required' => 'State is required.',
            'state.string' => 'State must be a string.',
            'state.max' => 'State must not exceed 100 characters.',
            'pincode.required' => 'Pincode is required.',
            'pincode.string' => 'Pincode must be a string.',
            'pincode.size' => 'Pincode must be 6 characters.',
            'entry_time.required' => 'Entry time is required.',
            'entry_time.date_format' => 'Entry time must be in HH:MM format.',
            'exit_time.required' => 'Exit time is required.',
            'exit_time.date_format' => 'Exit time must be in HH:MM format.',
            'restrictions.required' => 'Restrictions are required.',
            'restrictions.string' => 'Restrictions must be a string.',
            'restrictions.max' => 'Restrictions must not exceed 500 characters.',
            'amenity_name.*.required' => 'Amenity name is required.',
            'amenity_status.*.required' => 'Amenity status is required.',
            'amenity_price.*.required' => 'Amenity price is required.',
            'amenity_name.*.max' => 'Amenity name must not exceed 50 characters.',
            'amenity_price.*.numeric' => 'Amenity price must be a number.',
            'amenity_name.*.string' => 'Amenity name must be a string.',
            'amenity_status.*.string' => 'Amenity status must be a string.',
            'amenity_status.*.in' => 'Amenity status must be "paid" or "free".',
            'room_images.*.required' => 'Room image is required.',
            'room_images.*.image' => 'Room image must be an image.',
            'room_images.*.mimes' => 'Room image must be a JPEG, PNG, JPG, or GIF.',
            'room_images.*.max' => 'Room image size must not exceed 2MB.',


        ];
    }
}
