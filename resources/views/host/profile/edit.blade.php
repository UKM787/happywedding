@extends('layouts.host')

@section('content')

<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title">{{$profile->name}} {{ __(' Profile') }}</div>
        <div class="wed-host-section-container-form">
            <form method="POST" action="{{route('hostprofile.update',  $profile )}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input hidden type="text" name="tab" value="profile">
                @include('partials._profile', [ 'profile' => $profile, 'wedform' => ''])

                <div class="form-group d-flex justify-content-around my-3">
                    <button type="submit" class="btn btn-sm wed-btn-main">
                        <span class="material-icons">save</span>
                    </button>
                    <span>
                        <a href="{{ route('hostprofile.index') }}" class="btn btn-sm wed-btn-main"><span class="material-icons">skip_next</span>
                        </a>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
