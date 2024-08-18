@extends('Dashboard.Layouts.master')

@section('title') "{{__('main.commission')}}"@stop

@section('content')


    <div class="card">
        <div class="card-header header-elements-inline"><h2>Monthly Commissions</h2>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Restaurant Name</th>
                <th>Year</th>
                <th>Month</th>
                <th>Total Commission</th>
                <th>Total Paid</th>
                <th>Remaining</th>
            </tr>
            </thead>
            <tbody>
            @foreach($commissions as $commission)
                <tr>
                    <td>{{ $commission['restaurant_name'] }}</td>
                    <td>{{ $commission['year'] }}</td>
                    <td>{{ $commission['month'] }}</td>
                    <td>{{ $commission['total_commission'] }}</td>
                    <td>{{ $commission['total_paid'] }}</td>
                    <td>{{ $commission['remaining'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
