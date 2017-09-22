<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 21/09/2017
 * Time: 11:07 AM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateTourPackageRequest extends FormRequest
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
            'id' => 'required',
            'name' => 'required|max:100',
            'slug' => 'required|max:255',
            'no_of_days' => 'required',
            'no_of_nights' => 'required',
            'package_description' => 'required',
            'selling_day_start' => 'required',
            'selling_day_end' => 'required',
            'travel_day_start' => 'required',
            'travel_day_end' => 'required',
            'price_starts' => 'required',
            'destination' => 'required'
        ];
    }
}