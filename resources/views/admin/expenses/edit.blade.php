@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.expense.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.expenses.update", [$expense->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="date">{{ trans('cruds.expense.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $expense->date) }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount_eur">{{ trans('cruds.expense.fields.amount_eur') }}</label>
                <input class="form-control {{ $errors->has('amount_eur') ? 'is-invalid' : '' }}" type="number" name="amount_eur" id="amount_eur" value="{{ old('amount_eur', $expense->amount_eur) }}" step="0.01" required>
                @if($errors->has('amount_eur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount_eur') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.amount_eur_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.expense.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $expense->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.expense.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $expense->description) }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="trip_id">{{ trans('cruds.expense.fields.trip') }}</label>
                <select class="form-control select2 {{ $errors->has('trip') ? 'is-invalid' : '' }}" name="trip_id" id="trip_id">
                    @foreach($trips as $id => $entry)
                        <option value="{{ $id }}" {{ (old('trip_id') ? old('trip_id') : $expense->trip->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('trip'))
                    <div class="invalid-feedback">
                        {{ $errors->first('trip') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.trip_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.expense.fields.category') }}</label>
                <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category" id="category" required>
                    <option value disabled {{ old('category', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Expense::CATEGORY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('category', $expense->category) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection