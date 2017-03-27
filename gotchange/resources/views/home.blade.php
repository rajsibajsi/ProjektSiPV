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
                            <a style="text-decoration: none;" href="{{ url('profile/' . $user->id) }}"><h5 style="padding-bottom: 20px; border-bottom: 1px solid #f5f8fa;">{{ $user->name }}</h5></a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
