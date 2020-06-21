<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->redirect()->back()->with('error', sprintf( $validator->errors()->all()[0]));

        return [
            'name' => 'required|alpha_num|max:255',
            'surname' => 'required|alpha_num|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|numeric|digits_between:10,15',
            'role' => 'required',
        ];
    }
}
