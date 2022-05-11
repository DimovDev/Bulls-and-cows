
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
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item ml-auto">
                     <span class="navbar-brand">
            <i class="fas fa-user-secret"></i>
            <span style="cursor: pointer" id="player-name">Hello {{session('name')}}</span>
        </span>
            </li>
        </ul>
    </div>
</nav>
