@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <h3>{{ Auth::user()->name }}</h3>
                    <h4>{{ Auth::user()->email }}</h4>
                    <h5>Since {{ Auth::user()->created_at->format('d. m. Y') }}</h5>
                </div>
                <div class="row">
                    @if (Auth::user()->lat)
                        <a roll="button" class="btn btn-link" href="#">See Location</a>
                    @else
                        <a roll="button" class="btn btn-link" href="#">Add Location</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div id="profileTitle" class="row">
            <h2>Album</h2>
        </div>
        <div class="col-sm-12">
        </div>
    </div>
</div>
@endsection
