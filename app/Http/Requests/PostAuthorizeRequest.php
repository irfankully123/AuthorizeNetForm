<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PostAuthorizeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'cardNumber' => 'required|numeric|digits:16',
            'expirationDate' => 'required|date_format:Y-m|after:today',
            'cardCode' => 'required|numeric',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'email' => 'required|email|max:255',
        ];
    }
}
