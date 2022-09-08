<?php

namespace App\Http\Requests;

use App\Models\Tip;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTipRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tip_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'max:70',
                'required',
                'unique:tips',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'countries.*' => [
                'integer',
            ],
            'countries' => [
                'array',
            ],
        ];
    }
}
