@extends('Dashboard.Layouts.master')

@section('title')
    {{__('main.permissions')}}
@endsection

@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{__('main.table')}} {{__('main.permissions')}} : {{$permissions->count()}}</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <code></code><strong> </strong>
            <a href="{{route('permission.create')}}">
                <button class="btn bg-teal "><b><i class="icon-plus3"></i></b>
                    {{__('main.create')}}
                </button>
            </a>

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

                <th>{{__('main.actions')}}</th>
            </tr>
            </thead>
            <div>

                <tbody>
                @php $counter = 1 @endphp
                 @isset($permissions)
                 @foreach($permissions as $item)
                     <tr>
                         <td>{{$counter++}}</td>
                         <td>{{$item->name}}</td>

                         <td>
                             <div class="list-icons">
                                 <div class="list-icons-item dropdown">
                                     <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                         <i class="icon-menu9"></i>
                                     </a>
                                     <div class="dropdown-menu ">
                                         <a href="{{route('permission.edit',$item->id)}}" class="dropdown-item"><i class="icon-pencil7"></i> {{__('main.edit')}} </a>

                                         <div class="dropdown-divider"></div>
                                         <form action="{{route('permission.destroy',$item->id)}}" method="POST">
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
    </div>

@endsection
