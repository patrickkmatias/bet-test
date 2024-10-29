<?php

namespace App\Http\Requests;

use App\Rules\ValidCpf;
use Illuminate\Foundation\Http\FormRequest;

class StoreAffiliateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'affiliate' => ['required', 'array'],
            'affiliate.user_id' => ['required', 'numeric'],
            'affiliate.birthdate' => ['required', 'date'],
            'affiliate.cpf' => ['required', 'string', new ValidCpf],
            'affiliate.phone_number' => ['required', 'string'],
            'affiliate.active' => ['nullable', 'boolean'],

            'address' => ['required', 'array'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
            'address.street' => ['required', 'string'],
        ];
    }
}
