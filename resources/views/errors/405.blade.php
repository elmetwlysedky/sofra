@extends('errors.error')

@section('error')

    <div class="text-center mb-3">
        <h1 class="error-title">405</h1>
        <h5>{{__('main.not_allowed')}}</h5>
    </div>

@stop

