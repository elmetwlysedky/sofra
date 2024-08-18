@extends('Dashboard.Layouts.master')

@section('title')
    Edit {{__('main.setting')}}
@endsection


@section('content')



    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Edit </h5>
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
            <p class="mb-4"> <strong></strong> <code></code>  </p>
            <Form action="{{route('setting.commission.update')}}" class="form-validate-jquery" method="post" enctype="multipart/form-data">
                @csrf


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @foreach($data as $key => $value )
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ ucfirst(str_replace('_', ' ', $key)) }}:<span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="{{$key}}" class="form-control" value="{{$value}}">
                        </div>
                    </div>
                @endforeach

                <button type="submit" class="btn bg-teal-400 btn-labeled ">حفظ</button>
            </Form>
        </div>
    </div>




@endsection
