@extends('layouts.admin')
@section('content')
@can('tip_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tips.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.tip.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Tip', 'route' => 'admin.tips.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tip.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Tip">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.tip.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.tip.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.tip.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.tip.fields.countries') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tips as $key => $tip)
                        <tr data-entry-id="{{ $tip->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $tip->id ?? '' }}
                            </td>
                            <td>
                                {{ $tip->title ?? '' }}
                            </td>
                            <td>
                                {{ $tip->description ?? '' }}
                            </td>
                            <td>
                                @foreach($tip->countries as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('tip_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tips.show', $tip->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('tip_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.tips.edit', $tip->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('tip_delete')
                                    <form action="{{ route('admin.tips.destroy', $tip->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('tip_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tips.massDestroy') }}",
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
  let table = $('.datatable-Tip:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection