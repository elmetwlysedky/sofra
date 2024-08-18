 @extends('Dashboard.layouts.master')

 @section('title')  @stop

@section('content')


<!-- Content area -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Message Table</h5>
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
    </div>


    <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>title</th>
                    <th>Send Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <div>@php $counter = 1 @endphp
                @isset($contacts)
                @foreach ($contacts as $item )
                <tr>
                    <td>{{$counter++}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->title}}</td>

                    <td>{{$item->created_at->diffForhumans()}}</td>


                    </td>
                    <td>
                        <div class="list-icons">
                            <div class="list-icons-item dropdown">
                                <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-left">
                                    <a href="{{route('contact.show',[$item->id])}}" class="dropdown-item"><i class="icon-file-eye2 mr-3 icon"></i> show </a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{route('contact.delete',$item->id)}}" method="POST"  >
                                        @csrf
                                        @method('DELETE')

                                    <button class="dropdown-item" type="submit"><i class="icon-bin"> </i>move to trash</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </div>
                @endforeach
                @endisset
            </tbody>
    </table>
</div>
    <!-- /media library -->


<!-- /content area -->





@endsection




