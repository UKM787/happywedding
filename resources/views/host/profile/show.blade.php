@extends('layouts.host')

@section('content')

<ul class="nav nav-tabs" id="myTab" role="tablist" style="background: rgba(255, 255, 255, 0.8); border-radius: 20.3324px; margin: 30px 0 60px; padding: 4px 0; border-bottom:none; display:flex; justify-content: center">
    <!-- #mytab starts -->
    <li class="nav-item pr-5" role="presentation">
        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Profile</button>
    </li>
    <li class="nav-item px-5" role="presentation">
        <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="false">HomeAddress</button>
    </li>
    <li class="nav-item px-5" role="presentation">
        <button class="nav-link" id="office-tab" data-bs-toggle="tab" data-bs-target="#office" type="button" role="tab" aria-controls="office" aria-selected="false">OfficeAddress</button>
    </li>
    <!--#myTab ends -->
</ul>

<div class="tab-content" id="myTabContent">
    <!--#profile starts  -->
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @if($host->profile != null)
        <div class="row invitation-form">
            <div class="col-md-12">
                <div class="guest-form">
                    <div class="card-header text-center">{{$profile->name}} Profile <a href="{{route('hostprofile.edit',[$host, $host->profile])}}"><i class="material-icons text-white" title="Edit Profile">edit</i></a> <a href="{{route('hosthome.create', $host)}}" class="btn btn-sm wed-btn-main"><i class="material-icons">skip_next</i></a></div>
                    <div class="card-body">
                        <form method="POST" action="{{route('hostprofile.update', [$host, $host->profile] )}}" enctype="multipart/form-data">
                            @csrf
                            @include('partials._profile', ['submitBtn' => '', 'wedform' => 'disabled'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!--#profile ends  -->
    <!--#home starts  -->
    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">

        @if($host->home !== null)
        <h1>Create Home address</h1>
        @else
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header wed-form-title text-center h4">{{ __(' HomeAddress') }} <a href="{{route('hostoffice.create', $host)}}" class="btn btn-sm"><span class="px-3 text-danger">skip</span></a></div>
                    <div class="card-body">
                        <form method="POST" action="{{route('hosthome.store', $host)}}" enctype="multipart/form-data">
                            @csrf
                            @include('partials._home', ['submitBtn' => 'Create', 'wedform' => ''])
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!--#home ends  -->
    <!--#office starts  -->
    <div class="tab-pane fade" id="office" role="tabpanel" aria-labelledby="office-tab">
        @if($host->office !== null)
        <h1>Create Office Address</h1>
        @else
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header wed-form-title text-center h4">{{ __(' OfficeAddress') }} <a href="{{route('hostwelcome', $host)}}" class="btn btn-sm"><span class="px-3 text-danger">skip</span></a></div>
                    <div class="card-body">
                        <form method="POST" action="{{route('hostoffice.store', $host)}}" enctype="multipart/form-data">
                            @csrf
                            @include('partials._office', ['submitBtn' => 'Create', 'wedform' => ''])
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!--#office ends  -->
</div>
@endsection
