@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.trip.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.trips.update", [$trip->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.trip.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Trip::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $trip->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.trip.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $trip->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="starts_at">{{ trans('cruds.trip.fields.starts_at') }}</label>
                <input class="form-control date {{ $errors->has('starts_at') ? 'is-invalid' : '' }}" type="text" name="starts_at" id="starts_at" value="{{ old('starts_at', $trip->starts_at) }}">
                @if($errors->has('starts_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('starts_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.starts_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ends_at">{{ trans('cruds.trip.fields.ends_at') }}</label>
                <input class="form-control date {{ $errors->has('ends_at') ? 'is-invalid' : '' }}" type="text" name="ends_at" id="ends_at" value="{{ old('ends_at', $trip->ends_at) }}">
                @if($errors->has('ends_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ends_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.ends_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.trip.fields.arrived_by') }}</label>
                <select class="form-control {{ $errors->has('arrived_by') ? 'is-invalid' : '' }}" name="arrived_by" id="arrived_by">
                    <option value disabled {{ old('arrived_by', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Trip::ARRIVED_BY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('arrived_by', $trip->arrived_by) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('arrived_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('arrived_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.arrived_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.trip.fields.purpose') }}</label>
                <select class="form-control {{ $errors->has('purpose') ? 'is-invalid' : '' }}" name="purpose" id="purpose">
                    <option value disabled {{ old('purpose', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Trip::PURPOSE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('purpose', $trip->purpose) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('purpose'))
                    <div class="invalid-feedback">
                        {{ $errors->first('purpose') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.purpose_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.trip.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $trip->description) }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.description_helper') }}</span>
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