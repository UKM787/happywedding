@extends('layouts.vendor')

@section('content')

<vendor-check-profile vendor-id="{{ $vendorID }}"></vendor-check-profile>


{{-- <div class="wed-host-section container m-auto">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            Add a New Vendor
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('vendorprofile.store', $vendor)}}" class="vendor-form" id="vendor-form" enctype="multipart/form-data">
                @csrf

                @include('vendors.partials._profile', ['wedform' => '', 'profile' =>$profile, 'vendorcats' => $vendorcats, 'locations' => $locations])

            </form>
        </div>
    </div>
</div> --}}
@endsection
