<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UserRegisterRequest extends FormRequest
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
            'email' => 'required|unique:users',
            'phone' => 'required|numeric|unique:users',

            'password' => 'required|between:6,255|same:confirm_password',
            'confirm_password' => 'required',
            'name' => 'required|max:15|min:3',
            'country_id' => 'required|numeric',
            'confirm_phone' => 'required',
            'user_type' => 'required',
            'Token' => 'required',
            'apiKey' => 'required',

        ];
    }
     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'name.required' => 'Name is required!',
            'password.required' => 'Password is required!'
        ];
    }
}