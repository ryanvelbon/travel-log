@extends('layouts.admin')
@section('content')
@can('trip_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.trips.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.trip.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.trip.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Trip">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.trip.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.trip.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.trip.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.trip.fields.starts_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.trip.fields.ends_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.trip.fields.arrived_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.trip.fields.purpose') }}
                        </th>
                        <th>
                            {{ trans('cruds.trip.fields.description') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trips as $key => $trip)
                        <tr data-entry-id="{{ $trip->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $trip->id ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Trip::STATUS_SELECT[$trip->status] ?? '' }}
                            </td>
                            <td>
                                {{ $trip->city->name ?? '' }}
                            </td>
                            <td>
                                {{ $trip->starts_at ?? '' }}
                            </td>
                            <td>
                                {{ $trip->ends_at ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Trip::ARRIVED_BY_SELECT[$trip->arrived_by] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Trip::PURPOSE_SELECT[$trip->purpose] ?? '' }}
                            </td>
                            <td>
                                {{ $trip->description ?? '' }}
                            </td>
                            <td>
                                @can('trip_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.trips.show', $trip->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('trip_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.trips.edit', $trip->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('trip_delete')
                                    <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('trip_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.trips.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Trip:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection