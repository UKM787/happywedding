@extends('layouts.vendor')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
           Edit Accommodation
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('vendoraccommodation.update', [$vendor,$accommodation])}}" class="accommodation-form" id="accommodation-form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('partials._accommodation', ['accommodation' => $accommodation, 'locations' => $locations, 'categories' = > $categories])

            </form>
        </div>
    </div>
</div>
@endsection
