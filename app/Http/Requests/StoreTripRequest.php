<?php

namespace App\Http\Requests;

use App\Models\Trip;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTripRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('trip_create');
    }

    public function rules()
    {
        return [
            'status' => [
                'required',
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'starts_at' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'ends_at' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
