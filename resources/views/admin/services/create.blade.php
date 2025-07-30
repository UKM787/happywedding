@extends('layouts.admin')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <p><a href="{{route('adminservice.index')}}" class="btn wed-btn-main">back</a></p>
        <div class="wed-host-section-container-title h2">         
            Add a New Service
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('adminservice.store')}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf

                @include('admin.partials._service')

            </form>
        </div>
    </div>
</div>
@endsection