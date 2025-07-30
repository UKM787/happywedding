@extends('layouts.vendor')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            Add a New Product
        </div>
        <div class="wed-host-section-container-form">
            {!! Form::open(['route'=> ['vendorproducts.store', $vendor], 'files' => true , 'class' => 'vendor-form' , 'id' => 'vendor-form']) !!}

            @include('vendors.partials._products')
            <div class="form-group mt-4 text-center">
                <button type="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
