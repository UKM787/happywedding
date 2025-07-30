@extends('layouts.host')
@section('styles')
<style>

</style>
@endsection

@section('content')

<!-- .invitation-form new -->
<div class="wed-host-section">
    <div class="wed-host-section-container">
        @if($venues->isNotEmpty())
        <div class="wed-host-section-container-title h1 animate__animated animate__bounce animate__delay-2s animate__repeat-2">{{ __(' Invitation Cover') }}</div>
        <div class="wed-host-section-container-form">
            <form method="POST" action="{{route('hostinvitations.store')}}" enctype="multipart/form-data" name="invitationCoverForm">
                @csrf
                @include('host.partials._cover', ['wedform' => ''])
            </form>
        </div>
        <!-- .invitation-form new ends -->
        @else
        <a href="{{route('hostvenues.create', $host)}}">
            <div class="wed-host-section-container-title h1 animate__animated animate__bounce animate__delay-2s animate__repeat-2 text-center">{{ __(' Create Venue First') }}</div></a>
            @endif
    </div>
    <!-- .wed-host-section-container ends-->
</div>
<!-- .wed-host-section ends-->

@endsection

