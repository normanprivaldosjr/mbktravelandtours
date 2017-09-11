<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelReservationInquiryFormRequest extends FormRequest
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
            'location_name' => 'required',
            'name' => 'required|max:255',
            'phone_number' => 'required|max:25',
            'email_address' => 'required|max:150|email',
            'adult_no' => 'required',
            'child_no' => '',
            'for_work' => '',
            'no_of_rooms' => 'required',
            'check_in'=> 'date|required|before_or_equal:check_out',
            'check_out'=> 'date',
            'birthday'=> 'date|required',

        ];
    }
}
