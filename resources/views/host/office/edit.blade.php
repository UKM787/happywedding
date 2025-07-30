@extends('layouts.host')

@section('content')

<!-- guestoffice address -->
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-form">
            <div class="wed-host-section-container-title">{{$host->name}}{{ __(' Office Address') }}</div>
            <form method="POST" action="{{route('hostoffice.update', $office )}}">
                @csrf
                @method('PATCH')
                <input hidden type="text" name="tab" value="office">
                @include('partials._office', [ 'wedform' => ''])

                <div class="form-group d-flex justify-content-around my-3">
                    <button type="submit" class="btn btn-sm wed-btn-main">
                        <span class="material-icons">save</span>
                    </button>
                    <span>
                        <a href="{{route('hostwelcome', $host)}}" class="btn btn-sm wed-btn-main"><span class="material-icons">skip_next</span>
                        </a>
                    </span>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
