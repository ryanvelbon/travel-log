@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.expense.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.expenses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.id') }}
                        </th>
                        <td>
                            {{ $expense->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.date') }}
                        </th>
                        <td>
                            {{ $expense->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.amount_eur') }}
                        </th>
                        <td>
                            {{ $expense->amount_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.title') }}
                        </th>
                        <td>
                            {{ $expense->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.description') }}
                        </th>
                        <td>
                            {{ $expense->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.trip') }}
                        </th>
                        <td>
                            {{ $expense->trip->starts_at ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.category') }}
                        </th>
                        <td>
                            {{ App\Models\Expense::CATEGORY_SELECT[$expense->category] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.expenses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection