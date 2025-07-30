@extends('layouts.vendor')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            Add a New Vendor
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('weddinganchors.update', [$vendor,$anchor])}}" class="anchor-form" id="anchor-form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('partials._anchors', ['anchor' => $anchor, 'locations' => $locations, 'categories' => $categories])

            </form>
        </div>
    </div>
</div>
@endsection
