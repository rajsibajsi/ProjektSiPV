@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <h3>{{ $name }}</h3>
                    <h4>{{ $email }}</h4>
                    <h5>Since {{ $date }}</h5>
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
