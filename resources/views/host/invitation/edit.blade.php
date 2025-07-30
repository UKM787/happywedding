@extends('layouts.host')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h1 animate__animated animate__bounce animate__delay-2s animate__repeat-2">{{ __(' Invitation Cover') }} <a href="{{route('hostsavedate.create',[$invitation])}}" class="btn btn-sm wed-btn-main ml-3"><i class="material-icons">skip_next</i></a></div>

        <div class="wed-host-section-container-form">
            <form method="POST" action="{{route('hostinvitations.update', [$invitation])}}" enctype="multipart/form-data" name="invitationCoverForm">
                @csrf
                @method('PATCH')
                @include('host.partials._cover', ['wedform' => ''])

            </form>
            
            <!-- <div id="app">
                <invitation-edit :host-id="{{$host->id}}" :invitation="{{$invitation}}"></invitation-edit>
            </div> -->
        </div>

    </div>
    <!-- .wed-host-section-container ends-->
</div>
<!-- .wed-host-section end-->
@endsection

