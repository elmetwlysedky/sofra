@extends('Dashboard.Layouts.master')

@section('title')
Edite {{$region->name}}
@endsection

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Form Edite </h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <p class="mb-4"><strong></strong> <code></code></p>
        <Form action="{{route('region.update',$region->id)}}" class="form-validate-jquery" method="post" enctype="multipart/form-data">
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
                <label class="col-form-label col-lg-3">{{__('main.region')}}<span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="text" name="name" value="{{$region->name}}" class="form-control" placeholder="inter city name">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-lg-3">{{__('main.cities')}}<span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select name="city_id"class="form-control">
                        @foreach($cities as $city)
                            <option value="{{$city->id}}" {{ $region->city_id == $city->id ? 'selected' : '' }}>{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

                <button type="submit" class="btn bg-teal-300 btn-labeled btn-labeled-right"> update</button>
        </Form>
    </div>
</div>

@endsection
