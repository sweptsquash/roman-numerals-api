<?php

namespace App\Http\Requests;

use App\Enums\ConversionSupported;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreConversionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'value' => ['required', 'numeric', 'gt:0', Rule::when($this->conversion === ConversionSupported::RomanNumeral, ['lte:3999'])],
            'conversion' => ['required', Rule::enum(ConversionSupported::class)],
        ];
    }
}
