@extends('layouts.guest')

@section('content')

<!-- guestFamily Members -->
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title">{{ __('Guest Family Members') }}</div>
        <div class="wed-host-section-container-form">
            <form method="POST" action="{{route('guestfamily.update', [$user, $family])}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('partials._family', ['family' => $family])

                <div class="form-group d-flex justify-content-around my-3">
                    <button type="submit" class="btn btn-sm wed-btn-main">
                        <span class="material-icons">save</span>
                    </button>
                    <span>
                        <a href="{{route('guestwelcome.index', $user)}}" class="btn btn-sm wed-btn-main"><span class="material-icons">skip_next</span>
                        </a>
                    </span>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
