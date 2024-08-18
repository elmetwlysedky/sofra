@extends('errors.error')

@section('error')

    <div class="text-center mb-3">
        <h1 class="error-title">500</h1>
        <h5>{{__('main.server_error')}}</h5>
    </div>

@stop
