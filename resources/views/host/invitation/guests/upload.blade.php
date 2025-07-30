@extends('layouts.hostinvitation')

@section('content')

<div class="row text-center mt-5">
    <!-- <div class="col">
        <a href="{{route('invitedguests.create',[$invitation])}}" class="btn  btn-sm wed-btn-main"><span class="material-icons">
                person_add
            </span>
        </a>
    </div> -->
    <div class="col" style="margin-top: 2px;">
        <a href="{{route('guestupload',[$invitation])}}" class="btn  btn-sm wed-btn-main"><span class="material-icons">
                group_add
            </span></a>
    </div>
    <div class="col" style="margin-top: 2px;">
        <a href="{{route('invitedguests.index',[$invitation])}}" class="btn  btn-sm wed-btn-main">Guests Details</a>
    </div>
    <div class="col" style="margin-top: 2px;">
        <a href="{{route('invitedguestlist',[$invitation])}}" class="btn  btn-sm wed-btn-main">Send Invitations</a>
    </div>
</div>
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            {{$invitation->brideName}} weds {{$invitation->groomName}} <i class="small">guestlist Upload</i>
        </div>
        <!-- topnav guests -->

        <ul class="nav nav-tabs" id="myTab" role="tablist" style="background: rgba(255, 255, 255, 0.8); border-radius: 1em; margin: 2em 0 4em; padding: 4px 0; border-bottom:none; display:flex; justify-content: center">
            <!-- #mytab starts -->
            <li class="nav-item" role="presentation">
                <button class="wed-guest-button active" id="upload-tab" data-bs-toggle="tab" data-bs-target="#upload" type="button" role="tab" aria-controls="upload" aria-selected="true" style="border-radius: 25px; border:0px;  float: left;  font-size: 1.2em;">Import Guests Only</button>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <button class="wed-guest-button" id="guest-tab" data-bs-toggle="tab" data-bs-target="#guest" type="button" role="tab" aria-controls="guest" aria-selected="false" style="border-radius: 25px;  background-color: #EA34A2 ; border:0px;  float: left;  font-size: 14px;">+import guestProfile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="wed-guest-button" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="false" style="border-radius: 25px;  background-color: #EA34A2 ; border:0px;  float: left;  font-size: 14px;">+import homeAddress</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="wed-guest-button" id="office-tab" data-bs-toggle="tab" data-bs-target="#office" type="button" role="tab" aria-controls="office" aria-selected="false" style="border-radius: 25px;  background-color: #EA34A2 ; border:0px;  float: left;  font-size: 14px;">+import officeAddress</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="wed-guest-button" id="family-tab" data-bs-toggle="tab" data-bs-target="#family" type="button" role="tab" aria-controls="family" aria-selected="false" style="border-radius: 25px;  background-color: #EA34A2 ; border:0px;  float: left;  font-size: 14px;">+import guestFamily</button>
            </li> -->
            <li class="nav-item" role="presentation">
                <button class="wed-guest-button" id="guestall-tab" data-bs-toggle="tab" data-bs-target="#guestall" type="button" role="tab" aria-controls="upload" aria-selected="false" style="border-radius: 25px; border:0px;  float: left;  font-size: 1.2em;">Import Guests with full Details</button>
            </li>
            <!--#myTab ends -->
        </ul>

        <div class="tab-content" id="myTabContent">
            <!--#upload starts  -->
            <div class="tab-pane fade show active" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                <div class="card-body text-center">
                    <form class="form-loader" action="{{ route('invitedguests.store',[$invitation]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="upload-cover mb-3">
                                    <label for="guests" class="btn btn-upload btn-red p-3">
                                        <h6>{{ __('guests') }}<i class="fa fa-upload" aria-hidden="true"></i></h6>
                                        <input hidden type="file" name="guests" id="guests" class="@error('guests') is-invalid @enderror mb-4" accept="*.xls,*.xlsx" aria-label="guests">
                                    </label>
                                    @error('guests')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div id="upload-success">

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm wed-btn-main text-center mt-3">
                                    <span class="material-icons">save</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        {{$error}}
                        @endforeach
                    </div>
                    @endif

                    <hr>
                    <div class="row mt-12 p-3">
                        <div class="col">
                            <a class="wed-guest-button  active" href="{{ route('sampleGuest',[$filename='guest']) }}" style="border-radius: 25px;  border:0px; font-size: 14px; text-decoration: none; ">Download Sample</a>
                        </div>
                        <div class="col">
                            <a class="wed-guest-button  active" href="{{ route('guestexport',[$invitation]) }}" style="border-radius: 25px;  border:0px;  font-size: 14px; text-decoration: none; ">Export Guests</a>
                        </div>
                        <div class="col">
                            <a class="wed-guest-button  active" href="{{ route('familyguestexport1',[$invitation]) }}" style="border-radius: 25px;  border:0px;  font-size: 14px; text-decoration: none; ">Export guestFamily</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <!--#upload ends  -->
            <!--#guest starts  -->
            <!-- <div class="tab-pane fade" id="guest" role="tabpanel" aria-labelledby="guest-tab">
                <div class="card-body text-center">
                    <form class="form-loader" action="{{ route('guestprofiles',[$invitation]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <a class="wed-guest-button  active" href="{{ route('sampleXls','guestProfile') }}" style="border-radius: 25px;  border:0px; font-size: 14px; text-decoration: none; ">Sample</a>
                            </div>
                            <div class="col">
                                <a class="wed-guest-button  active" href="{{ route('profileexport',[$invitation]) }}" style="border-radius: 25px;  border:0px;  font-size: 14px; text-decoration: none; ">Export</a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="upload-cover mb-3">
                                <label for="guestprofile" class="btn btn-upload btn-red">{{ __('guestProfiles upload') }}<i class="fa fa-upload" aria-hidden="true"></i>
                                    <input hidden type="file" name="guestprofile" id="guestprofile" class="@error('guestprofile') is-invalid @enderror mb-4" accept="*.xls,*.xlsx" aria-label="guestprofile"></label>
                                @error('guestprofile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror <div id="upload-success">

                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm wed-btn-main ml-4">
                                <span class="material-icons">save</span>
                            </button>
                        </div>
                    </form>
                    @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        {{$error}}
                        @endforeach
                    </div>
                    @endif
                </div>
            </div> -->
            <!--#guest ends  -->
            <!--#home starts  -->
            <!-- <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card-body text-center">
                    <form class="form-loader" action="{{ route('guesthomes',[$invitation]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <a class="wed-guest-button  active" href="{{ route('sampleXls','guestHome') }}" style="border-radius: 25px;  border:0px; font-size: 14px; text-decoration: none; ">Sample</a>
                            </div>
                            <div class="col">
                                <a class="wed-guest-button  active" href="{{ route('guestHomeexport',[$invitation]) }}" style="border-radius: 25px;  border:0px;  font-size: 14px; text-decoration: none; ">Export</a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="upload-cover mb-3">
                                <label for="homeaddress" class="btn btn-upload btn-red">{{ __('homeAddress upload') }}<i class="fa fa-upload" aria-hidden="true"></i>
                                    <input hidden type="file" name="homeaddress" id="homeaddress" class="@error('homeaddress') is-invalid @enderror mb-4" accept="*.xls,*.xlsx" aria-label="homeaddress"></label>
                                @error('homeaddress')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="upload-success"></div>
                            </div>
                            <button type="submit" class="btn btn-sm wed-btn-main ml-4">
                                <span class="material-icons">save</span>
                            </button>
                        </div>
                    </form>
                    @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        {{$error}}
                        @endforeach
                    </div>
                    @endif
                </div>
            </div> -->
            <!--#home ends  -->
            <!--#office starts  -->
            <!-- <div class="tab-pane fade" id="office" role="tabpanel" aria-labelledby="office-tab">
                <div class="card-body text-center">
                    <form class="form-loader" action="{{ route('guestoffices',[$invitation]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <a class="wed-guest-button  active" href="{{ route('sampleXls','guestOffice') }}" style="border-radius: 25px;  border:0px; font-size: 14px; text-decoration: none; ">Sample</a>
                            </div>
                            <div class="col">
                                <a class="wed-guest-button  active" href="{{ route('guestOfficeexport',[$invitation]) }}" style="border-radius: 25px;  border:0px;  font-size: 14px; text-decoration: none; ">Export</a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="upload-cover mb-3">
                                <label for="officeaddress" class="btn btn-upload btn-red">{{ __('officeAddress upload') }}<i class="fa fa-upload" aria-hidden="true"></i>
                                    <input hidden type="file" name="officeaddress" id="officeaddress" class="@error('officeaddress') is-invalid @enderror mb-4" accept="*.xls,*.xlsx" aria-label="officeaddress"></label>
                                @error('officeaddress')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <div class="upload-success"></div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm wed-btn-main ml-4">
                                <span class="material-icons">save</span>
                            </button>
                        </div>
                    </form>
                    @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        {{$error}}
                        @endforeach
                    </div>
                    @endif
                </div>
            </div> -->
            <!--#office ends  -->
            <!--#family starts  -->
            <!-- <div class="tab-pane fade" id="family" role="tabpanel" aria-labelledby="family-tab">
                <div class="card-body text-center">
                    <form class="form-loader" action="{{ route('guestfamily',[$invitation]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <a class="wed-guest-button  active" href="{{ route('sampleXls','guestFamily') }}" style="border-radius: 25px;  border:0px; font-size: 14px; text-decoration: none; ">Sample</a>
                            </div>
                            <div class="col">
                                <a class="wed-guest-button  active" href="{{ route('guestFamilyexport',[$invitation]) }}" style="border-radius: 25px;  border:0px;  font-size: 14px; text-decoration: none; ">Export</a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="upload-cover mb-3">
                                <label for="familyupload" class="btn btn-upload btn-red">{{ __('family upload') }}<i class="fa fa-upload" aria-hidden="true"></i>
                                    <input hidden type="file" name="familyupload" id="familyupload" class="@error('familyupload') is-invalid @enderror mb-4" accept="*.xls,*.xlsx" aria-label="familyupload"></label>
                                @error('familyupload')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="upload-success"></div>
                            </div>
                            <button type="submit" class="btn btn-sm wed-btn-main ml-4">
                                <span class="material-icons">save</span>
                            </button>
                        </div>
                    </form>
                    @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        {{$error}}
                        @endforeach
                    </div>
                    @endif
                </div>
            </div> -->
            <!--#family ends  -->
            <!--#all starts  --> --}}
            <div class="tab-pane fade" id="guestall" role="tabpanel" aria-labelledby="guestall-tab">
                <div class="card-body text-center">
                    <form class="form-loader" action="{{ route('guestall',[$host,$invitation]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col">
                            <div class="upload-cover mb-3">
                                <label for="guestAll" class="btn btn-upload btn-red p-3">
                                    <h6>{{ __('guestDetails') }}<i class="fa fa-upload" aria-hidden="true"></i></h6>
                                    <input hidden type="file" name="guestAll" id="guestAll" class="@error('guestAll') is-invalid @enderror mb-4" accept="*.xls,*.xlsx" aria-label="guestAll">
                                </label>
                                @error('guestAll')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm wed-btn-main ml-4 mt-4">
                                <span class="material-icons">save</span>
                            </button>
                        </div>
                    </form>
                    @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        {{$error}}
                        @endforeach
                    </div>
                    @endif

                    <hr>
                    <div class="row mt-12 p-3">
                        <div class="col">
                            <a class="wed-guest-button  active" href="{{ route('sampleGuest',[$filename='guestall']) }}" style="border-radius: 25px;  border:0px; font-size: 14px; text-decoration: none; ">Download Sample</a>
                        </div>
                        <div class="col">
                            <a class="wed-guest-button  active" href="{{ route('allguestexport',[$invitation]) }}" style="border-radius: 25px;  border:0px;  font-size: 14px; text-decoration: none; ">Export guestDetails</a>
                        </div>
                        <div class="col">
                            <a class="wed-guest-button  active" href="{{ route('familyguestexport1',[$invitation]) }}" style="border-radius: 25px;  border:0px;  font-size: 14px; text-decoration: none; ">Export guestFamily</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--#all ends  -->

        </div>
        <!-- .tab-content ends -->

        {{-- @if(Session::has('errorStatus'))
            @foreach(Session::get('errorStatus') as $error)
                @if(isset($error->values()[$error->attribute()]))
                    @if($loop->last)
                        <!-- <div class="guest-upload-err-table">
                            <h1>Rows with Errors</h1>
                            <table>
                                <tr>
                                    <th>Row</th>
                                    <th>Field</th>
                                    <th>Value</th>
                                    <th>Error</th>
                                </tr>
                                @foreach(Session::get('errorStatus') as $error)

                                    <tr>
                                        <td>{{$error->row()}}</td>
                                        <td>{{$error->attribute()}}</td>
                                        <td>{{$error->values()[$error->attribute()]}}</td>
                                        <td>
                                            <ul style="padding-left: 15px;">
                                                @foreach($error->errors() as $err)
                                                <li>{{$err}}</li>
                                                @endforeach
                                            </ul>

                                        </td>
                                    </tr>
                                @endforeach
                            
                            </table>
                            <h3>Note: The File is not Uploaded as the above mentioned rows have errors.<br>To import the file, correct the errors and import it again!!</h3>
                        </div> -->
                    @endif
                @else
                    <!-- <div>Kindly match you column names with the sample file.</div> -->
                    @break
                @endif
            @endforeach
        @endif --}}

        @if(Session::has('errorStatus'))
        
        <div class="guest-upload-err-table">
                        <h1>Rows with Errors</h1>
                        <table>
                            <tr>
                                <th>Row</th>
                                <th>Field</th>
                                <th>Value</th>
                                <th>Error</th>
                            </tr>
                            @foreach(Session::get('errorStatus') as $error)

                                <tr>
                                    <td>{{$error->row()}}</td>
                                    <td>{{$error->attribute()}}</td>
                                    <td>{{$error->values()[$error->attribute()]}}</td>
                                    <td>
                                        <ul style="padding-left: 15px;">
                                            @foreach($error->errors() as $err)
                                            <li>{{$err}}</li>
                                            @endforeach
                                        </ul>

                                    </td>
                                </tr>
                            @endforeach
                        
                        </table>
                        <h3>Note: The File is not Uploaded as the above mentioned rows have errors.<br>To import the file, correct the errors and import it again!!</h3>
        </div>

        @endif



    </div>
    <!-- .container ends -->
</div>
</div>



@endsection
