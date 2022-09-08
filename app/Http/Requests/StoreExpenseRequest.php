<?php

namespace App\Http\Requests;

use App\Models\Expense;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreExpenseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('expense_create');
    }

    public function rules()
    {
        return [
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'amount_eur' => [
                'required',
            ],
            'title' => [
                'string',
                'max:70',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'category' => [
                'required',
            ],
        ];
    }
}
