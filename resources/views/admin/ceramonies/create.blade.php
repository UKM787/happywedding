@extends('layouts.admin')

@section('styles')
<style>
    .container {
        max-width: 500px;
    }

    dl,
    ol,
    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .imgPreview img {
        padding: 8px;
        max-width: 100px;
    }
</style>
@endsection

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <p><a href="{{route('adminceramony.index')}}" class="btn wed-btn-main">back</a></p>
        <div class="wed-host-section-container-title h2">
            Add a New Ceramony
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('adminceramony.store')}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                    Upload Images
                </button> -->

                @include('admin.partials._ceramony', ['ceramony' => $ceramony])

            </form>
        </div>
    </div>
</div>
@endsection
