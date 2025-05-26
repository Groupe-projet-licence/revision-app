<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SheetRequest extends FormRequest
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
            'title'=> ['required','string','min:7'],
            'description'=> ['nullable','string'],
            'content'=> ['required','string','min:4']
        ];
    }
    protected function prepareForValidation(){
        return $this->merge([
            'description'=> trim($this->input('description')) ? trim($this->input('description')) : 'Sheet without description' 
        ]);
    }
}
