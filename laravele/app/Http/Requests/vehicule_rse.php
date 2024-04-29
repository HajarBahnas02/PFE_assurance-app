<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class vehicule_rse extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "motorisationId"=>["required","integer"],
            "puissanceFiscale"=>["required","integer"],
            "valeurNouvelle"=>["required","numeric"],
            "valeurVenale"=>["required","numeric"],
            "marqueId"=>["required","integer"],
            "modeleId"=>["required","integer"],
            "dateCirculation"=>["required","date"],
            "villeId"=>["required","integer"]
            
        ];
    }
}
