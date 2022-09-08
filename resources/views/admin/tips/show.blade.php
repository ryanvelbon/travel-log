@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tip.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tips.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tip.fields.id') }}
                        </th>
                        <td>
                            {{ $tip->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tip.fields.title') }}
                        </th>
                        <td>
                            {{ $tip->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tip.fields.description') }}
                        </th>
                        <td>
                            {{ $tip->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tip.fields.countries') }}
                        </th>
                        <td>
                            @foreach($tip->countries as $key => $countries)
                                <span class="label label-info">{{ $countries->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tips.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection