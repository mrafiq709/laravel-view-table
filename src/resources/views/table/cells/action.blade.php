@php
    $base_route = $table['base_route'] ?? '';
@endphp
<td>
    <a class="btn btn-sm btn-success"
       data-toggle="tooltip"
       title="{{ trans('View this record') }}"
       href="{{ Route::has($base_route.'.show') ? route($base_route.'.show', $value) : '#' }}"
       data-id="{{ $value }}"
       data-action="view-item">
        <i class="fa fa-search-plus"></i>
    </a>
    <a class="btn btn-sm btn-warning"
       data-toggle="tooltip"
       title="{{ trans('Edit this record') }}"
       href="{{ Route::has($base_route.'.edit') ? route($base_route.'.edit', $value) : '#' }}"
       data-id="{{ $value }}"
       data-action="edit-item">
        <i class="fa fa-edit"></i>
    </a>
    <form method="post"
          onsubmit='return confirm("{{ trans('Delete this record?') }}")'
          action="{{ Route::has($base_route.'.destroy') ? route($base_route.'.destroy', $value) : '#' }}"
          style="display: inline">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip"
                title="{{ trans('Delete this record') }}">
            <i class="fa fa-trash"></i>
        </button>
    </form>
</td>