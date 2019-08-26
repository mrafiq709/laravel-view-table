@php
    $columns = $table['columns'] ?? [];
    $data = $table['data'] ?? [];
@endphp
<tbody>
    @foreach($data as $item)
        <tr>
            @foreach($columns as $column)
                @php
                    $cell = isset($column['cell']) ?
                        (View::exists('table.cells.'.$column['cell']) || View::exists('scuti::table.cells.'.$column['cell'])
                            ? $column['cell'] : 'text')
                        : 'text';
                    $value = isset($column['field'])
                        ? ($item[$column['field']] ?? null)
                        : ($item['id'] ?? null);
                    $options = $column['options'] ?? [];
                @endphp
                @includeFirst(['table.cells.'.$cell, 'scuti::table.cells.'.$cell ], compact('value', 'table', 'options'))
            @endforeach
        </tr>
    @endforeach
</tbody>