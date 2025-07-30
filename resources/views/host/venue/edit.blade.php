@extends('layouts.host')

@section('content')

<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h1 animate__animated animate__bounce animate__delay-2s animate__repeat-2">{{$venue->name}} <a href="{{route('hostvenues.index')}}" class="btn btn-sm wed-btn-main"><span class="text-danger">skip</span></a></div>
        <div class="wed-host-section-container-form venue-box guest-form">
            <form method="POST" action="{{route('hostvenues.update', $venue)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('partials._venue', ['venue' => $venue, 'locations' => $locations, 'categories' => $categories])

            </form>
        </div>
    </div>
</div>

@endsection
