<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessRequest extends FormRequest
{
    public $validator = null;

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
            'name' => 'required|max:191',
            'surname' => 'required|max:191',
            'email' => 'required|max:191',
            'phone' => 'required|numeric|min:2|',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'business_name' => 'required|max:191',
            'category' => 'required',

//            'address' => 'required|max:191',
//            'desc' => 'max:191',
//            'nuis' => 'required|max:30',
//            'city' => 'required',
//            'open' => 'required',
//            'close' => 'required',
//            'weekend_open' => 'required',
//            'weekend_close' => 'required',
            'url' => 'max:100',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }

}
