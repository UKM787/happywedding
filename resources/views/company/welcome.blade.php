	@extends('layouts.company')
	@section('content')
	<weddingplanner-welcome planner="{{ $company }}"></weddingplanner-welcome>
	
	<div class="container">
	    @if(Session::has('success'))
	    <div class="alert alert-success alert-dismissible fade show" role="alert">
	        {{ Session::get('success') }}
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	        </button>
	    </div>
	    @endif
	    <!-- <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">Dashboard</div>
	                <div class="card-body">
	                    Hi boss! you are logged in as Company <span class="h4 text-success">	@if(isset($company)) {{$company->name}} @endif</span>
	                    <ul>
	                        <li>
	                            <p>All <span class="h4 text-success">@if(isset($company)) {{$company->name}} @endif</span> controls goes here</p>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div> -->
		
	</div>
	@endsection
