@extends('layouts.hostinvitation')

@section('content')

<div class="container mt-5">
    <div class="row invitation-form">
        <div class="col-md-12 mt-3">
            <div class="guest-form">
                <div class="card-header text-center">Website</div>

                <div class="card-body text-center">
                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf

                        <h1>Give me the Design file and html template for website </h1>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
