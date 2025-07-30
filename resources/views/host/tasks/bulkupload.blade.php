@extends('layouts.host')

@section('content')
<!-- upload memberslists -->

<div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist" style="background: rgba(255, 255, 255, 0.8); border-radius: 1em; margin: 2em 0 4em; padding: 4px 0; border-bottom:none; display:flex; justify-content: center">
        <!-- #mytab starts -->
        <li class="nav-item" role="presentation">
            <button class="wed-guest-button active" id="upload-tab" data-bs-toggle="tab" data-bs-target="#upload" type="button" role="tab" aria-controls="upload" aria-selected="true">+ taskList - Host</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="wed-guest-button" id="guest-tab" data-bs-toggle="tab" data-bs-target="#guest" type="button" role="tab" aria-controls="guest" aria-selected="false" style="border-radius: 25px;  background-color: #EA34A2 ; border:0px;  float: left;  font-size: 14px;">+ tasklist - Members</button>
        </li>
        <!--#myTab ends -->
    </ul>

    <div class="tab-content" id="myTabContent">
        <!--#upload starts  -->
        <div class="tab-pane fade show active" id="upload" role="tabpanel" aria-labelledby="upload-tab">
            <div class="container">
                <div class="card bg-light mt-3">
                    <div class="card-header h2 text-center text-danger">
                        taskList - Host
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-2">
                                <div class="upload-cover mb-3">
                                    <label for="guests" class="btn btn-upload btn-red">{{ __('taskList upload') }}<i class="fa fa-upload" aria-hidden="true"></i>
                                        <input hidden type="file" name="guests" id="guests" class="@error('guests') is-invalid @enderror mb-4" accept="*.xls,*.xlsx" aria-label="guests"></label>
                                    @error('guests')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
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
                </div>
            </div>
        </div>
        <!--#upload ends  -->
        <!--#guest starts  -->
        <div class="tab-pane fade" id="guest" role="tabpanel" aria-labelledby="guest-tab">
            <div class="container">
                <div class="card bg-light mt-3">
                    <div class="card-header h2 text-center text-danger">
                        taskList - Members
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" class="form-control">
                            <br>
                            <button class="btn btn-success">Members taskList Import</button>
                        </form>
                        @if(isset($errors) && $errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                            {{$error}}
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--#guest ends  -->

        <!--#memberTasks starts  -->
        <div class="tab-pane fade" id="ceramony" role="tabpanel" aria-labelledby="ceramony-tab">
            <div class="container">
                <div class="card bg-light mt-3">
                    <div class="card-header h2 text-center">
                        Upload Guests Invited Ceramonies
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" class="form-control">
                            <br>
                            <button class="btn btn-success">Import</button>
                        </form>
                        @if(isset($errors) && $errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                            {{$error}}
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--#memberTasks ends  -->

    </div>
    <!-- .tab-content ends -->
</div>
<!-- .container ends -->



@endsection
