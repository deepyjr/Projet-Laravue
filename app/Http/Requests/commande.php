<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class commande extends FormRequest
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
            'clientId' => ['required', 'integer'],
            'objetId' => ['required', 'integer'],
            'status' => ['required', 'string', 'max:100'],
            'date_commande' => ['required'],
            'date_debut' => ['required'],
            'date_fin' => ['required'],

        ];
    }
}