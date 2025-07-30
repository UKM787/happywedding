@extends('layouts.guest')

@section('content')

<ul class="nav nav-tabs" id="myTab" role="tablist" style="background: rgba(255, 255, 255, 0.8); border-radius: 20.3324px; margin: 30px 0 60px; padding: 4px 0; border-bottom:none; display:flex; justify-content: center">
    <!-- #mytab starts -->
    <li class="nav-item pr-5" role="presentation">
        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true"><i class="far fa-id-card"></i> Profile</button>
    </li>
    <li class="nav-item px-5" role="presentation">
        <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="false"><i class="fas fa-address-card"></i> HomeAddress</button>
    </li>
    <li class="nav-item px-5" role="presentation">
        <button class="nav-link" id="office-tab" data-bs-toggle="tab" data-bs-target="#office" type="button" role="tab" aria-controls="office" aria-selected="false"><i class="far fa-address-card"></i> OfficeAddress</button>
    </li>
    <li class="nav-item px-5" role="presentation">
        <button class="nav-link" id="family-tab" data-bs-toggle="tab" data-bs-target="#family" type="button" role="tab" aria-controls="family" aria-selected="false"><i class="fas fa-users"></i> FamilyMembers</button>
    </li>
    <!--#myTab ends -->
</ul>

<div class="tab-content" id="myTabContent">
    <!--#profile starts  -->
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @if($user->profile != null)
        <div class="row invitation-form">
            <div class="col-md-12">
                <div class="guest-form">
                    <div class="card-header wed-form-title text-center h4"><a href="{{route('guestprofile.edit',[$user, $user->profile])}} " class="btn btn-sm btn-info mr-2 bg-nav p-2">{{$profile->name}} Profile <i class="material-icons" title="Edit Article">edit</i></a> <a href="{{route('guestprofile.create', $user)}}" class="btn btn-sm"><span class="px-3 text-danger">skip</span></a></div>
                    <div class="card-body">
                        <form method="POST" action="{{route('guestprofile.update', [$user, $user->profile] )}}" enctype="multipart/form-data">
                            @csrf
                            @include('guest.partials._profile', ['submitBtn' => '', 'wedform' => 'disabled'])
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

        @if($user->home !== null)
        <h1>Create Home address</h1>
        @else
        <div class="row invitation-form">
            <div class="col-md-12">
                <div class="guest-form">
                    <div class="card-header wed-form-title text-center h4">{{ __(' HomeAddress') }} <a href="{{route('guestoffice.create', $user)}}" class="btn btn-sm"><span class="px-3 text-danger">skip</span></a></div>
                    <div class="card-body">
                        <form method="POST" action="{{route('guesthome.store', $user)}}" enctype="multipart/form-data">
                            @csrf
                            @include('guest.partials._home', ['submitBtn' => 'Create', 'wedform' => ''])
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
        @if($user->office !== null)
        <h1>Create Office Address</h1>
        @else
        <div class="row invitation-form">
            <div class="col-md-12">
                <div class="guest-form">
                    <div class="card-header wed-form-title text-center h4">{{ __(' OfficeAddress') }} <a href="{{route('guestfamily.create', $user)}}" class="btn btn-sm"><span class="px-3 text-danger">skip</span></a></div>
                    <div class="card-body">
                        <form method="POST" action="{{route('guestoffice.store', $user)}}" enctype="multipart/form-data">
                            @csrf
                            @include('guest.partials._office', ['submitBtn' => 'Create', 'wedform' => ''])
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!--#office ends  -->
    <!-- #family starts -->
    <div class="tab-pane fade" id="family" role="tabpanel" aria-labelledby="family-tab">

        @if($user->family != null)
        <div class="row justify-center">
            <div class="col-md-12">
                <table class="table table-sm no-border custom_table dataTable no-footer dtr-inline">

                    <thead style="background-color: purple; color: white; font-size: 20px;">
                        <th class="text-left">Relation</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Age</th>
                        <th class="text-left">Gender</th>
                        <th class="text-left">Mobile</th>
                        <th class="text-left">Identification</th>
                        <th class="text-left">Add Photo</th>
                        </tr>
                    </thead>
                    <tbody>

                        <div style="border-radius: 50px;">
                            <tr>
                                <td class="text-left bg-info">{{$user->profile->relation}}</td>
                                <td class="text-left">{{$user->profile->name}}</td>
                                <td class="text-left">{{$user->profile->age}}</td>
                                <td class="text-left">{{$user->profile->gender}}</td>
                                <td class=" text-left">{{$user->profile->mobile1}}</td>


                            </tr>
                            @foreach($user->family as $member)
                            <tr>
                                <td class="text-left align-middle">{{$member->relation}}</td>
                                <td class="text-left align-middle">{{$member->name}}</td>
                                <td class="text-left align-middle">{{$member->age}}</td>
                                <td class="text-left align-middle">{{$member->gender}}</td>
                                <td class="text-left align-middle">{{$member->mobile}}</td>
                                <td class="text-left align-middle"><img src="{{$member->kycImage}}" alt="Kyc Image" style="width:8em; height:8em; border-radius:1em"></td>
                                <td class="text-left align-middle"><img src="{{$member->guestImage}}" alt="Kyc Image" style="width:8em; height:8em; border-radius:1em"></td>
                            </tr>
                            @endforeach
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="row invitation-form">
            <div class="col-md-12">
                <div class="guest-form">
                    <div class="card-header bg-success text-light text-center h4">{{ __(' GuestFamily') }} <a href="{{route('guestfamily.create', $user)}}" class="btn btn-sm"><span class="px-3 text-danger">skip</span></a></div>
                    <div class="card-body">
                        <form method="POST" action="{{route('guestfamily.store', $user)}}" enctype="multipart/form-data">
                            @csrf
                            @include('guest.partials._family')
                            <div class="form-group row mb-3">
                                <div class="col-md-2 offset-md-4">
                                    <button type="submit" class="btn bg-nav text-white p-2">
                                        {{__('Create')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
    <!-- $family ends -->
</div>

@endsection
