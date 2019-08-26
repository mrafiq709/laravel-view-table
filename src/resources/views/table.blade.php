@php
    $class = $table['class'] ?? "table table-responsive-sm table-bordered table-striped table-hover";
@endphp

<table class="{{ $class }}">
    @if($table['columns'])
        @include('scuti::table.header', compact('table'))
    @endif
    @if($table['data'])
        @include('scuti::table.body', compact('table'))
    @endif
</table>

@if($pagination)
    <nav>
        {!! $pagination !!}
    </nav>
@endif

@section('styles')
    <style>
        table th.sortable {
            cursor: pointer;
        }
        th.sortable .fa-sort {
            opacity: 0.3;
        }
    </style>
@endsection

<script type="text/javascript">
    $('th.sortable').click(function (e) {
        const sortField = $(e.currentTarget).data('sort');
        if (typeof handleSort === "function") {
            //Custom handle
            handleSort(sortField);
        } else {
            //Default handle
            request = {!! json_encode(request()->all(), JSON_FORCE_OBJECT) !!};

            if (request.sort_by && request.sort_by == sortField) {
                request.sort = request.sort=='asc' ? 'desc' : 'asc';
            } else {
                request.sort_by = sortField;
                request.sort = 'asc';
            }
            delete request.page;
            location.href = '{!! url()->current() !!}' + '?' + $.param(request)
        }
    })
</script>