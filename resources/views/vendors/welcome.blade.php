	@extends('layouts.vendor')
	@section('content')


	<div class="container m-auto">


	        @if(Session::has('success'))
	        <div class="alert alert-success alert-dismissible fade show" role="alert">
	            {{ Session::get('message') }}
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	            </button>
	        </div>
	        @endif


			
	        <vendor-welcome vendor="{{ $vendor }}"></vendor-welcome>
	</div>
				<!-- <vendor-calander></vendor-calander> -->
	@endsection
