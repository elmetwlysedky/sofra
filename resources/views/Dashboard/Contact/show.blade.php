
@extends('Dashboard.layouts.master')

@section('title')
{{$contact->name}}
@endsection

@section('content')


    <!-- Post -->
    <div class="card text-center">
        <div class="card-body">
            <div class="mb-4">
                <div class="mb-3 text-center">
                    <a href="#" class="d-inline-block">
                        <img src="/storage/" class="img-fluid" alt="" style="height: 300px;">
                    </a>
                </div>

                <h4 class="font-weight-semibold mb-1">
                    <p >{{$contact->name}}</p>
                    <h6 class="text-default">    {{$contact->email}}</h6>
                    <h4 class="text-default">    {{$contact->title}}</h4>

                </h4>

            </div>

            <div class="mb-4">

                <h4>{{$contact->message}}</h4>
                <ul class="list-inline list-inline-dotted text-muted mb-3">
                    <li class="list-inline-item">{{$contact->created_at->diffForhumans()}}</li>
                </ul>
            </div>


        </div>
    </div>
    <!-- /post -->


@endsection
