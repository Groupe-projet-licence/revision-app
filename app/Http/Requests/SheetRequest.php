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
            'description'=> ['nullable','string','max:50'],
            'content'=> ['required','string','min:4'],
            'category_id' => 'required | exists:categories,id',
        ];
    }
    protected function prepareForValidation(){
        return $this->merge([
            'description'=> trim($this->input('description')) ? trim($this->input('description')) : 'Sheet without description' ,
            'content' => $this->input('content')== '<p><br></p>' ? '' : $this->input('content'),
        ]);
    }
}
