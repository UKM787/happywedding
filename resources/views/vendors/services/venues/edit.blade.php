@extends('layouts.vendor')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            Add a New Vendor
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('vendorcategory.update', $vendor)}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('partials._venues', ['venue' => $venue, 'locations' => $locations, 'categories' => $categories]))

            </form>
        </div>
    </div>
</div>
@endsection
