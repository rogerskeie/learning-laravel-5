<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Learning Laravel 5</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ elixir('css/all.css') }}">
</head>
<body>
    <div class="container">
        @include('flash::message')

        @yield('content')
    </div>

    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script>
        $('#flash-overlay-modal').modal();
//        $('div.alert').not('.alert-important').delay(3000).slideUp(300);
    </script>
    <div class="container">
        @yield('footer')
    </div>
</body>
</html>