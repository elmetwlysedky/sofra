
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



    <!-- Basic text input -->
    <div class="form-group row">
        <label class="col-form-label col-lg-3">{{__('main.name')}} <span class="text-danger">*</span></label>
        <div class="col-lg-9">
            {{ html()->text('name')->class('form-control') }}
        </div>
    </div>
    <!-- /basic text input -->


    <!-- Email field -->
    <div class="form-group row">
        <label class="col-form-label col-lg-3">{{__('main.email')}} <span class="text-danger">*</span></label>
        <div class="col-lg-9">
            {{ html()->email('email',)->class('form-control') }}
        </div>
    </div>
    <!-- /email field -->

    <!-- Password field -->
    <div class="form-group row">
        <label class="col-form-label col-lg-3">{{__('main.password')}}  <span class="text-danger">*</span></label>
        <div class="col-lg-9">

{{--            {!!Form::password('password',['class'=>'form-control'])!!}--}}
            {{ html()->password('password')->class('form-control') }}

        </div>
    </div>
    <!-- /password field -->

    <!-- Repeat password -->
    <div class="form-group row">
        <label class="col-form-label col-lg-3">{{__('main.confirm')}} <span class="text-danger">*</span></label>
        <div class="col-lg-9">

            {{ html()->password('password_confirmation')->class('form-control') }}

{{--            {!!Form::password('password_confirmation',['class'=>'form-control'])!!}--}}

        </div>
    </div>


</fieldset>

