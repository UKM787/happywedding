@extends('layouts.host')

@section('content')
<!-- guesthome address -->

<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title">{{$host->name}}{{ __(' Home Address') }}</div>
        <div class="wed-host-section-container-form">
            <form method="POST" action="{{route('hosthome.update', $home )}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <input hidden type="text" name="tab" value="home">
                @include('partials._home', ['home' => $home, 'wedform' => ''])

                <div class="form-group d-flex justify-content-around my-3">
                    <button type="submit" class="btn btn-sm wed-btn-main">
                        <span class="material-icons">save</span>
                    </button>
                    <span>
                        <a href="{{route('hostoffice.create', $host)}}" class="btn btn-sm wed-btn-main"><span class="material-icons">skip_next</span>
                        </a>
                    </span>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
