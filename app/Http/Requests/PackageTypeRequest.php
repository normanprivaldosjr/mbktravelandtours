<?php
/**
 * Created by PhpStorm.
 * User: Norman
 * Date: 22/09/2017
 * Time: 8:24 AM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PackageTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type_name' => 'required',
            'price' => 'required',
            'help_info' => 'required'
        ];
    }
}