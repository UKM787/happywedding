@extends('layouts.admin')

@section('content')

<div class="wed-host-section">
    <div class="wed-host-section-container">
        <p><a href="{{route('adminlocation.index')}}" class="btn wed-btn-main">back</a></p>
        <div class="wed-host-section-container-title h2">
            Add a New Location
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('adminlocation.store')}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf
                @include('admin.partials._location', ['locations' => $locations, 'location' => $location])

            </form>
        </div>
    </div>
</div>


@endsection