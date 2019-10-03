<table @foreach($attributes as $key => $value) {{$key}}="{!! $value !!}" @endforeach>
    @include('scuti::table.header')
    @include('scuti::table.body')
</table>

@if($pagination)
    <nav>
        {!! $pagination !!}
    </nav>
@endif

@section('styles')
    <style>
        table th.orderable {
            cursor: pointer;
            position: relative;
        }
        table th.orderable:before,
        table th.orderable:after,
        table th.ordering_asc:before,
        table th.ordering_asc:after,
        table th.ordering_desc:before,
        table th.ordering_desc:after {
            position: absolute;
            bottom: 0.9em;
            display: block;
            opacity: 0.3;
        }
        table th.orderable:before,
        table th.ordering_asc:before,
        table th.ordering_desc:before {
            right: 1em;
            content: "\2191";
        }
        table th.orderable:after,
        table th.ordering_asc:after,
        table th.ordering_desc:after {
            right: 0.5em;
            content: "\2193";
        }
        table th.ordering_asc:before,
        table th.ordering_desc:after {
            opacity: 1;
        }
    </style>
@endsection

@section('script')
    <script type="text/javascript">
        $('th.orderable').click(function (e) {
            const orderField = $(e.currentTarget).data('order');
            if (typeof handleOrder === "function") {
                //Custom handle
                handleOrder(orderField);
            } else {
                //Default handle
                request = {!! json_encode(request()->all(), JSON_FORCE_OBJECT) !!};

                if ('{!! $ordering['field'] !!}' == orderField) {
                    request.{!! $orderConfig['dir'] !!} = '{!! $ordering['dir'] !!}'=='asc' ? 'desc' : 'asc';
                } else {
                    request.{!! $orderConfig['field'] !!} = orderField;
                    request.{!! $orderConfig['dir'] !!} = 'asc';
                }
                delete request.page;
                location.href = '{!! url()->current() !!}' + '?' + $.param(request)
            }
        })
    </script>
@endsection
