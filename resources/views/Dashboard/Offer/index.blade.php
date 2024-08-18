@extends('Dashboard.Layouts.master')

@section('title')
    {{__('main.offers')}}
@endsection

@section('content')

    <!-- Content area -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{__('main.table')}} {{__('main.offers')}} : {{$offers->count()}}</h5>
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
            <td></td>
            <tr>
                <th>#</th>
                <th>{{__('main.name')}}</th>
                <th>{{__('main.image')}}</th>
                <th>{{__('main.description')}}</th>
                <th>{{__('main.start_from')}}</th>
                <th>{{__('main.end_to')}}</th>
                <th>{{__('main.actions')}}</th>
            </tr>
            </thead>
            <div>

                <tbody>
                @php $counter = 1 @endphp
                @isset($offers)
                    @foreach($offers as $item)
                    <tr>
                        <td>{{$counter++}}</td>
                        <td>{{$item->name}}</td>
                        @if($item->image == null)
                            <td><img src="/storage/NOproduct.png" alt="" class="img-preview rounded"  style="width: 70px;height: 50px;"></td>
                        @else
                            <td><img src="/storage/{{$item->image}}" alt="" class="img-preview rounded"  style="width: 70px;height: 50px;"></td>
                        @endif
                        <td>{{Str::limit($item->description,100,'.....')}}
                        <td>{{$item->start_from}}</td>
                        <td>{{$item->end_to}}</td>



                        <td>
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu ">

                                        <form action="{{route('offer.delete',$item->id)}}" method="POST"  >
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
        <!-- /content area -->
        <div class="card card-body border-top-1 border-top-pink text-center">
            <ul class="pagination pagination-separated align-self-center">


            </ul>
        </div>

@endsection
