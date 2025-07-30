@extends('layouts.admin')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <p><a href="{{route('adminceramony.index')}}" class="btn wed-btn-main">back</a></p>
        <div class="wed-host-section-container-title h2">
            {{$ceramony ? 'Edit '.$ceramony->name : 'Add New Ceramony' ;}}
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('adminceramony.update', $ceramony)}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('admin.partials._ceramony', ['ceramony' => $ceramony])
            </form>
        </div>
    </div>
</div>
@endsection

