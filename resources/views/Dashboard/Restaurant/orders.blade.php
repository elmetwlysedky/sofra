@extends('Dashboard.Layouts.master')

@section('title')
    {{__('main.orders')}}
@endsection

@section('content')

    <!-- Content area -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{__('main.table')}} {{__('main.orders')}} : {{$orders->count()}}</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>



        <div class="container">

            @if(Session::has('success'))
                <div class="alert alert-success border-0 alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    <span class="font-weight-semibold">{{session('success')}}</span>
                </div>
            @elseif(Session::has('delete'))
                <div class="alert alert-danger border-0 alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    <span class="font-weight-semibold ">{{session('delete')}}</span>
                </div>

            @endif
        </div>
        <table class="table datatable-basic">
            <thead>

            <tr>
                <th>#</th>
                <th>{{__('main.client')}} {{__('main.name')}}</th>
                <th>{{__('main.status')}}</th>
                <th>{{__('main.price')}}</th>
                <th>{{__('main.notes')}}</th>


            </tr>
            </thead>


                <tbody>
                @php $counter = 1 @endphp
                @isset($orders)
                    @foreach($orders as $item)
                    <tr>
                        <td>{{$counter++}}</td>
                        <td>{{$item->client->name}}</td>
                        <td>{{$item->status}}</td>
                        <td>{{$item->total_price}}</td>
                        <td>{{$item->notes}}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No orders available.</td>
                    </tr>
                @endisset
                </tbody>


        </table>
        <!-- /content area -->
        <div class="card card-body border-top-1 border-top-pink text-center">
            <ul class="pagination pagination-separated align-self-center">
{{--                {!! ->links() !!}--}}

            </ul>
        </div>

@endsection
