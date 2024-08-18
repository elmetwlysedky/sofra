@extends('Dashboard.Layouts.master')

@section('title')
    {{__('main.edit')}} {{$category->name}}
@endsection


@section('content')



    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{__('main.edit')}} {{$category->name}}</h5>
        </div>

        <div class="card-body">
            <p class="mb-4"></p>
            <Form action="{{route('category.update',$category->id)}}" class="form-validate-jquery" method="POST" >
                @csrf
                @method('PATCH')

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group row">
                    <label class="col-form-label col-lg-3">name<span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="name" value="{{$category->name}}" class="form-control" placeholder="inter category name">
                    </div>
                </div>

                <button type="submit" class="btn bg-teal-300 btn-labeled btn-labeled-right"> update</button>
            </Form>
        </div>
    </div>
@endsection
