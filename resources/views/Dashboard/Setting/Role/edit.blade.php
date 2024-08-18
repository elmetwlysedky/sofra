@extends('Dashboard.Layouts.master')

@section('title')
    {{__('main.add')}} {{__('main.roles')}}
@endsection

@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{__('main.edit')}} {{$role->name}}</h5>
        </div>

        <div class="card-body">
            <p class="mb-4"></p>
            {{ html()->modelForm($role, 'PUT', route('role.update', $role->id))->open() }}

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
                        @foreach($permissions as $item)
                            <div class="form-check ">

                                {{html()->checkbox('permission_id[]', $role->permissions->contains($item->id)  ,$item->id)}}

                                <label class="form-check-label">
                                    {{$item->name}}
                                    <input type="hidden" name="guard_name" value="web">
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>


            {{html()->submit($text = __('main.save'))->class('btn bg-teal-300 btn-labeled btn-labeled-right')}}

            {{ html()->closeModelForm() }}
        </div>
    </div>
@endsection
