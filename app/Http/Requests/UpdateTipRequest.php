<?php

namespace App\Http\Requests;

use App\Models\Tip;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTipRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tip_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'max:70',
                'required',
                'unique:tips,title,' . request()->route('tip')->id,
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
