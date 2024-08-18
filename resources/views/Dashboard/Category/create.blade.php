@extends('Dashboard.Layouts.master')

@section('title')
    {{__('main.add')}} {{__('main.categories')}}
@endsection

@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{__('main.add')}} {{__('main.categories')}}</h5>
        </div>

        <div class="card-body">
            <p class="mb-4"></p>


            <Form action="{{route('category.store')}}" class="form-validate-jquery" method="post" enctype="multipart/form-data">
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

                <div class="form-group row">
                    <label class="col-form-label col-lg-3">{{__('main.name')}}<span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="name" class="form-control" placeholder="inter category name">
                    </div>
                </div>

                <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-plus3"></i></b>{{__('main.create')}}</button>

            </form>
        </div>
    </div>
@endsection
