<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class outils_menager extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['require', 'string', 'max:100'],
            'prix' => ['required', 'integer'],
        ];
    }
}