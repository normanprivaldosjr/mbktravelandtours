<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartItemFormRequest extends FormRequest
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
            'tour_package' => 'required',
            'package_type' => 'required',
            'no_of_pax' => 'required',
            'chosen_travel_date' => 'date|required',
        ];
    }

    public function messages()
    {
        return [
            'chosen_travel_date.required' => 'Travel date is required.',
        ];
    }
}
