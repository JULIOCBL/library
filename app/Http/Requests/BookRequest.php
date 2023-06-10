<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
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
                'title'         => 'required|string',
                'description'   => 'required|string',
                'year'          => 'required|integer|digits:4',
                'author_id'     => 'required|exists:authors,id',
                'editorial_id'  => 'required|exists:editorials,id',
            ];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            // Validación de actualización
         
            return [
                'id' => [
                    'required',
                    Rule::exists('books')->where(function ($query)  {
                        $query->where('id', $this->route('id'));
                    }),
                ],
                'title'         => 'string',
                'description'   => 'string',
                'year'          => 'integer|digits:4',
                'author_id'     => 'exists:authors,id',
                'editorial_id'  => 'exists:editorials,id',
            ];
        }
    }
}
