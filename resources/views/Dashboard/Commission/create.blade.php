@extends('Dashboard.Layouts.master')

@section('title')
    {{__('main.add')}} {{__('main.city')}}
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <p class="mb-4"> <strong></strong> <code></code>  </p>


        <Form action="{{route('payment.store')}}" class="form-validate-jquery" method="post" enctype="multipart/form-data">
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
                <label class="col-form-label col-lg-3">{{__('main.amount')}}<span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="text" name="amount" class="form-control" placeholder="the amount paid">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-lg-3">{{__('main.restaurants')}}<span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select name="restaurant_id"class="form-control">
                        @foreach($restaurants as $restaurant)
                            <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-plus3"></i></b>create</button>

        </form>
    </div>
</div>

@endsection
