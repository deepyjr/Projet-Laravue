<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class robot extends FormRequest
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
            'objetId' => ['required', 'integer'], 'prix' => ['required', 'integer'],
            'produit_menager' => ['required', 'integer'],
            'outils_menager' => ['required', 'integer'],
            'quantite_produit_restant' => ['required', 'integer'],
            'quantite_outil_restant' => ['required', 'integer'],
            'name' => ['require', 'string', 'max:100'],
            'dernier_lavage' => ['require'],
        ];
    }
}