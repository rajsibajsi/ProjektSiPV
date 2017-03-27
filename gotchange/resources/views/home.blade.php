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
                            <a style="text-decoration: none;" href="{{ url('profile/' . $user->id) }}"><h3 style="padding-bottom: 20px; border-bottom: 1px solid #756e7c;">{{ $user->name }}</h3></a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
