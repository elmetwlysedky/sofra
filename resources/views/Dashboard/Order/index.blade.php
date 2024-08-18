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


        <div class=" col-lg-8">

            <div class="form-group row">

                <form action="{{ route('order.index') }}" method="get">
                    <div class="input-group-append">
                        <input type="text" class="form-control"placeholder="@lang('main.search')"  name="restaurant_name" value="{{ request()->search }}">

                        <button type="submit" class="btn bg-blue " > @lang('main.search')</button>
                    </div>
                </form>

            </div>
            <div class="btn-group btn-group-justified">

                <a href="{{route('order.current')}}" class="btn bg-slate-600"> {{__('main.current')}}</a>
                <a href="{{route('order.pending')}}" class="btn bg-warning-600">{{__('main.pending')}}</a>
                <a href="{{route('order.previous')}}" class="btn btn-success">{{__('main.previous')}}</a>

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
                <th>{{__('main.restaurant')}} {{__('main.name')}}</th>
                <th>{{__('main.client')}} {{__('main.name')}}</th>
                <th>{{__('main.status')}}</th>
                <th>{{__('main.price')}}</th>
                <th>{{__('main.notes')}}</th>
                <th>{{__('main.actions')}}</th>


            </tr>
            </thead>


                <tbody>
                @php $counter = 1 @endphp
                @isset($orders)
                    @foreach($orders as $item)
                    <tr>
                        <td>{{$counter++}}</td>
                        <td>{{$item->restaurant->name}}</td>
                        <td>{{$item->client->name}}</td>
                        <td>{{$item->status}}</td>
                        <td>{{$item->total_price}}</td>
                        <td>{{$item->notes}}</td>
                        <td>
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{route('order.show',[$item->id])}}" class="dropdown-item"><i class="icon-file-eye2 mr-3 icon"></i> show </a>
                                    </div>
                                </div>
                            </div>
                        </td>
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
