<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePlan extends FormRequest
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

        //pega URL do plano, que está na requisição get (verificar na URL), na posição 3
        //para que eu deixe atualizar name do mesmo nome, usando o segment
        $url = $this->segment(3);
        //dd($url);
        //assim podemos atualizar com exceção aí na unique, table plans,coluna name, seja diferente $url da url do banco
        return [
            'name'=> "required|min:3|max:255|unique:plans,name,{$url},url",
            'description'=> 'nullable|min:3|max:255',
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
        ];
    }
}
