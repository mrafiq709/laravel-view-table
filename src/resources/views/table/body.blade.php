<tbody>
    @forelse($data as $item)
        <tr>
            @foreach($columns as $column)
                @php
                    $cell = isset($column['cell']) ?
                        (View::exists('table.cells.'.$column['cell']) || View::exists('scuti::table.cells.'.$column['cell'])
                            ? $column['cell'] : 'text')
                        : 'text';
                    $value = isset($column['data'])
                        ? ($item[$column['data']] ?? null)
                        : ($item['id'] ?? null);
                    $options = $column['options'] ?? [];
                    $rowData = $item;
                @endphp
                @includeFirst(['table.cells.'.$cell, 'scuti::table.cells.'.$cell ], compact('value', 'table', 'options', 'rowData'))
            @endforeach
        </tr>
    @empty
        <tr>
            <td colspan="{{ count($columns) }}">{{ __('No records found!') }}</td>
        </tr>
    @endforelse
</tbody>
