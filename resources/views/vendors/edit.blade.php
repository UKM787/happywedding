@extends('layouts.vendor')

@section('content')

<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            {{$vendor ? 'Edit '.$vendor->name : 'Add New Vendor' ;}}
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('admin.vendor.update', [ $vendor])}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('vendors.partials._vendor', ['vendor' => $vendor, 'vendorcats' => $vendorcats])
            </form>
        </div>
    </div>
</div>


@endsection
