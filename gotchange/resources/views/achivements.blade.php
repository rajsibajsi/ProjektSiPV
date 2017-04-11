@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="../css/customZajc.css">
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
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<div class="container">
    <div class="col-sm-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <a roll="button" class="btn btn-link" href="{{ route('profile') }}">Back to profile</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div id="profileTitle" class="row">
            <h2>Achivements</h2>
        </div>
            <div class="col-sm-12">
            <?php $var = 0; ?>
            @foreach($achivements as $achivement)
                @if ($var === 0)
                    <div style="display: flex;">
                @endif
                <div class="col-sm-6 col-md-3" style="margin-right: -15px; margin-left: -15px; margin-bottom: -22px;">
                    <div class="thumbnail">
                        <div class="coinClick">
                        <?php $userHasAchivement = 'false'; ?>
                            @foreach($users_achivements as $user_achivement)
                                @if($user_achivement->id_achivement === $achivement->id)
                                    <?php $userHasAchivement = 'true'; ?>
                                @endif
                            @endforeach

                            @if($userHasAchivement === 'true')
                                <img src="\ProjektSiPV\gotchange\public\img\star.png" alt="Failed to load img" width="100px" height="100px" style="display: block; margin-left: auto; margin-right: auto; opacity: 1.0">
                            @else
                                <img src="\ProjektSiPV\gotchange\public\img\star.png" alt="Failed to load img" width="100px" height="100px" style="display: block; margin-left: auto; margin-right: auto; opacity: 0.1">
                            @endif                            
                            <div class="thumbnailheader" style="text-align: center; display: block; text-overflow: ellipsis; word-wrap: break-word; overflow: hidden; height: 3.6em; line-height: 1.8em;">{{ $achivement->description }}</div>
                        </div>
                    </div>
                </div>
                <?php $var += 1; ?>
                @if ($var === 4)
                    </div>
                    <?php $var = 0 ?>
                @endif
            @endforeach
        </div>       
    </div>
</div>
@endsection
