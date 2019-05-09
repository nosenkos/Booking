<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('css')
    <link rel="stylesheet" href="/css/app.css" />
    @yield('header-js')
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>
<div id="app">
    @include('elements.nav')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@yield('footer-js')
<script src="/js/app.js"></script>
</body>
</html>
