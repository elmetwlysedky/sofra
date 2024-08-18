@extends('Dashboard.Layouts.master')

@section('title')
    {{__('main.add')}} {{__('main.roles')}}
@endsection

@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{__('main.add')}} {{__('main.roles')}}</h5>
        </div>

        <div class="card-body">
            <p class="mb-4"></p>

            {{ html()->form('POST', route('role.store'))->class('form-validate-jquery')->open() }}


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold"></legend>



    <div class="form-group row">
        <label class="col-form-label col-lg-3">{{__('main.name')}}<span class="text-danger">*</span></label>
        <div class="col-lg-9">
            {{ html()->text('name')->class('form-control') }}

        </div>
    </div>



    <div class="form-group row">

        <label class="col-lg-3 col-form-label">{{__('main.permissions')}} <span class="text-danger">*</span></label>
        <div class="col-lg-9">
            @foreach($permission as $item)
                <div class="form-check ">
                    {{html()->checkbox('permission_id[]',$checked = false, $value = $item->id)}}

                    <label class="form-check-label">
                        {{$item->name}}

                        <input type="hidden" name="guard_name" value="web">

                    </label>

                </div>

            @endforeach
        </div>
    </div>


            <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-plus3"></i></b>{{__('main.add')}}</button>
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection
