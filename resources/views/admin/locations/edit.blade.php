@extends('layouts.admin')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <p><a href="{{route('adminlocation.index')}}" class="btn wed-btn-main">back</a></p>
        <div class="wed-host-section-container-title h2">
            {{$location ? 'Edit '.$location->city : 'Add New Location' ;}}
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('adminlocation.update', [$location])}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('admin.partials._location', ['location' => $location, 'locations' => $locations])
            </form>
        </div>
    </div>
</div>


@endsection