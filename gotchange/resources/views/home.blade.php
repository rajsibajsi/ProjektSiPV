@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                    @if( ! empty($users) )
                        @foreach ($users as $user)
                            <a style="text-decoration: none;" href="{{ url('profile/' . $user->id) }}"><h4 style="color: black; padding-bottom: 20px; padding-top: 10px; border-bottom: 1px solid #f5f8fa;">{{ $user->name }}<span>{{ $user->distanceToMe }}</span></h4></a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
