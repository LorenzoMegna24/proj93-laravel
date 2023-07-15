<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|min:4|max:100',
            'room' => 'required|min:1|max:20',
            'bathroom' => 'required|max:20',
            'bed' => 'required|min:1|max:20',
            'sq_meters' => 'nullable|min:20|max:1000',
            'address' => 'required|max:200',
            'image' => 'required|image|max:6000',
            'amenities'=> 'exists:amenities,id'
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'room.required' => 'A room is required',
            'bathroom.required' => 'A bathroom is required',
            'bed.required' => 'A bed is required',
            'address.required' => 'A address is required',
            'image.required' => 'A image is required',
        ];
    }
}
