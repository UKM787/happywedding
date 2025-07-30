@extends('layouts.vendor')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            <p>Company Name: <span class="text-primary">{{$vendor->name}}</span> </p>
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('vendorcategory.update',[ $vendor, $service])}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('vendors.partials._services')

            </form>
        </div>
    </div>
</div>
@endsection
