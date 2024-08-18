@extends('errors.error')

@section('error')

    <div class="text-center mb-3">
        <h1 class="error-title">403</h1>
        <h5>{{__('main.forbidden')}}</h5>
    </div>

@stop
