@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="row">
                <h3>{{ Auth::user()->name }}</h3>
                <h4>{{ Auth::user()->email }}</h4>
                <h5>Since {{ Auth::user()->created_at->format('d. m. Y') }}</h5>
            </div>
            <div class="row">
                @if (Auth::user()->lat)
                @else
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
