@extends('Dashboard.layouts.master')

@section('title')
    {{__('main.edit')}} {{__('main.information')}}
@endsection

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"> {{__('main.edit')}} {{__('main.information')}} {{$user->name}}</h5>
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


        {{ html()->modelForm($user, 'PUT', route('user.update', $user->id))->open() }}

            @include('Dashboard.User.form')

        {{html()->submit($text = __('main.save'))->class('btn bg-teal-300 btn-labeled btn-labeled-right')}}

        {{ html()->closeModelForm() }}

    </div>
</div>

@endsection
