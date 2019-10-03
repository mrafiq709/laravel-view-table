<thead>
    <tr>
        @foreach($columns as $column)
            @php
                $orderable = $column['orderable'] ?? false;
                $orderClass = $orderable && $ordering['field'] == $column['data'] ?
                    'ordering_' . $ordering['dir'] :
                    '';
            @endphp
            <th @if($orderable)class="orderable {{$orderClass}}" data-order="{{ $column['data'] }}"@endif>
                {{ $column['title'] ?? '' }}
            </th>
        @endforeach
    </tr>
</thead>
