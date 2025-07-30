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
            Add a New Veune
        </div>
        <div class="wed-host-section-container-form">
            {!! Form::open(['route'=> ['vendorvenues.store', $vendor], 'files' => true , 'class' => 'hotel-form' , 'id' => 'hotel-form']) !!}


            @include('partials._venue', ['venue' => $venue, 'locations' => $locations, 'categories' => $categories])

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
