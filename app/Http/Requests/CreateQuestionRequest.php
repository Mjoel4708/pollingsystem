<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'question' => 'required|max:255',
            'poll_id' => 'required|exists:polls,id',
        ];
    }

    public function messages()
    {
        return [
            'question.required' => 'The question field is required.',
            'poll_id.required' => 'The poll_id field is required.',
            'poll_id.exists' => 'The selected poll_id is invalid.',
        ];
    }
}
