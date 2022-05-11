
@extends('layouts.master')

@section('content')

@include('partials.messages')
@include('layouts.nav-bar')
<main role="main" class="container">
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
                <h5 class="card-title">Let's gaming!</h5>
                <p class="card-text">Try to guess the combination by entering 4 different digits.</p>
                <form onsubmit="event.preventDefault(); guessNumber()" id="play-form">
                    <p class="text-danger" id="numberError"></p>
                    <div class="input-group">
                        <input type="text" class="form-control" id="guess" placeholder="Please enter 4 different digits"
                               maxlength="4" pattern="^(?:([0-9])(?!.*\1)){4}$" id="guess" required autocomplete="off"">
                        <div class="input-group-append" id="button-addon4">
                            <button class="btn btn-outline-success" type="submit">Guess</button>
                            <button class="btn btn-outline-danger" type="button"
                                    onclick="event.preventDefault(); giveUp()">Give Up
                            </button>
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
                        <a class="nav-link active" id="tries-tab" data-toggle="tab" href="#tries"
                           onclick="getTop('tries')" role="tab"
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
@include('partials.rules-modal')

@stop


