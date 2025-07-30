@extends('layouts.admin')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            Add a New Accomodation Location
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('adminaccommodation.store')}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf

                @include('partials._accommodation', ['accommodation' => $accommodation, 'categories' => $categories, 'locations' => $locations])

                <div class="form-group text-center py-2">
                    <button type="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection
