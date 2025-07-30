@extends('layouts.host')

@section('styles')
<style>
.overlay-form {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow-y: auto;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 999;
}
.task-form-emp {
    width: max-content;
    background-color: #fafafa;
    margin: 12% auto;
    padding: 3em;
    border-radius: 15px;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}
.task-form-emp label {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 17px;
    line-height: 49px;
    color: #000000;
}
</style>
@endsection
@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h1 animate__animated animate__bounce animate__delay-2s animate__repeat-2">{{ __(' Add Venue') }}</div>
        <div class="wed-host-section-container-form venue-box guest-form">
            <form method="POST" action="{{route('hostvenues.store', ['url' => $prevUrl])}}" enctype="multipart/form-data">
                @csrf
                @include('partials._venue', ['vendor' => $vendor, 'venue' => $venue, 'locations' => $locations, 'categories' =>$categories])


            </form>
            
            
            @if(Session::get('show') == true)
            <div class="overlay-form">
                <form method="POST" action="{{route('hostvenues.store')}}" class="task-form-emp">
                    @csrf
                    <div>
                        <p>Have your finished adding venues??</p>
                        <a
                            class="btn btn-primary mb-2 btn-custm"
                            href="{{Session::get('prev')}}"
                            >Yes
                        </a>
                        <button
                        type="submit"
                            class="btn btn-primary mb-2 btn-custm"
                            >No</button
                        > 
                    </div>
                    <input type="hidden" name="old_url" id="icon" class="form-control  @error('icon') is-invalid @enderror" value="{{ Session::get('prev') }}" autocomplete="icon">
                </form>
            </div>
        @endif

        </div>
    </div>
</div>
@endsection

@section('weddingvenuesoverlay')

@endsection
