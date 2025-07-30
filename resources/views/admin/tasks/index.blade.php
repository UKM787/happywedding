@extends('layouts.admin')

@section('content')
<p><a href="{{route('adminwelcome')}}" class="btn wed-btn-main">back</a></p>
<div class="d-flex justify-content-around">
    <div>
        <a class="btn wed-btn-main" href="{{route('admintask.index')}}">Task categories</a>
    </div>
    <div>
        <a class="btn wed-btn-main" href="{{ route('admintask.create') }}"> <i class="material-icons" title="Add new Task">add</i></a>
    </div>
    <div>
        <a class="btn wed-btn-main" href="{{ route('getimportform').'?type=tasks' }}">Import</a>
    </div>
    <div>
        <a class="btn wed-btn-main" href="{{ route('admintaskexport', ['tasks']) }}">Export</a>
    </div>
</div>

<div class="row g-3 my-2">
    <div class="col-md-4">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">

            <h3 class="fs-2">{{$categories->count()}}</h3>
            <p class="fs-5">Task Categories</p>
            <i class="fa fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>
    <div class="col-md-4">
        <form id="filters" action="{{route('admintaskfilter')}}" method="GET">

            @csrf
            <select name="categoryId" id="categoryId" class="form-select" onchange="document.querySelector('#filters').submit();">
                <option value=""> selectTask Category </option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <!-- <input type="radio" id="dateDescendantOrder" name="order" value="descendantDateOrder" onclick="document.querySelector('#filters').submit();">
        <label for="dateDescendantOrder">Most recent</label>
        <input type="radio" id="dateAscendantOrder" name="order" value="ascendantDateOrder" onclick="document.querySelector('#filters').submit();">
        <label for="dateAscendantOrder">Less recent</label> -->
        </form>
    </div>
    <div class="col-md-4">
        <form id="cityfilters" action="{{route('admintaskfilter')}}" method="GET">

            @csrf
            <select name="categoryId" id="categoryId" class="form-select" onchange="document.querySelector('#cityfilters').submit();">
                <option value=""> activeTasks </option>
                @foreach ($activeTasks as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>



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



<x-taskfilter :tasks="$tasks" :categories="$categories"></x-taskfilter>

@endsection