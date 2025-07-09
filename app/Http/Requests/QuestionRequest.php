<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'question_text' => 'required|string',
            'type' => 'required|in:single,multiple',
            'answers' => 'required|array|min:2',
            'answers.*.answer_text' => 'required|string',
            'answers.*.is_correct' => 'required|boolean',
        ];
    }
    protected function prepareForValidation(){
        $this->merge([
            'question_text' => $this->input('question_text') == '<p><br></p>' ? '' : $this->input('question_text'),
        ]);
        $answers= $this->input('answers');
        foreach ($answers as $index => $answer) {
            $answers[$index]['answer_text'] = $answer['answer_text'] == '<p><br></p>' ? '' : $answer['answer_text'];
        }
        $this->merge([
            'answers' => $answers
        ]);
    }
}
