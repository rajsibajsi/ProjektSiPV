@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <h3>{{ $name }}</h3>
                    <h4>{{ $email }}</h4>
                    <h5>Since {{ $date->format('d. m. Y') }}</h5>
                </div>
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
                    <div class="row">
                @endif

                <?php $userHasCoin = 'false' ?>
                @foreach($users_coins as $users_coin)
                    @if($users_coin->id_coin === $coin->id)
                        <?php $userHasCoin = 'true' ?>
                    @endif
                @endforeach
                @if($userHasCoin === 'true')
                    <div class="col-sm-6 col-md-3" style="margin-right: -15px; margin-left: -15px; margin-bottom: -22px;">
                        <div class="thumbnail">
                            <div class="coinClick">
                                
                                    <img src="http://www.coin-database.com{{ $coin->img }}" alt="Failed to load img" style="opacity: 1">
                                

                                <div class="thumbnailheader" style="text-align: center; display: block; text-overflow: ellipsis; word-wrap: break-word; overflow: hidden; height: 3.6em; line-height: 1.8em;">{{ $coin->description }}</div>
                                <div class="caption">
                                    <p style="text-align: center;">Country: {{ $coin->country }}</p>
                                    <p style="text-align: center;">Year: {{ $coin->year }}</p>
                                </div>
                                <p style="text-align: center;">Coins owned:</p>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                    <?php $var += 1 ?>
                    @if ($var === 2) 
                        <div class="clearfix visible-sm"></div>
                    @endif
                    @if ($var === 4)
                        </div>
                        <?php $var = 0 ?>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
