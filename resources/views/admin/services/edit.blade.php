@extends('layouts.admin')

@section('content')

<div class="wed-host-section">
    <div class="wed-host-section-container">
        <p><a href="{{route('adminservice.index')}}" class="btn wed-btn-main">back</a></p>
        <div class="wed-host-section-container-title h2">
            {{$service ? 'Edit '.$service->name : 'Add New Service' ;}}
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('adminservice.update', [ $service])}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('admin.partials._service', ['service' => $service, 'services' => $services])
            </form>
        </div>
    </div>
</div>


@endsection