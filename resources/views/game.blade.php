<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{asset('js/app.js') }}" ></script>

        <!-- Styles -->
        <link href="{{asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body class="">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="{{asset('images/bulls-cows.webp')}}" width="60" height="60" alt="bulls-cows">
            Bulls and Cows
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">New Game <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Rules</a>
                </li>
            </ul>
        </div>
    </nav>

    <script>
        //Test jQuery
        $(document).ready(function () {
            console.log('jQuery works!');

            //Test bootstrap Javascript
            console.log(bootstrap.Tooltip.VERSION);
        });

    </script>
    </body>
</html>
