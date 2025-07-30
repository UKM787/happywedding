@extends('layouts.vendor')

@section('content')
    <vendor-check-profile vendor-id="{{ $vendorid }}"></vendor-check-profile>

{{-- <div class="wed-host-section container m-auto">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            Add a New Vendor
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('vendorprofile.update', [$vendor, $profile])}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('vendors.partials._profile', ['wedform' => '', 'profile' =>$profile, 'vendorcats' => $vendorcats, 'locations' => $locations])

            </form>
        </div>
    </div>
</div> --}}
@endsection
