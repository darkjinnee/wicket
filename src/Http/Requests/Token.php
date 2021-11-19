<?php

namespace Darkjinnee\Wicket\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Token
 * @package Darkjinnee\Wicket\Http\Requests
 */
class Token extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'token_name' => ['string']
        ];
    }
}
