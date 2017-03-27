@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if( ! empty($users) )
                        @foreach ($users as $user)
                            <a class="profileHeader" href="{{ url('profile/' . $user->id) }}"><h3>{{ $user->name }}</h3></a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
