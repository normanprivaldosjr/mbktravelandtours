<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomTourFormRequest extends FormRequest
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
            'name' => 'required|max:250',
            'phone_number' => 'required|max:25',
            'email_address' => 'required|max:150|email',
            'no_of_pax' => 'required',
            'no_of_days'=> 'required',
            'no_of_nights'=> 'required',
            'min_budget'=> 'required',
            'max_budget'=> 'required|greater_than:min_budget',
            'location'=> 'required|max:250',
            'birthday'=> 'date|required',
        ];
    }

    public function messages()
    {
        return [
            'max_budget.greater_than' => 'The maximum budget must be greater than the minimum budget.',
        ];
    }
}
