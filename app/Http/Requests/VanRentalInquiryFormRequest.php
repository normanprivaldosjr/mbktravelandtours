<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VanRentalInquiryFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'van_id'=> 'required',
            'name' => 'required|max:255',
            'phone_number' => 'required|max:25',
            'email_address' => 'required|max:150|email',
            'location_from'=> 'required',
            'location_to'=> 'required',
            'rental_day_start'=> 'date|required|before_or_equal:rental_day_end',
            'rental_day_end'=> 'date',
            'birthday'=> 'date|required',
        ];
    }

    public function messages()
    {
        return [
            'van_id.required' => 'Please select a van.',
        ];
    }
}
