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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'phone_number' => 'required|unique:users,phone_number,' . $this->id,
            'dob' => 'nullable|date',
            'password' => 'nullable|min:8',
            'avatar' => 'nullable|file|image|max:5242',
        ];
    }
}
