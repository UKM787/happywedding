@extends('layouts.host')

@section('content')

<section class="wed-host-section">
        <div class="wed-host-section-container">
            <div class="wed-host-section-container-title h2">
                Add a New Hotel
            </div>
            <div class="wed-host-section-container-form">
                {!! Form::open(['route'=> ['hostaccommodation.store'], 'files' => true , 'class' => 'accommodation-form' , 'id' => 'accommodation-form']) !!}


                @include('host.partials._accommodation', ['accommodation' => $accommodation, 'locations' => $locations, 'categories' => $categories, 'host' => $host])

                <div class="form-group mt-4 text-center">
                    <button type="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>

</section>

@endsection
