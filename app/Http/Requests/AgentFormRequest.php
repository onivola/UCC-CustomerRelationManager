<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'Noms_commerciaux' => 'required',
            'Adresse_postale' =>'required',
            'code_postale' => 'required',
            'Numero_SIRET' => 'required',
            'ville' => 'required',
            'name' => 'required',
            'first_name' => 'required',
            'function' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'exterieur' => 'required',
            'type' => 'required',
            'Agent' => 'required',
            'PR30WMCEE' => 'required',
            'PR50WMCEE' => 'required',
            'PR100WMCEE' => 'required',
            'HUB1600RWBCEE' => 'required',
            ];
    }
}
