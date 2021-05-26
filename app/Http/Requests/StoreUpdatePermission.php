<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePermission extends FormRequest
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
        // é unico name, porem com excessão dele mesmo
        //verifica pelo id, se for o mesmo pode atualizar
        $id = $this->segment(3); //pega 3 posição da url

        return [
            'name' => 'required|min:3|max:255|unique:profiles,name,{$id},id',
            'description' => 'nullable|min:3|max:255',
        ];

    }
}
