@extends('Dashboard.Layouts.master')

@section('title')
{{__('main.employees')}}
@endsection



@section('content')

    <!-- Basic datatable -->
    <div class="card"	>
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{__('main.table')}} {{__('main.employees')}} : {{$users->count()}}</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>





        <div class="row">
            {{--   search     --}}
        <form action="#" method="get">

            <div class="col-lg-11">
                <div class="input-group-append">
                    <input type="text" class="form-control"placeholder="@lang('main.search')" name="search" value="{{ request()->search }}">

                    <button type="submit" class="btn bg-blue " > @lang('main.search')</button>
                </div>
            </div>
        </form>

            {{--        @if(auth()->user()->hasPermission('users-create'))--}}
            <a href="{{route('user.create')}}">
                <button class="btn bg-teal "><b><i class="icon-plus3"></i></b>
                    {{__('main.add')}} {{__('main.employee')}}
                </button>
            </a>
            {{--        @endif--}}

        </div>


        @if(Session::has('success'))
            <div class="alert alert-success border-0 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                <span class="font-weight-semibold">{{session('success')}}</span>
            </div>

        @elseif (Session::has('edit'))

            <div class="alert alert-success border-0 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                <span class="font-weight-semibold ">{{session('edit')}}</span>
            </div>

        @elseif(Session::has('delete'))
            <div class="alert alert-danger border-0 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                <span class="font-weight-semibold ">{{session('delete')}}</span>
            </div>
        @endif

        <legend class="text-uppercase font-size-sm font-weight-bold"></legend>
        <table class="table datatable-basic">
            <thead>
            <tr>

                <th> {{__('main.name')}}</th>
                <th> {{__('main.email')}}</th>
                <th> {{__('main.roles')}}</th>
                <th> {{__('main.permissions')}}</th>

                <th class="text-center">{{__('main.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @isset($users)
                @foreach($users as $item)
            <tr>

                <td>{{$item->name}}</td>
                <td>{{Str::of($item->email)->limit(20)}}</td>
                <td>
                    @foreach($item->getRoleNames() as $role)
                        {{$role}}
                    @endforeach
                </td>
                <td>
                    @foreach($item->getPermissionsViaRoles() as $permission)
                        {{$permission->name}}
                    @endforeach
                </td>

                <td class="text-center">
                    <div class="list-icons">
                        <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu ">
                                @if(auth()->user()->can('user permissions'))
                               <a href="{{route('user.role',$item->id)}}" class="dropdown-item">
                                    <i class="icon-file-eye2 mr-3 icon"></i> {{__('main.add')}} {{__('main.permissions')}}
                               </a>

                                @endif

                                <form action="{{route('user.destroy',$item->id)}}" method="POST" >
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
        </table>
    </div>
    <!-- /basic datatable -->

@endsection
