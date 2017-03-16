@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <h3>{{ Auth::user()->name }}</h3>
            <h4>{{ Auth::user()->email }}</h4>
        </div>
    </div>
</div>
@endsection
