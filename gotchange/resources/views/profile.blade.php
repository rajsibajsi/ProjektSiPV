@extends('layouts.app')

@section('content')

<script>

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    $("html, body").animate({ scrollTop: 0 }, 400);
    /*document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;*/
}

function albumEditButton()
{
    $.ajax({
        type: 'POST',
        url:'changeAlbumVar',
        data:'_token = <?php echo csrf_token() ?>',
        success:function(response){
            $('.AlbumEditStatus').html(response);
        }
    });
}

$(function(){ //Ready handler
    $('.coinClick').click(function(){
        var $coinDescription = $(this).children('div.thumbnailheader').text();
        var $numberOfCoins = $(this).parent().find('#inputNumber').val();
        var imgCss = $(this).children('img');
        $.ajax({
            type: 'POST',
            url:'getAlbumVar',
            data:'_token = <?php echo csrf_token() ?>',
            success:function(response){
                if(response == 'true')
                {
                    if($(imgCss).css('opacity') == '1')
                    {
                        $(imgCss).css('opacity', 0.2);
                    }
                    else
                    {
                        $(imgCss).css('opacity', 1);
                    }

                    $.ajax({
                        type: 'GET',
                        url:'dbCoinOwner',
                        data: {'data':$coinDescription, 'numberOfCoins':$numberOfCoins},
                    });
                }
            }
        });
    });

    $('.btn-number').click(function(e){
        fieldName = $(this).attr('data-field');
        type      = $(this).attr('data-type');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());

        if (!isNaN(currentVal)) {
            if(type == 'minus') {

                if(currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                } 
                if(parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }
                else {
                    $('#spanPlus').children().attr('disabled', false);
                }

            } else if(type == 'plus') {

                if(currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if(parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }
                else {
                    $('#spanMinus').children().attr('disabled', false);
                }

            }
        } else {
            input.val(0);
        }

        var $coinDescription = $(this).parent().parent().parent().parent().find('div.thumbnailheader').text();
        var $numberOfCoins = $(this).parent().parent().find('#inputNumber').val();

        $.ajax({
            type: 'POST',
            url:'getAlbumVar',
            data:'_token = <?php echo csrf_token() ?>',
            success:function(response){
                if(response == 'true')
                {
                    $.ajax({
                        type: 'GET',
                        url:'updateNumberOfCoins',
                        data: {'data':$coinDescription, 'numberOfCoins':$numberOfCoins},
                    });
                }
            }
        });
    });
});
</script>
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<div class="container">
    <div class="col-sm-12 col-md-3">
        <div class="row">
            <div id="userInfo" class="col-sm-12">
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
                @if(Request::path() === 'profile' || Request::path() === 'profile/sortYear' || Request::path() === 'profile/sortCountry' || Request::path() === 'profile/sortOwned')
                    <div class="row">
                        <button type="button" class="btn btn-primary" style="margin-top: 5px;" onclick="albumEditButton()">Edit Album</button></div>
                    <div class="row">
                        <h6 class="AlbumEditStatus">Album editing is <kbd>disabled</kbd></h6>
                    </div>
                @endif
                <div id="statistics" class="row"> 
                    <h3>Statistics</h3>
                        <p>Deals: 0</p>
                        <p>All coins: {{ $all }}</p>
                        <p>Unique coins: {{ $unique }}</p>
                </div>
                <div class="row">
                    <a roll="button" class="btn btn-link" href="{{ route('achievements') }}">Achievements</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-9">
        <div id="profileTitle" class="row">
            <div class="col-sm-8">
                <h2>Album</h2>
            </div>
            <div class="col-sm-4">
                <div class="row">
                Sort by
                <a roll="button" class="btn btn-link" href="{{ route('sortByYear') }}">Year</a>
                <a roll="button" class="btn btn-link" href="{{ route('sortByCountry') }}">Country</a>
                <a roll="button" class="btn btn-link" href="{{ route('sortByOwned') }}">Owned</a>                        
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <?php $var = 0 ?>
            @foreach($coins as $coin)
                @if ($var === 0)
                    <div class="row">
                @endif
                <div class="col-sm-6 col-md-3" style="margin-right: -15px; margin-left: -15px; margin-bottom: -22px;">
                    <div class="thumbnail">
                        <div class="coinClick">
                            <?php $userHasCoin = 'false' ?>
                            @foreach($users_coins as $users_coin)
                                @if($users_coin->id_coin === $coin->id)
                                    <?php $userHasCoin = 'true' ?>
                                    @if($userHasCoin === 'true')
                                        <?php $ownedCoins = $users_coin->number_of_coins ?>
                                    @endif
                                @endif
                            @endforeach

                            @if($userHasCoin === 'true')
                                <img src="http://www.coin-database.com{{ $coin->img }}" alt="Failed to load img" style="opacity: 1; max-height: 155px; max-width: 155px">
                            @else
                                <img src="http://www.coin-database.com{{ $coin->img }}" alt="Failed to load img" style="opacity: 0.2; max-height: 155px; max-width: 155px">
                            @endif

                            <div class="thumbnailheader" style="text-align: center; display: block; text-overflow: ellipsis; word-wrap: break-word; overflow: hidden; height: 3.6em; line-height: 1.8em;">{{ $coin->description }}</div>
                            <div class="caption">
                                <p style="text-align: center;">Country: {{ $coin->country }}</p>
                                <p style="text-align: center;">Year: {{ $coin->year }}</p>
                            </div>
                            <p style="text-align: center;">Coins owned:</p>
                        </div>
                        <div>
                            <div class="input-group">
                                @if(Request::path() === 'profile' || Request::path() === 'profile/sortYear' || Request::path() === 'profile/sortCountry' || Request::path() === 'profile/sortOwned')
                                    <span class="input-group-btn" id="spanMinus">
                                        <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[{{ $coin->id }}]">
                                            <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>
                                @endif
                                @if($userHasCoin === 'true')
                                    <input type="text" name="quant[{{ $coin->id }}]" readonly="readonly" class="form-control input-number" value="<?php echo($ownedCoins)?>" min="1" max="100" id="inputNumber">
                                @else
                                    <input type="text" name="quant[{{ $coin->id }}]" readonly="readonly" class="form-control input-number" value="1" min="1" max="100" id="inputNumber">
                                @endif
                                @if(Request::path() === 'profile' || Request::path() === 'profile/sortYear' || Request::path() === 'profile/sortCountry' || Request::path() === 'profile/sortOwned')
                                    <span class="input-group-btn" id="spanPlus">
                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{ $coin->id }}]">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                                @endif
                            </div>
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
            @endforeach
        </div>
    </div>
</div>
@endsection
