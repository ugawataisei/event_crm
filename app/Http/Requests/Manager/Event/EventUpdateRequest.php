<?php

namespace App\Http\Requests\Manager\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
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
            'id' => 'required|numeric|exists:events',
            'name' => 'required|string',
            'information' => 'required|string',
            'event_date' => 'required|string|',
            'start_time' => 'required|string',
            'end_time' => 'required|string|after:start_time',
            'max_people' => 'required|numeric',
            'is_visible' => 'required|boolean',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return __('event.attribute_labels');
    }
}


