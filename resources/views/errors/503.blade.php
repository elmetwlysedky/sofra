@extends('errors.error')

@section('error')

    <div class="text-center mb-3">
        <h1 class="error-title">503</h1>
        <h5>{{__('main.service_unavailable')}}</h5>
    </div>
@stop


