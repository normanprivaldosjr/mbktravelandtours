<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 21/09/2017
 * Time: 7:33 AM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PackageImageRequest extends FormRequest
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
        return [ 'id' => 'required', 'package_image' => 'required' ];
    }
}