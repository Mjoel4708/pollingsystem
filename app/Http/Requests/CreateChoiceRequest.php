<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateChoiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'choice' => 'required|string|max:255',
            'question_id' => 'required|exists:questions,id',
        ];
    }

    public function messages()
    {
        return [
            'choice.required' => 'The choice field is required.',
            'question_id.required' => 'The question_id field is required.',
            'question_id.exists' => 'The selected question_id is invalid.',
        ];
    }
}
