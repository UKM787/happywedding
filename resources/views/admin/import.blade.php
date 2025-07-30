@extends('layouts.admin')

@section('content')
<div class="text-center">
    @if($type == 'vendors')
    <form action="{{ route('adminimport',['vendors']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label style="padding: 9px !important;" for="excelList" class="btn wed-btn-main">
            <h6><i class="fa fa-upload" aria-hidden="true">Upload ExcelFile</i></h6>
            <input hidden type="file" name="excelList" id="excelList" class="@error('excelList') is-invalid @enderror mb-4" accept="*.xls,*.xlsx">
        </label>
        <!-- <input type="hidden" value='true' name="excel"> -->
        @error('excelList')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div>
            <button type="submit" class="btn wed-btn-main">
                Import
            </button>
        </div>
    </form>
    <a class="btn wed-btn-main" href="{{ route('adminsampleexport',['vendors']) }}">Sample format - VendorCategory</a>
    @else
    <form action="{{ route('adminimport',['tasks']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label style="padding: 9px !important;" for="excelList" class="btn wed-btn-main">
            <h6><i class="fa fa-upload" aria-hidden="true"></i></h6>
            <input hidden type="file" name="excelList" id="excelList" class="@error('excelList') is-invalid @enderror mb-4" accept="*.xls,*.xlsx">
        </label>
        <!-- <input type="hidden" value='true' name="excel"> -->
        @error('excelList')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div>
            <button type="submit" class="btn wed-btn-main">
                Import
            </button>
        </div>

    </form>
    <a class="btn wed-btn-main" href="{{ route('adminsampleexport',['tasks']) }}">Sample format - TaskCategory</a>
    @endif
</div>
@endsection