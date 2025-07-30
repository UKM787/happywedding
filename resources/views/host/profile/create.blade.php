@extends('layouts.host')

@section('content')

<div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist" style="background: rgba(255, 255, 255, 0.8); border-radius: 20.3324px; margin: 30px 0 60px; padding: 4px 0; border-bottom:none; display:flex; justify-content: center">
        <!-- #mytab starts -->
        <li class="nav-item pr-5" role="presentation">
            <button class="nav-link {{session()->get('tab') == 'profile'  ? 'active' : '' }}" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true"><i class="far fa-id-card"></i> Profile</button>
        </li>
        <li class="nav-item px-5" role="presentation">
            <button class="nav-link {{session()->get('tab') == 'home'  ? 'active' : '' }}" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="false"><i class="fas fa-address-card"></i> HomeAddress</button>
        </li>
        <li class="nav-item px-5" role="presentation">
            <button class="nav-link {{session()->get('tab') == 'office'  ? 'active' : '' }}" id="office-tab" data-bs-toggle="tab" data-bs-target="#office" type="button" role="tab" aria-controls="office" aria-selected="false"><i class="far fa-address-card"></i> OfficeAddress</button>
        </li>
        <!--#myTab ends -->
    </ul>

    <div class="tab-content" id="myTabContent">
        <!--#profile starts  -->
        <div class="tab-pane fade {{session()->get('tab') == 'profile'  ? 'active show' : '' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @if($host->profile == null)
            <div class="wed-host-section">
                <div class="wed-host-section-container">
                    <div class="wed-host-section-container-form">
                        <div class="wed-host-section-container-title">{{ __(' Profile') }} </div>
                        <form method="POST" action="{{route('hostprofile.store', [$host, $profile])}}" enctype="multipart/form-data">
                            @csrf
                            <input hidden type="text" name="tab" value="profile">
                            @include('partials._profile', [ 'profile' => $host, 'wedform' => ''])

                            <div class="form-group d-flex justify-content-around my-3">
                                <button type="submit" class="btn btn-sm wed-btn-main">
                                    <span class="material-icons">save</span>
                                </button>
                                <span>
                                    <a href="{{route('hosthome.create', $host)}}" class="btn btn-sm wed-btn-main"><span class="material-icons">skip_next</span>
                                    </a>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="wed-host-section">
                <div class="wed-host-section-container">
                    <div class="wed-host-section-container-form">
                        <div class="wed-host-section-container-title"><a href="{{route('hostprofile.edit',[$host, $profile])}}">{{$profile->name}} Profile <i class="material-icons" title="Edit Profile">edit</i></a> </div>
                        <form method="POST" action="{{route('hostprofile.edit', [$host, $profile])}}" enctype="multipart/form-data">
                            @csrf
                            @include('partials._profile', [ 'profile' => $host->profile, 'wedform' => ''])

                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!--#profile ends  -->
        <!--#home starts  -->
        <div class="tab-pane fade {{session()->get('tab') == 'home'  ? 'active show' : '' }}" id="home" role="tabpanel" aria-labelledby="home-tab">
            @if($host->home == null)
            <div class="wed-host-section">
                <div class="wed-host-section-container">
                    <div class="wed-host-section-container-title">{{ __(' HomeAddress') }} </div>
                    <div class="wed-host-section-container-form">
                        <form method="POST" action="{{route('hosthome.store', $host)}}" enctype="multipart/form-data">
                            @csrf
                            <input hidden type="text" name="tab" value="home">
                            @include('partials._home', [ 'wedform' => ''])
                            <div class="form-group d-flex justify-content-around my-3">
                                <button type="submit" class="btn btn-sm wed-btn-main">
                                    <span class="material-icons">save</span>
                                </button>
                                <span>
                                    <a href="{{route('hostoffice.create', $host)}}" class="btn btn-sm wed-btn-main"><span class="material-icons">skip_next</span>
                                    </a>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="wed-host-section">
                <div class="wed-host-section-container">
                    <div class="wed-host-section-container-title"><a href="{{route('hosthome.edit',[$host, $host->home])}}">{{$profile->name}} Home <i class="material-icons" title="Edit Profile">edit</i></a> </div>
                    <div class="wed-host-section-container-form">
                        <form method="POST" action="{{route('hosthome.update', [$host, $host->home])}}" enctype="multipart/form-data">
                            @csrf
                            @include('partials._home', ['home' => $host->home, 'wedform' => ''])
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!--#home ends  -->
        <!--#office starts  -->
        <div class="tab-pane fade {{session()->get('tab') == 'office'  ? 'active show' : '' }}" id="office" role="tabpanel" aria-labelledby="office-tab">
            @if($host->office == null)
            <div class="wed-host-section">
                <div class="wed-host-section-container">
                    <div class="wed-host-section-container-title">{{ __(' OfficeAddress') }} </div>
                    <div class="wed-host-section-container-form">
                        <form method="POST" action="{{route('hostoffice.store', $host)}}" enctype="multipart/form-data">
                            @csrf
                            <input hidden type="text" name="tab" value="office">
                            @include('partials._office', [ 'wedform' => ''])

                            <div class="form-group d-flex justify-content-around my-3">
                                <button type="submit" class="btn btn-sm wed-btn-main">
                                    <span class="material-icons">save</span>
                                </button>
                                <span>
                                    <a href="{{route('hostwelcome', $host)}}" class="btn btn-sm wed-btn-main"><span class="material-icons">skip_next</span>
                                    </a>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="wed-host-section">
                <div class="wed-host-section-container">
                    <div class="wed-host-section-container-title"> <a href="{{route('hostoffice.edit',[$host, $host->office])}}">{{$profile->name}} Office <i class="material-icons" title="Edit Profile">edit</i></a></div>
                    <div class="wed-host-section-container-form">
                        <form method="POST" action="{{route('hostoffice.store', $host)}}" enctype="multipart/form-data">
                            @csrf
                            <input hidden type="text" name="tab" value="office">
                            @include('partials._office', [ 'office' => $host->office, 'wedform' => ''])

                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!--#office ends  -->
    </div>
    <!-- .tab-content ends -->
</div>
<!-- .container ends -->
@endsection
