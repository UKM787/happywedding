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
                    Add a New accommodation
                </div>
                <div class="wed-host-section-container-form">
                    {!! Form::open(['route'=> ['vendoraccommodation.store', $vendor], 'files' => true , 'class' => 'accommodation-form' , 'id' => 'accommodation-form']) !!}


                    @include('partials._accommodation', ['accommodation' => $accommodation, 'locations' => $locations, 'categories' => $categories])

                    <div class="form-group mt-4 text-center">
                        <button type="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
@endsection
