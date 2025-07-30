@extends('layouts.guest')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-form">
            <div class="wed-host-section-container-title"><i class="far fa-id-card"></i> {{$profile->name}} {{ __(' Profile') }}</div>
            <form method="POST" action="{{route('guestprofile.update', [$user, $user->profile] )}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('partials._profile', ['wedform' => '', 'route' => $route])

                <div class="form-group d-flex justify-content-around my-3">
                    <button type="submit" class="btn btn-sm wed-btn-main">
                        <span class="material-icons">save</span>
                    </button>
                    <span>
                        <a href="{{route('guesthome.create', $user)}}" class="btn btn-sm wed-btn-main"><span class="material-icons">skip_next</span>
                        </a>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
