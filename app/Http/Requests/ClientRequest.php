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
        /*
        return [
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email,{$this->user->id}',
            'password'      => 'required',
            'currency_code' => 'required|max:3',
            'country'       => 'required|max:100',
            'city'          => 'required|max:100',
        ];
        */

        switch ($this->method()) {
            case 'POST':
                return [
                    'name'          => 'required',
                    'email'=>'required|email|unique:users,email',
                    //'email'=>'required|email|unique:users,email,'. $this->id,
                    //'email'         => 'required|email|unique:users,email',
                    'password'      => 'required',
                    'currency_code' => 'required|max:3',
                    'country'       => 'required|max:100',
                    'city'          => 'required|max:100',
                ];
                break;
            case 'PUT':
                return [
                    'email'=>'required|email|unique:users,email,{$this->user->id}',
                    'currency_code' => 'max:3',
                    'country'       => 'max:100',
                    'city'          => 'max:100',
                ];
                break;
            case 'GET':
            case 'DELETE':
            case 'PATCH':
                return [];
                break;
            default:break;
        }
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
