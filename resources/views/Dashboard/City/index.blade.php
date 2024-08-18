@extends('Dashboard.Layouts.master')

@section('title')
     {{__('main.cities')}}
@endsection


@section('content')

    <!-- Page header -->
    <div class="card">
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-arrow-right6 mr-2"></i> <span class="font-weight-semibold">Home</span> - Dashboard</h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        <span class="breadcrumb-item active">Dashboard</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

            </div>
        </div>
    </div>
    <!-- /page header -->


<!-- Content area -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">users table</h5>
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
        <a href="{{route('city.create')}}">
            <button class="btn bg-teal "><b><i class="icon-plus3"></i></b>
                Create City
            </button>
        </a>
    </div>


    <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
           <tbody>
                @php $counter = 1 @endphp
                @isset($cities)
                @foreach ($cities as $item )
                <tr>
                    <td>{{$counter ++}}</td>
                    <td>{{$item->name}}</td>
                    <td>
                        <div class="list-icons">
                            <div class="list-icons-item dropdown">
                                <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{route('city.show',[$item->id])}}" class="dropdown-item"><i class="icon-file-eye2 mr-3 icon"></i> show </a>
                                    <a href="{{route('city.edit',$item->id)}}" class="dropdown-item"><i class="icon-pencil7"></i> Edit </a>

                                    <div class="dropdown-divider"></div>
                                    <form action="{{route('city.delete',$item->id)}}" method="POST"  >
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




