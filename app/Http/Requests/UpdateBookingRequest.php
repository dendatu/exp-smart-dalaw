<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'facility_id' => ['required', 'integer', 'exists:facilities,id'],
            'pdl_name' => ['required', 'string', 'max:255'],
            'visitor_full_name' => ['required', 'string', 'max:255'],
            'visitor_email' => ['nullable', 'email', 'max:255'],
            'visitor_contact' => ['required', 'string', 'max:20'],
            'visitor_sex' => ['required', 'string', 'in:Male,Female'],
            'visitor_age' => ['required', 'integer', 'min:1', 'max:120'],
            'visitor_id_type' => ['required', 'string', 'max:50'],
            'visitor_id_number' => ['required', 'string', 'max:50'],
            'relationship_to_pdl' => ['required', 'string', 'max:100'],
            'visit_date' => ['required', 'date', 'after:today'],
            'time_slot' => ['required', 'string', 'max:50'],
        ];
    }
}
