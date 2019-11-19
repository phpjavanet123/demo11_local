<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        //throw new \Exception('ddddd');
        return [
            'name'          => 'required',
            'email'         => 'required|email',
            'password'      => 'required',
            'currency_code' => 'required|max:3',
            'country'       => 'required|max:100',
            'city'          => 'required|min:100',
        ];
    }

    public function messages()
    {
        return [
            'email.required'            => 'Email is required!',
            'name.required'             => 'Name is required!',
            'password.required'         => 'Password is required!',
            'currency_code.required'    => 'Currency Code is required!',
            'country.required'          => 'Country is required!',
            'city.required'             => 'City is required!',
            'city.min'                  => 'City is min length 100 characters!',
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'email' => 'trim|lowercase',
            'name'  => 'trim|capitalize|escape'
        ];
    }
}
