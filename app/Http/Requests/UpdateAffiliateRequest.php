<?php

namespace App\Http\Requests;

use App\Rules\ValidCpf;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAffiliateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'affiliate' => ['nullable', 'array'],
            'affiliate.user_id' => ['nullable', 'numeric'],
            'affiliate.birthdate' => ['nullable', 'date'],
            'affiliate.cpf' => ['nullable', 'string', new ValidCpf],
            'affiliate.phone_number' => ['nullable', 'string'],
            'affiliate.active' => ['nullable', 'boolean'],

            'address' => ['nullable', 'array'],
            'address.city' => ['nullable', 'string'],
            'address.state' => ['nullable', 'string'],
            'address.street' => ['nullable', 'string'],
        ];
    }
}
