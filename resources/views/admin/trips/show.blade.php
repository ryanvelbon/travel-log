@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.trip.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trips.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.id') }}
                        </th>
                        <td>
                            {{ $trip->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Trip::STATUS_SELECT[$trip->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.city') }}
                        </th>
                        <td>
                            {{ $trip->city->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.starts_at') }}
                        </th>
                        <td>
                            {{ $trip->starts_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.ends_at') }}
                        </th>
                        <td>
                            {{ $trip->ends_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.arrived_by') }}
                        </th>
                        <td>
                            {{ App\Models\Trip::ARRIVED_BY_SELECT[$trip->arrived_by] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.purpose') }}
                        </th>
                        <td>
                            {{ App\Models\Trip::PURPOSE_SELECT[$trip->purpose] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.description') }}
                        </th>
                        <td>
                            {{ $trip->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trips.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#trip_expenses" role="tab" data-toggle="tab">
                {{ trans('cruds.expense.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="trip_expenses">
            @includeIf('admin.trips.relationships.tripExpenses', ['expenses' => $trip->tripExpenses])
        </div>
    </div>
</div>

@endsection