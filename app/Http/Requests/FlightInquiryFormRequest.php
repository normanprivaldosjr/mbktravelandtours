<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightInquiryFormRequest extends FormRequest
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
            'name' => 'required|max:255',
            'phone_number' => 'required|max:25',
            'email_address' => 'required|max:255|email',
            'flight_type' => 'required',
            'flight_route'=> 'required',
            'location_from'=> 'required|different:location_to',
            'location_to'=> 'required',
            'date_departure'=> 'date|required',
            'date_return'=> 'date|after_or_equal:date_departure',
            'birthday'=> 'date|required',
            'adult_no'=> '',
            'child_no'=> '',
            'infant_no'=> '',
        ];
    }

    public function messages()
    {
        return [
            'location_from.different' => 'The origin and destination must be different.',
        ];
    }

}
