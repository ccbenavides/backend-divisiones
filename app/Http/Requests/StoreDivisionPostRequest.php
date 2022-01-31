<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class StoreDivisionPostRequest extends FormRequest
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
            'name' => ['required', 'max:45', \Illuminate\Validation\Rule::unique('divisions')->ignore($this->id)],
            'count_collaborators' => 'integer'
        ];
    }
    public function response(array $errors)
    {
        return new JsonResponse(['error' => $errors], 400);
    }
}

