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
                    <a roll="button" class="btn btn-link" href="{{ route('seeLocation') }}">See Location</a>
                    @else
                    <a roll="button" class="btn btn-link" href="{{ route('goToLocation') }}">Add Location</a>
                    @endif
                </div>
                @if(Request::url() === 'http://localhost:81/ProjektSiPV/gotchange/public/profile')
                    <div class="row"><button type="button" class="btn btn-primary" style="margin-top: 5px;">Edit Album</button></div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div id="profileTitle" class="row">
            <h2>Album</h2>
        </div>
        <div class="col-sm-12">
            <?php $var = 0 ?>
            @foreach($coins as $coin)
                @if ($var === 0)
                    <div style="display: flex;">
                @endif
                <div class="col-sm-6 col-md-3" style="margin-right: -15px; margin-left: -15px; margin-bottom: -22px;">
                    <div class="thumbnail">
                        <img src="http://www.coin-database.com{{ $coin->img }}" alt="Failed to load img" style="opacity: 0.2">

                        <div class="thumbnailheader" style="text-align: center; display: block; text-overflow: ellipsis; word-wrap: break-word; overflow: hidden; height: 3.6em; line-height: 1.8em;">{{ $coin->description }}</div>
                        <div class="caption">
                            <p style="text-align: center;">Country: {{ $coin->country }}</p>
                            <p style="text-align: center;">Year: {{ $coin->year }}</p>
                        </div>
                    </div>
                </div>
                <?php $var += 1 ?>
                @if ($var === 4)
                    </div>
                    <?php $var = 0 ?>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
