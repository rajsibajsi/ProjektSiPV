@extends('layouts.app')

@section('content')

<script>
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
        var $numberOfCoins = $(this).find('#inputNumber').val();
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
        e.preventDefault();

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
    });
});
</script>

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
                    <div class="row"><button type="button" class="btn btn-primary" style="margin-top: 5px;" onclick="albumEditButton()">Edit Album</button></div>
                    <div class="row">
                        <h6 class="AlbumEditStatus">Album editing is <kbd>disabled</kbd></h6>
                    </div>
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
                    <div class="thumbnail coinClick">
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
                            <img src="http://www.coin-database.com{{ $coin->img }}" alt="Failed to load img" style="opacity: 1">
                        @else
                            <img src="http://www.coin-database.com{{ $coin->img }}" alt="Failed to load img" style="opacity: 0.2">
                        @endif

                        <div class="thumbnailheader" style="text-align: center; display: block; text-overflow: ellipsis; word-wrap: break-word; overflow: hidden; height: 3.6em; line-height: 1.8em;">{{ $coin->description }}</div>
                        <div class="caption">
                            <p style="text-align: center;">Country: {{ $coin->country }}</p>
                            <p style="text-align: center;">Year: {{ $coin->year }}</p>
                        </div>
                        <p style="text-align: center;">Coins owned:</p>
                        <div class="input-group">
                            @if(Request::url() === 'http://localhost:81/ProjektSiPV/gotchange/public/profile')
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
                            @if(Request::url() === 'http://localhost:81/ProjektSiPV/gotchange/public/profile')
                                <span class="input-group-btn" id="spanPlus">
                                    <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{ $coin->id }}]">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            @endif
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
