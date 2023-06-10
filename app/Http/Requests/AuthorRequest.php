<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthorRequest extends FormRequest
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

    public function validationData()
    {
        $data = $this->all();

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $data['id'] = $this->route('id');
        }

        return $data;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if ($this->isMethod('post')) {
            // Validación de inserción
            return [
                'name'      => 'required|string',
                'last_name'   => 'required|string',
            ];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            // Validación de actualización

            return [
                'id' => [
                    'required',
                    Rule::exists('authors')->where(function ($query) {
                        $query->where('id', $this->route('id'));
                    }),
                    'name'      => 'string',
                    'last_name' => 'string',
                ]
            ];
        }
    }
}
