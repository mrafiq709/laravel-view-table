@php
    $columns = $table['columns'] ?? [];
    $request = request()->all() ?? [];
@endphp
<thead>
    <tr>
        @foreach($columns as $column)
            <th @if(isset($column['sortable']) && $column['sortable'])class="sortable" data-sort="{{ $column['field'] }}"@endif>
                {{ $column['title'] ?? '' }}
                @if(isset($column['sortable']) && $column['sortable'])
                    @if(isset($request['sort_by']) && $request['sort_by'] == $column['field'])
                        <i class="fa fa-sort-{{ ($request['sort'] == 'asc') ? 'up' : 'down'}}"></i>
                    @else
                        <i class="fa fa-sort"></i>
                    @endif
                @endif
            </th>
        @endforeach
    </tr>
</thead>