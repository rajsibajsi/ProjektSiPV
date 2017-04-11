@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><div class="row"><div class="col-sm-10">Users</div><div id="nearMe" style="text-align:right; cursor: pointer;" class="col-sm-2"><span class="glyphicon glyphicon-map-marker"></span>Near me</div><input placeholder="50" type="text" id="distanceValue"></div></div>

                <div class="panel-body">
                    @if( ! empty($users) )
                        @foreach ($users as $user)
                            <a style="text-decoration: none;" href="{{ url('profile/' . $user->id) }}"><h4 style="color: black; padding-bottom: 20px; padding-top: 10px; border-bottom: 1px solid #f5f8fa;">{{ $user->name }}</h4><span class="distance" style="display: none;">{{ $user->distanceToMe }}</span></a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready( function() {
    $("#nearMe").click( function() {
        var distances = [];
        $(".distance").each( function() {
            distances.push($(this).text());
        });
        for (var i = 0; i < distances.length; i++) {
            if (distances[i] > $("#distanceValue").val()) {
                $(".panel-body > a:nth-child(" + (i + 1) + ")").css("display", "none");
            };
        };
    });
});
</script>
@endsection
