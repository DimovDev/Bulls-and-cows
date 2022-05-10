<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bulls and Cows</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Favicons-->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{asset('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{asset('css/app.css') }}" rel="stylesheet">

</head>
<body onload="getTop('tries')">
<div class="alert alert-danger print-error-msg" style="display:none">
    <ul></ul>
</div>

@if(session('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{session('error')}}</div>
@endif
<span class="success" style="color:green; margin-top:10px; margin-bottom: 10px;"></span>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src="{{asset('images/bulls-cows.webp')}}" width="60" height="60" alt="bulls-cows">
        Bulls and Cows
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="" onclick="newGame('{{session('name')}}')">New Game <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#rulesModal">Rules</a>
            </li>
            <li>
                     <span class="navbar-brand">
            <i class="fas fa-user-secret"></i>
            <span style="cursor: pointer" id="player-name" onclick="editName()">{{session('name')}}</span>
        </span>
            </li>
        </ul>
    </div>
</nav>
<main class="container">
    <div class="row pt-2">
        <div class="col-sm-6" id="enter-name" @if(session(
        'name')) style="display: none" @endif >
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Welcome</h5>
                <p class="card-text">Please, enter your name to begin.</p>
                <form onsubmit="event.preventDefault(); newGame()">
                    <div class="input-group">
                        <input type="text" id="name-input" class="form-control" placeholder="Please, enter your name."
                               aria-label="Recipient's username with two button addons"
                               aria-describedby="button-addon4">
                        <div class="input-group-append" id="button-addon4">
                            <button class="btn btn-outline-success" type="submit">New Game</button>
                        </div>
                    </div>
                    <span class="text-danger" id="nameError"></span>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6 d-none" id="play-game">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Let's gaming</h5>
                <p class="card-text">Try to guess the combination by entering 4 different numbers.</p>
                <form onsubmit="event.preventDefault(); guessNumber()" id="play-form">
                    <p class="text-danger" id="numberError"></p>
                    <div class="input-group">
                        <input type="text" class="form-control" id="guess" placeholder="Enter 4 different digits"
                               maxlength="4" pattern="^(?:([0-9])(?!.*\1)){4}$" id="guess" required autocomplete="off"">
                        <div class="input-group-append" id="button-addon4">
                            <button class="btn btn-outline-success" type="submit">Guess</button>
                            <button class="btn btn-outline-danger" type="button" onclick="giveUp()">Give Up</button>
                        </div>
                    </div>
                    <p class="text-danger" id="numberError"></p>
                </form>
                <div id="results" class="card-text"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">TOP 10 Players</h5>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tries-tab" data-toggle="tab" href="#tries" onclick="getTop('tries')" role="tab"
                           aria-controls="tries" aria-selected="true">By count tries</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="times-tab" data-toggle="tab" href="#times" role="tab"
                           onclick="getTop('times')"
                           aria-controls="times" aria-selected="false">By Time</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tries" role="tabpanel" aria-labelledby="tries-tab">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Tries</th>
                                <th scope="col">Time</th>
                            </tr>
                            </thead>
                            <tbody id="top-tbody-tries">
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="times" role="tabpanel" aria-labelledby="times-tab">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Tries</th>
                                <th scope="col">Time</th>
                            </tr>
                            </thead>
                            <tbody id="top-tbody-times">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Modal -->
<div class="modal fade" id="rulesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rulesModalTitle">Rules</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bulls and cows is a traditional game in which you have to guess pre-generated combination of numbers.
                The program generates combination of 4 unique numbers (the same number can't be in more than one place at a time,  zero is included). After you start the game, you must try to guess the combination, result will be presented in the form of number of bulls and cows.
                Bull means that you guessed the number and the corresponding position. Cows mean that you only guessed the number, but it’s not in the correct position.
                The game ends when you guess all numbers and their positions, which is equal to 4 bulls.
                If you decide to surrender, you can choose “Give Up” where you will see what was the combination.
                Have fun!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<footer class="footer mt-auto py-3">
    <div class="container">
        <span class="text-muted">Place sticky footer content here.</span>
    </div>
</footer>
    <script type="text/javascript" src="{{asset('js/game.js') }}" ></script>
<script>
    //Test jQuery
    $(document).ready(function () {
        console.log('jQuery works!');
        newGame("{{session('name')}}")
        //Test bootstrap Javascript
        console.log(bootstrap.Tooltip.VERSION);
    });

</script>
</body>
</html>
