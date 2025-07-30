@extends('layouts.host')

@section('content')

<ul class="nav nav-tabs" id="myTab" role="tablist" style="background: rgba(255, 255, 255, 0.8); border-radius: 20.3324px; margin: 30px 0 60px; padding: 4px 0; border-bottom:none; display:flex; justify-content: center">
    <!-- #mytab starts -->
    <li class="nav-item pr-5" role="presentation">
        <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
    </li>
    <li class="nav-item px-5" role="presentation">
        <a class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="false">HomeAddress</a>
    </li>
    <li class="nav-item px-5" role="presentation">
        <a class="nav-link" id="office-tab" data-bs-toggle="tab" data-bs-target="#office" type="button" role="tab" aria-controls="office" aria-selected="false">OfficeAddress</a>
    </li>
    <!--#myTab ends -->
</ul>

@endsection
