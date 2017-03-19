@extends('layouts.app')

@section('content')
<div class="container">
    <div style="min-height: 400px; margin-bottom: 20px;" id="map"></div>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('addLocation') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
            <label for="address" class="col-md-4 control-label">Address</label>

            <div class="col-md-6">
                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button id="goToMap" class="btn btn-primary">
                    Go to
                </button>
                <button type="submit" id="save" class="btn btn-secondary">
                    Save
                </button>
            </div>
        </div>
        <input type="hidden" name="lat" id="lat">
        <input type="hidden" name="lng" id="lng">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    <script>
    var positionObject;
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: {lat: 46.559437, lng: 15.639228}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('goToMap').addEventListener('click', function() {
            geocodeAddress(geocoder, map);
            event.preventDefault();
        });
    }


    function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
                $("#lat").val(results[0].geometry.location.lat());
                $("#lng").val(results[0].geometry.location.lng());
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3eL-GsH6hRmRWt9cwYJrONLkGcJCdrxQ&callback=initMap">
    </script>
</div>
@endsection