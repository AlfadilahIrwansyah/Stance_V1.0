@extends('layouts.app')

@section('content')
    <div class="container px-2 mx-auto">
        <form action="{{ route('filtered.expense') }}" method="GET">
            <h1 class="text fw-bolder">Finance Reports</h1>
            <div class="row d-flex">
                <div class="col-md-5 h-100">
                    <div class="p-3 m-5 bg-chart rounded shadow" id="chart">
                        <div>
                            {!! $chart['barchart']->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 h-100">
                    <div class="p-3 m-5 rounded shadow">
                        <h4>Sales Data</h4>
                        <select name="month" onchange="this.form.submit()">
                            <option value="" {{ $selectedMonth == 'all' ? 'selected' : '' }}>All Months</option>
                            @foreach ($salesMonth as $month)
                                <option value="{{ $month->month_number }}"
                                    {{ $selectedMonth == $month->month_number ? 'selected' : '' }}>
                                    {{ $month->month_name }}
                                </option>
                            @endforeach
                        </select>
                        <select name="item_grid" onchange="this.form.submit()">
                            <option value="" {{ $selectedItemGrid == 'all' ? 'selected' : '' }}>All items</option>
                            @foreach ($itemName as $item)
                                <option value="{{ $item->ITEM_NAME }}"
                                    {{ $selectedItemGrid == $item->item_name ? 'selected' : '' }}>
                                    {{ $item->item_name }}
                                </option>
                            @endforeach
                        </select>
                        <table class="table table-bordered border-dark">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Total Sales</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salesData as $data)
                                    <tr>
                                        <td>{{ $data->item_name }}</td>
                                        <td>{{ $data->amount }}</td>
                                        <td>{{ date('l d F Y', strtotime($data->date_sale)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ $chart['barchart']->cdn() }}"></script>
    {{ $chart['barchart']->script() }}
    <script src="{{ $chart['linechart']->cdn() }}"></script>
    {{ $chart['linechart']->script() }}
    <script src="{{ $chart['HoriBarchart']->cdn() }}"></script>
    {{ $chart['HoriBarchart']->script() }}
@endsection
