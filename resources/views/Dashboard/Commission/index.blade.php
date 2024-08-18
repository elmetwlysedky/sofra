@extends('Dashboard.Layouts.master')

@section('title')
     {{__('main.payments')}}
@endsection


@section('content')

    <!-- Page header -->


    <!-- /page header -->


<!-- Content area -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{__('main.table')}} {{__('main.payments')}} </h5>
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
    <div class="card-body">
         <code></code><strong> </strong>
        <a href="{{route('payment.create')}}">
            <button class="btn bg-teal "><b><i class="icon-plus3"></i></b>
                {{__('main.create')}} {{__('main.payment')}}
            </button>
        </a>
    </div>


    <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('main.amount')}}</th>
                    <th>{{__('main.restaurant')}}</th>
                    <th>{{__('main.month')}}</th>
                    <th>{{__('main.actions')}}</th>
                </tr>
            </thead>
           <tbody>
                @php $counter = 1 @endphp
                @isset($payments)
                @foreach ($payments as $item )
                <tr>
                    <td>{{$counter ++}}</td>
                    <td>{{$item->amount}}</td>
                    <td>{{$item->restaurant->name}}</td>
                    <td>{{$item->created_at->month}}</td>

                    <td>
                        <div class="list-icons">
                            <div class="list-icons-item dropdown">
                                <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
{{--                                    <a href="{{route('region.show',[$item->id])}}" class="dropdown-item"><i class="icon-file-eye2 mr-3 icon"></i> show </a>--}}
                                    <a href="{{route('payment.edit',$item->id)}}" class="dropdown-item"><i class="icon-pencil7"></i> Edit </a>

                                    <div class="dropdown-divider"></div>
                                    <form action="{{route('payment.delete',$item->id)}}" method="POST"  >
                                        @csrf
                                        @method('DELETE')

                                    <button class="dropdown-item" type="submit"><i class="icon-bin"> </i>move to trash</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                @endforeach
                @endisset
            </tbody>
        </table>

    <!-- /media library -->


<!-- /content area -->





@endsection




