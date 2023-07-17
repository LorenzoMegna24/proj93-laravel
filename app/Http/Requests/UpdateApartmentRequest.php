<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApartmentRequest extends FormRequest
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
            'room' => 'required|numeric|min:1|max:20',
            'bathroom' => 'required|numeric|max:20',
            'bed' => 'required|numeric|min:1|max:20',
            'sq_meters' => 'nullable|numeric|min:20|max:1000',
            'address' => 'required|max:200',
            'image' => 'required|image|max:6000',
            'visibility' =>'required',
            'amenities'=> 'required|exists:amenities,id'
        ];
    }
}
