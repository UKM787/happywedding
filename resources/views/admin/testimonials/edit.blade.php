@extends('layouts.admin')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <p> <a href="{{route('admintestimonials.index')}}" class="btn wed-btn-main">back</a></p>
        <div class="wed-host-section-container-title h2">
            {{$testimonial ? 'Edit '.$testimonial->name : 'Add New Vendor' ;}}
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('admintestimonials.update', $testimonial )}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('admin.partials._testimonial', ['submitBtn' => 'Update Testimonial' , 'testimonial' => $testimonial, 'tags' => $tags])
            </form>
        </div>
    </div>
</div>


@endsection