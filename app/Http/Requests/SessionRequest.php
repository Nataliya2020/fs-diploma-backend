<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
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
            'hall_id' => 'required|integer',
            'film_id' => 'required|integer',
            'session_start_time' => 'required|string',
            'session_date' => 'required|string',
            'paid_chairs' => 'string',
        ];
    }
}
