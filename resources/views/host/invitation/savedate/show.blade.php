@extends('layouts.hostinvitation')

@section('content')

<div class="row invitation-form">
    <div class="col-md-12">
        <div class="guest-form">
            <div class="card-header text-center">{{ __(' SaveTheDate') }} <a href="{{route('hostsavedate.edit',[$invitation, $savedate])}}"><i class="material-icons" title="Edit Invitation">edit</i></a></div>

            <div class="card-body">

                <form method="POST" action="{{route('hostsavedate.edit',[$invitation, $savedate])}}" enctype="multipart/form-data" name="saveDateForm">

                    @include('host.partials._savedate', ['submitBtn' => 'Update', 'wedform' => 'disabled', 'savedate' => $savedate])
                    @csrf
                    @method('PATCH')

                </form>

            </div>
            <!-- .card-header ends -->
        </div>
        <!-- .card ends -->
    </div>
    <!-- .col-md-12 ends -->
</div>
<!-- .invitation-form ends -->

@endsection
