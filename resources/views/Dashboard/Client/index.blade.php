@extends('Dashboard.Layouts.master')

@section('title')
    {{__('main.clients')}}
@endsection

@section('content')

    <!-- Content area -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{__('main.table')}} {{__('main.clients')}} : {{$clients->count()}}</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">



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
                <th>{{__('main.name')}}</th>
                <th>{{__('main.phone')}}</th>
                <th>{{__('main.email')}}</th>
                <th>{{__('main.address')}}</th>
                <th>{{__('main.actions')}}</th>

            </tr>
            </thead>
            <div>

                <tbody>
                @php $counter = 1 @endphp
                @isset($clients)
                    @foreach ($clients as $item )
                        <tr>
                            <td>{{$counter++}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->region->name}} ... {{$item->region->city->name}} </td>
                            <td>
                                <div class="list-icons">
                                    <div class="list-icons-item dropdown">
                                        <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu ">
                                            <a href="{{route('client.orders',$item->id)}}" class="dropdown-item"><i class="fas fa-cart-arrow-down mr-3"></i> {{__('main.orders')}} </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{route('client.delete',$item->id)}}" method="POST"  >
                                                @csrf
                                                @method('DELETE')

                                                <button class="dropdown-item" type="submit"><i class="icon-bin"> </i>{{__('main.delete')}}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                @endisset
                </tbody>
            </div>

        </table>

        <!-- /media library -->


        <!-- /content area -->
        <div class="card card-body border-top-1 border-top-pink text-center">
            <ul class="pagination pagination-separated align-self-center">
{{--                {!! $clients->links() !!}--}}

            </ul>
        </div>

@endsection

@section('script')

@endsection




