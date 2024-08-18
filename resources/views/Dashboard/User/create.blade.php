@extends('Dashboard.layouts.master')

@section('title')
    {{__('main.add')}} {{__('main.employee')}}
@endsection

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{__('main.add')}} {{__('main.employee')}}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <p class="mb-4"> <strong></strong> </p>

        {{ html()->form('POST', route('user.store'))->open() }}

        @include('Dashboard.User.form')

            <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b>
                    <i class="icon-plus3"></i></b> {{__('main.add')}} {{__('main.employee')}}</button>
        {{ html()->form()->close() }}
    </div>
</div>





@endsection
