@extends('layouts.vendor')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            Add a New {{ucwords($service)}}
        </div>
        <div class="wed-host-section-container-form">
            {!! Form::open(['route'=> ['vendorwservices.store', $vendor, $service], 'files' => true , 'class' => 'wservices-form' , 'id' => 'accommodation-form']) !!}


            @include('partials._wservices', ['wservice' => $wservice, 'locations' => $locations, 'categories' => $categories, 'service' => $service])

            <div class="form-group mt-4 text-center">
                <button type="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
