@extends('layouts.vendor')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            Add a New Vendor (create)
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('admin.vendor.store')}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf

                @include('vendors.partials._vendor')

            </form>
        </div>
    </div>
</div>
@endsection
