<?php

namespace Darkjinnee\Wicket\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Register
 * @package Darkjinnee\Wicket\Http\Requests
 */
class Register extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'token_name' => ['string']
        ];
    }
}
