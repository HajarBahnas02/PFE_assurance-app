<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Vehicule_rse extends FormRequest
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
            'matricule' => ['required', 'string', 'unique:vehicules,matricule'],
            'puissanceFiscale' => ['required', 'numeric'],
            'dateMiseEnCirculation' => ['required', 'date'],
            'valeurNeuve' => ['required', 'numeric'],
            'valeurVenale' => ['required', 'numeric'],
            'modele_id' => ['required', 'exists:modeles,id'],
            'type_motorisation_id' => ['required', 'exists:type_motorisations,id'],
            'marque_id' => ['required', 'exists:marques,id']
        ];

    }
}
