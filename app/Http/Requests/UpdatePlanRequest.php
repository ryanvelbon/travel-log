<?php

namespace App\Http\Requests;

use App\Models\Plan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePlanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('plan_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'max:70',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
