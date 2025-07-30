@extends('layouts.guest')

@section('content')

<!-- guestoffice address -->
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-form">
            <div class="wed-host-section-container-title">{{$user->name}}{{ __(' Office Address') }}</div>
                <form method="POST" action="{{route('guestoffice.update',[$user, $user->office] )}}">
                    @csrf
                    @method('PATCH')
                    @include('partials._office', ['office' => $office, 'wedform' => ''])

                    <div class="form-group d-flex justify-content-around my-3">
                        <button type="submit" class="btn btn-sm wed-btn-main">
                            <span class="material-icons">save</span>
                        </button>
                        <span>
                            <a href="{{route('guestfamily.create', $user)}}" class="btn btn-sm wed-btn-main"><span class="material-icons">skip_next</span>
                            </a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
