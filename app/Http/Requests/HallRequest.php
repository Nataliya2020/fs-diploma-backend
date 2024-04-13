<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class HallRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'rows' => 'integer',
            'chairs_in_row' => 'integer',
            'total_chairs' => 'integer',
            'blocked_chairs' => 'string',
            'price_vip_chair' => 'integer',
            'price_standart_chair' => 'integer',
            'is_active' => 'required|boolean'
        ];
    }
}
