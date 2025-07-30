@extends('layouts.admin')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <p><a href="{{route('adminvenues.index')}}" class="btn wed-btn-main">back</a></p>
        <div class="wed-host-section-container-title h2">
            Add a New Venue
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('adminvenues.store')}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf

                @include('partials._venue', ['venue' => $venue, 'categories' => $categories, 'locations' => $locations])

            </form>
        </div>
    </div>
</div>
@endsection