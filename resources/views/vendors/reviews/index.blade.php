@extends('layouts.vendor')

@section('content')
<div class="wed-host-section container m-auto">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            {{$vendor->name}} Business Reviews
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('vendorcategory.store', $vendor)}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf


                @include('vendors.partials._reviews')

                <div class="form-group mt-4 text-center">
                    <button type="submit" class="btn btn-sm wed-btn-main"> <span class="material-icons">save</span></button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
