<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Validator instance updated on failedValidation
     *
     * @var \Illuminate\Contracts\Validation\Validator
     */
    public $validator = null;

    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

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
            'title'      => 'required',
            'content'    => 'required',
            'website_id' => 'required|exists:websites,id'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }


}
