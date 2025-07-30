@extends('layouts.guest')

@section('content')


<guest-profile guest-id="{{ $guestID }}" exists="{{$exists}}" cexists="{{$cexists}}" oexists="{{$oexists}}" allstates="{{$states}}"></guest-profile> 


{{--
    <!-- nav-tabs -->
<ul class="nav nav-tabs" id="tabMenu" role="tablist" style="background: rgba(255, 255, 255, 0.8); border-radius: 20.3324px; margin: 30px 0 60px; padding: 4px 0; border-bottom:none; display:flex; justify-content: center">
    <!-- #mytab starts -->
    <li class="nav-item pr-3" role="presentation">
        <a class="nav-link {{session()->get('tab') == 'profile' ? 'active' : ''}}" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true"><i class="far fa-id-card"></i> Profile</a>
    </li>
    <li class="nav-item pr-3" role="presentation">
        <a class="nav-link {{session()->get('tab') == 'home' ? 'active' : ''}}" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="false"><i class="fas fa-address-card"></i> HomeAddress</a>
    </li>
    <li class="nav-item pr-3" role="presentation">
        <a class="nav-link {{session()->get('tab') == 'office' ? 'active' : ''}}" id="office-tab" data-bs-toggle="tab" data-bs-target="#office" type="button" role="tab" aria-controls="office" aria-selected="false"><i class="far fa-address-card"></i> OfficeAddress</a>
    </li>
    <li class="nav-item pr-3" role="presentation">
        <a class="nav-link {{session()->get('tab') == 'family' ? 'active' : ''}}" id="family-tab" data-bs-toggle="tab" data-bs-target="#family" type="button" role="tab" aria-controls="family" aria-selected="false"><i class="fas fa-users"></i> FamilyMembers</a>
    </li>
    <!--#myTab ends -->
</ul>
<!-- nav-tabs ends -->

<div class="tab-content" id="myTabContent">
    <!--#profile starts  -->
    <div class="tab-pane fade {{ session()->get('tab') == 'profile' ? 'active show' : ''}}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @if($user->profile != null)
        <div class="wed-host-section">
            <div class="wed-host-section-container">
                <div class="wed-host-section-container-form">
                    <div class="wed-host-section-container-title"><a href="{{route('guestprofile.edit',[$user, $profile])}}">{{$user->name}} Profile <i class="material-icons" title="Edit Profile">edit</i></a></div>
                    <div class="card-body">
                        <form method="POST" action="{{route('guestprofile.store', $user)}}" enctype="multipart/form-data">
                            @csrf
                            @include('partials._profile', ['profile' => $profile,'wedform' => 'disabled', 'route' => null])

                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else
        <a href="{{route('guestprofile.create', $user)}}">Add Your Profile</a>
        @endif
    </div>
    <!--#profile ends  -->
    <!--#home starts  -->
    <div class="tab-pane fade {{session()->get('tab') == 'home' ? 'active show' : ''}}" id="home" role="tabpanel" aria-labelledby="home-tab">
        @if(isset($user->home))
        <div class="wed-host-section">
            <div class="wed-host-section-container">
                <div class="wed-host-section-container-form">
                    <div class="wed-host-section-container-title"><a href="{{route('guesthome.edit', [$user, $home])}}">{{$profile->name}} HomeAddress <i class="material-icons" title="Edit HomeAddress">edit</i></a></div>
                    <div class="card-body">
                        <form method="POST" action="{{route('guesthome.update', [$user,$user->home] )}}" enctype="multipart/form-data">
                            @csrf
                            @include('partials._home', ['home' => $home, 'wedform' => 'disabled'])

                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="wed-host-section">
            <div class="wed-host-section-container">
                <div class="wed-host-section-container-form">
                    <div class="wed-host-section-container-title">{{$profile->name}} HomeAddress</div>
                    <form method="POST" action="{{route('guesthome.store', $user)}}" enctype="multipart/form-data">
                        @csrf
                        @include('partials._home', [ 'wedform' => ''])
                        <div class="form-group d-flex justify-content-around my-3">
                            <button type="submit" class="btn btn-sm wed-btn-main">
                                <span class="material-icons">save</span>
                            </button>
                            <span>
                                <a href="{{route('guestoffice.create', $user)}}" class="btn btn-sm wed-btn-main"><span class="material-icons">skip_next</span>
                                </a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!--#home ends  -->
    <!--#office starts  -->
    <div class="tab-pane fade {{session()->get('tab') == 'office' ? 'active show' : ''}}" id="office" role="tabpanel" aria-labelledby="office-tab">
        @if($user->office != null)
        <div class="wed-host-section">
            <div class="wed-host-section-container">
                <div class="wed-host-section-container-form">
                    <div class="wed-host-section-container-title"><a href="{{route('guestoffice.edit', [$user, $office])}}">{{$profile->name}} OfficeAddress <i class="material-icons" title="Edit OfficeAddress">edit</i></a></div>
                    <form method="POST" action="{{route('guestoffice.update', [$user, $user->office] )}}" enctype="multipart/form-data">
                        @csrf
                        @include('partials._office', ['office' => $office, 'wedform' =>'disabled'])
                    </form>
                </div>
            </div>
        </div>
        @else
        <div class="wed-host-section">
            <div class="wed-host-section-container">
                <div class="wed-host-section-container-form">
                    <div class="wed-host-section-container-title">{{$profile->name}} OfficeAddress</div>
                    <form method="POST" action="{{route('guestoffice.store', $user)}}" enctype="multipart/form-data">
                        @csrf
                        @include('partials._office', [ 'wedform' => ''])
                        <div class="form-group d-flex justify-content-around my-3">
                            <button type="submit" class="btn btn-sm wed-btn-main">
                                <span class="material-icons">save</span>
                            </button>
                            <span>
                                <a href="{{route('guestfamily.create', $user)}}" class="btn btn-sm wed-btn-main"><span class="material-icons">skip_next</span>
                                </a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!--#office ends  -->
    <!-- #family starts -->


    <div class="tab-pane fade {{session()->get('tab') == 'family' ? 'active show' : ''}}" id="family" role="tabpanel" aria-labelledby="family-tab">

        @if( isset($user->family) && ($user->family->count() != 0) )
        <div class="wed-host-section">
            <div class="wed-host-section-container">
                <div class="wed-host-section-container-title">
                    <div class="d-flex justify-content-center">
                        <p class=" px-5">Family</p>
                        <p class="px-5"><a href="{{route('guestfamily.create', $user)}}" class="btn btn-sm bg-danger" title="add new Ceramony"><i class="material-icons" title="Add Another Ceramony">add</i>
                            </a></p>
                    </div>
                </div>

                <table class="table table-sm no-border custom_table dataTable no-footer dtr-inline">

                    <thead style="background-color: purple; color: white;">
                        <th class="text-left">Name</th>
                        <th class="text-left">Relation</th>
                        <th class="text-left">Age</th>
                        <th class="text-left">Gender</th>
                        <th class="text-left">Mobile</th>
                        <th class="text-left">Identification</th>
                        <th class="text-left">Add Photo</th>
                        </tr>
                    </thead>
                    <tbody style="border-radius: 4em;">

                        @if(isset($user->profile))
                        <tr>
                            <td class="text-left">{{$user->profile->name}}</td>
                            <td class="text-left">{{$user->profile->relation}}</td>
                            <td class="text-left">{{$user->profile->age}}</td>
                            <td class="text-left">{{$user->profile->gender}}</td>
                            <td class=" text-left">{{$user->profile->mobile1}}</td>
                            <td class=" text-left"></td>
                            <td class=" text-left"><img src="{{asset('storage').'/'.$user->profile->imageOne}}" alt="Guest Image" style="width:4em; height:3em; border-radius:1em"></td>
                        </tr>
                        @endif
                        @foreach($user->family as $member)
                        <tr>
                            <td class="text-left align-middle">{{$member->name}}<a href="{{route('guestfamily.edit',[$user, $member] )}}"><i class="material-icons" title="Edit GuestFamilyMembers">edit</i></a></td>
                            <td class="text-left align-middle">{{$member->relation}}</td>
                            <td class="text-left align-middle">{{$member->age}}</td>
                            <td class="text-left align-middle">{{$member->gender}}</td>
                            <td class="text-left align-middle">{{$member->mobile}}</td>
                            <td class="text-left align-middle"><img src="{{asset('storage').'/'.$member->imageOne}}" alt="Kyc Image" style="width:4em; height:3em; border-radius:1em"></td>
                            <td class="text-left align-middle"><img src="{{asset('storage').'/'.$member->imageTwo}}" alt="Kyc Image" style="width:4em; height:3em; border-radius:1em"></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="wed-host-section">
            <div class="wed-host-section-container">
                <div class="wed-host-section-container-form">
                    <div class="wed-host-section-container-title">{{ __(' GuestFamily') }} </div>
                    <form method="POST" action="{{route('guestfamily.store', $user)}}" enctype="multipart/form-data">
                        @csrf
                        @include('partials._family', [ 'wedform' => ''])
                        <div class="form-group d-flex justify-content-around my-3">
                            <button type="submit" class="btn btn-sm wed-btn-main">
                                <span class="material-icons">save</span>
                            </button>
                            <span>
                                <a href="{{route('guestwelcome.index', $user)}}" class="btn btn-sm wed-btn-main"><span class="material-icons">skip_next</span>
                                </a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

    </div>
    <!-- $family ends -->
</div>
--}}
@endsection

@section('wed-guest-script')
<script>
    $(document).ready(function() {
        // $("#tabs").tabs({ active: {{ $active_tab ?? '0' }} });

        // $(document).ready(function() {
        //     $('a[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
        //         localStorage.setItem('activeTab', $(e.target).attr('data-bs-target'));
        //     });
        //     var activeTab = localStorage.getItem('activeTab');
        //     if (activeTab) {
        //         $('#tabMenu a[href="' + activeTab + '"]').tab('show');
        //     }
        // });

        // $("#tabMenu a").click(function(e) {
        //     e.preventDefault();
        //     $(this).tab("show");
        // });

        //  $("#tabMenu a:last").tab("show");
        // $("#tabMenu li:eq(0) a").tab("show");
        // $('.tab-pane').each(function(tab, index) {
        //     if (index == 0) {
        //         tab.addClass('active');
        //     }
        // });

        // $('#tabMenu a[href="#profile"]').tab("show");
    });
</script>
@endsection
