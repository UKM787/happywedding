@extends('layouts.admin')

@section('content')
<p><a href="{{route('adminwelcome')}}" class="btn wed-btn-main">back</a></p>
<div class="d-flex justify-content-around">
    <div>
        <a class="btn wed-btn-main" href="{{route('adminlocation.index')}}">Locations</a>
    </div>
    <div>
        <a class="btn wed-btn-main" href="{{ route('adminlocation.create') }}"><i class="material-icons" title="Add new Location">add</i></a>
    </div>
    <!-- <div>
        <form action=" {{ route('adminlocation.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label style="padding: 9px !important;" for="categoryList" class="btn btn-upload btn-red">
                <h6>{{ __('Category Upload') }}<i class="fa fa-upload" aria-hidden="true"></i></h6>
                <input hidden type="file" name="categoryList" id="categoryList" class="@error('categoryList') is-invalid @enderror mb-4" accept="*.xls,*.xlsx">
            </label>
            <input type="hidden" value='true' name="excel">
            @error('categoryList')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <button type="submit" class="btn btn-sm wed-btn-main ml-5">
                <span class="material-icons">save</span>
            </button>
        </form>
    </div> -->
    <!-- <div>
        <a class="btn wed-btn-main" href="{{ route('adminimport', ['locations']) }}">Import</a>
    </div> -->
    <div>
        <a class="btn wed-btn-main" href="{{ route('adminexport', ['locations']) }}">Export</a>
    </div>
</div>


<div class="row g-3 my-2">
    <div class="col">
        <form id="countryfilters" action="{{route('adminlocationfilter')}}" method="GET">

            @csrf
            <select name="categoryId" id="categoryId" class="form-select" onchange="document.querySelector('#countryfilters').submit();">
                <option value=""> selectCountry </option>
                @foreach ($countries as $country)
                <option value="{{ $country->id }}" {{ $country->id == $selected ? 'selected' : '' }}>{{ $country->name }}</option>
                @endforeach
            </select>
            <!-- <input type="radio" id="dateDescendantOrder" name="order" value="descendantDateOrder" onclick="document.querySelector('#filters').submit();">
        <label for="dateDescendantOrder">Most recent</label>
        <input type="radio" id="dateAscendantOrder" name="order" value="ascendantDateOrder" onclick="document.querySelector('#filters').submit();">
        <label for="dateAscendantOrder">Less recent</label> -->
        </form>
    </div>
    <div class="col">
        <form id="statefilters" action="{{route('adminlocationfilter')}}" method="GET">

            @csrf
            <select name="categoryId" id="categoryId" class="form-select" onchange="document.querySelector('#statefilters').submit();">
                <option value=""> select State/City </option>
                @foreach ($states as $state)
                <option value="{{ $state->id }}" {{ $state->id == $selected ? 'selected' : '' }}>{{ $state->name }}</option>
                @endforeach
            </select>
            <!-- <input type="radio" id="dateDescendantOrder" name="order" value="descendantDateOrder" onclick="document.querySelector('#filters').submit();">
        <label for="dateDescendantOrder">Most recent</label>
        <input type="radio" id="dateAscendantOrder" name="order" value="ascendantDateOrder" onclick="document.querySelector('#filters').submit();">
        <label for="dateAscendantOrder">Less recent</label> -->
        </form>
    </div>
    <div class="col">
        <form id="cityfilters" action="{{route('adminlocationfilter')}}" method="GET">

            @csrf
            <select name="categoryId" id="categoryId" class="form-select" onchange="document.querySelector('#cityfilters').submit();">
                <option value=""> activeLocations </option>
                @foreach ($activeLocations as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </form>
    </div>

</div>
<div>
    @if(Session::has('errorStatus'))

    <div class=" guest-upload-err-table">
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



<div class="row g-3 my-2">
    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>

                <h3 class="fs-2">{{$countryCount}}</h3>
                <p class="fs-5">Countries</p>
            </div>
            <i class="fa fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>
    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>

                <h3 class="fs-2">{{$stateCount}}</h3>
                <p class="fs-5">States</p>
            </div>
            <i class="fa fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">{{$cityCount}}</h3>
                <p class="fs-5">Cities</p>
            </div>
            <i class="fa fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>
    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">{{$activeLocationsCount}}</h3>
                <p class="fs-5">locations</p>
            </div>
            <i class="fa fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>

</div>

<x-locationfilter :locations="$locations" :states="$states"></x-locationfilter>

@endsection