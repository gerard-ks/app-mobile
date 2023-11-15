<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributionRequest extends FormRequest
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
            'chauffeurs' => 'required|array',
            'chauffeurs.*' => 'exists:chauffeurs,id', // Assuming 'chauffeurs' is an array of IDs in your form

            'vehicules' => 'required|array',
            'vehicules.*' => 'exists:vehicules,id', // Assuming 'vehicules' is an array of IDs in your form
        ];
    }
}
