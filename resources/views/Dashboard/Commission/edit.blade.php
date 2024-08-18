@extends('Dashboard.Layouts.master')

@section('title')
Edite {{__('payment')}}
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
        <Form action="{{route('payment.update',$payment->id)}}" class="form-validate-jquery" method="post" enctype="multipart/form-data">
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
                    <input type="text" name="amount" value="{{$payment->amount}}" class="form-control" placeholder="inter amount">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-lg-3">{{__('main.restaurant')}}<span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select name="restaurant_id"class="form-control">
                        @foreach($restaurants as $restaurant)
                            <option value="{{$restaurant->id}}" {{ $payment->restaurant_id == $restaurant->id ? 'selected' : '' }}>{{$restaurant->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

                <button type="submit" class="btn bg-teal-300 btn-labeled btn-labeled-right"> update</button>
        </Form>
    </div>
</div>

@endsection
