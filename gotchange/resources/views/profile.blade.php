@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <h3>{{ Auth::user()->name }}</h3>
            <h4>{{ Auth::user()->email }}</h4>
            <h5>{{ Auth::user()->created_at->format('d-m-Y') }}</h5>
        </div>
    </div>
</div>
@endsection
