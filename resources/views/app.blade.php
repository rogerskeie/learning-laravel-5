<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Learning Laravel 5</title>
    <link rel="stylesheet" href="/css/all.css">
</head>

<body>
    <div class="container">
        @include('flash::message')

        @yield('content')
    </div>

    <script src="/js/all.js"></script>
    @yield('footer')
</body>
</html>