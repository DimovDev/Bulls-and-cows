<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')
<body onload="getTop('tries')">

@yield('content')
@include('layouts.footer')

<script type="text/javascript" src="{{asset('js/game.js') }}"></script>
<script>
    $(document).ready(function () {
        newGame("{{session('name')}}")
    });
</script>
</body>
</html>
