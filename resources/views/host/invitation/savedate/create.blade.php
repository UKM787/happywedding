@extends('layouts.hostinvitation')
@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h1 animate__animated animate__bounce animate__delay-2s animate__repeat-2">{{ __(' SaveTheDate') }} <a href="{{route('hoststory.create',[$invitation])}}" class="btn btn-sm wed-btn-main ml-3"><i class="material-icons">skip_next</i></a></div>
        <div class="wed-host-section-container-form">
            <form method="POST" action="{{route('hostsavedate.store',[$invitation])}}" enctype="multipart/form-data" name="saveDateForm">
                @include('host.partials._savedate', ['wedform' => ''])
                @csrf
            </form>
        </div>
        <!-- .invitation-form new ends -->
    </div>
    <!-- .wed-host-section-container ends-->
</div>
<!-- .wed-host-section ends-->

@endsection
