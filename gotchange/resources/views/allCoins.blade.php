@extends('layouts.app')

@section('content')

	@foreach(coins as $coin)
    		<div class="col-sm-12">
    			<div>{{ $coin->name }}</div>
    			<div>{{ $coin->weight }}</div>
    		</div>
    	@empty
    		<h2>No coins in database</h2>
    	@endforelse

@endsection


    	