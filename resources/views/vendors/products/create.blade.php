@extends('layouts.vendor')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            Add a New Vendor
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('vendorproducts.store', $vendor)}}" class="vendor-form" id="vendor-form" enctype="multipart/form-data">
                @csrf

                @include('vendors.partials._products')

                <div class="form-group">
                    <button type="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
