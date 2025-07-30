@extends('layouts.vendor')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            <p class="text-primary">@if(isset($vendor->profile)){{$vendor->profile->companyname}} @else {{$vendor->name}}@endif</p>
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('vendorcategory.store', $vendor)}}" class="vendor-form" id="vendor-form" enctype="multipart/form-data">
                @csrf

                @include('vendors.partials._services', ['vendor' => $vendor, 'cats' => $cats])

                <div class="form-group">
                    <button type="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
