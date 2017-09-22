<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 20/09/2017
 * Time: 6:28 AM
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourPackageRequest extends FormRequest
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


    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'slug' => 'required|max:255',
            'package_image' => 'required',
            'no_of_days' => 'required',
            'no_of_nights' => 'required',
            'package_description' => 'required',
            'selling_day_start' => 'required',
            'selling_day_end' => 'required',
            'travel_day_start' => 'required',
            'travel_day_end' => 'required',
            'price_starts' => 'required',
            'destination' => 'required',
            'package_types' => 'required'
        ];
    }
}