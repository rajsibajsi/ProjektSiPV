@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><div class="row"><div class="col-sm-10">Users</div><div style="text-align:left; cursor: pointer;" class="col-sm-2"><span style="padding-top: 3px;" class="glyphicon glyphicon-map-marker"></span><span style="padding-right: 6px; padding-top: 3px;" id="nearMeButton">Near me</span><input style="float: right; max-width: 50px;" value="50" type="text" id="distanceValue"></div></div></div>

                <div class="panel-body">
                    @if( ! empty($users) )
                        @foreach ($users as $user)
                            <div class="row">
                            <a style="text-decoration: none;" href="{{ url('profile/' . $user->id) }}">
                                <h4 style="display: inline-block; vertical-align: center; color: black; padding-bottom: 20px; padding-top: 10px; border-bottom: 1px solid #f5f8fa;">{{ $user->name }}</h4>
                            </a>
                                <span class="distance" style="display: inline-block; vertical-align: center;">{{ number_format($user->distanceToMe, 2, '.', '') }} km</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready( function() {
    $("#nearMeButton").click( function() {
        var distances = [];
        $(".distance").each( function() {
            distances.push($(this).text());
        });
        for (var i = 0; i < distances.length; i++) {
            if (distances[i] > $("#distanceValue").val()) {
                $(".panel-body > div:nth-child(" + (i + 1) + ")").css("display", "none");
            }
            else {
                $(".panel-body > div:nth-child(" + (i + 1) + ")").css("display", "block");
            }
        };
    });
});
</script>
@endsection
