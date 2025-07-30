@extends('layouts.guest')

@section('content')
    <!-- guesthome address -->
    <div class="wed-host-section">
        <div class="wed-host-section-container">
            <div class="wed-host-section-container-form">
                <div class="wed-host-section-container-title">{{$user->name}}{{ __(' Home Address') }}</div>
                    <form method="POST" action="{{route('guesthome.update',[$user, $user->home] )}}">
                        @csrf
                        @method('PATCH')
                        @include('partials._home', ['home' => $home, 'wedform' => ''])
                        <div class="form-group d-flex justify-content-around my-3">
                            <button type="submit" class="btn btn-sm wed-btn-main">
                                <span class="material-icons">save</span>
                            </button>
                            <span>
                                <a href="{{route('guestoffice.create', $user)}}" class="btn btn-sm wed-btn-main"><span class="material-icons">skip_next</span>
                                </a>
                            </span>
                        </div>
                    </form>
            </div>
        </div>
    </div>

@endsection
