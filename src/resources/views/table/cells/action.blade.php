@php
    $base_route = $table['base_route'] ?? '';
@endphp
<td>
    @foreach($actions as $action)
        @switch($action)
            @case (\Scuti\LaravelTable\TableBuilder::ACTION_VIEW)
                <a class="btn btn-square btn-primary"
                   data-toggle="tooltip"
                   title="{{ trans('View this record') }}"
                   href="{{ Route::has($base_route.'.show') ? route($base_route.'.show', $rowData['id']) : '#' }}"
                   data-id="{{ $rowData['id'] }}"
                   data-action="view-item">
                    <i class="fa fa-search-plus"></i>
                </a>
                @break
            @case (\Scuti\LaravelTable\TableBuilder::ACTION_EDIT)
                <a class="btn btn-square btn-warning"
                   data-toggle="tooltip"
                   title="{{ trans('Edit this record') }}"
                   href="{{ Route::has($base_route.'.edit') ? route($base_route.'.edit', $rowData['id']) : '#' }}"
                   data-id="{{ $rowData['id'] }}"
                   data-action="edit-item">
                    <i class="fa fa-edit"></i>
                </a>
                @break
            @case (\Scuti\LaravelTable\TableBuilder::ACTION_DELETE)
                <form method="post"
                      onsubmit='return confirm("{{ trans('Delete this record?') }}")'
                      action="{{ Route::has($base_route.'.destroy') ? route($base_route.'.destroy', $rowData['id']) : '#' }}"
                      style="display: inline">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger btn-square" type="submit" data-toggle="tooltip"
                            title="{{ trans('Delete this record') }}">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
                @break
            @default
                @includeFirst(['table.actions.'.$action, 'scuti::table.actions.'.$action])
        @endswitch
    @endforeach
</td>
