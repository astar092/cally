<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.5/semantic.min.css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/main.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/locales/bootstrap-datepicker.ru.min.js') }}"></script>

    <script type="text/javascript">
        let APP_URL = {!! json_encode(url('/')) !!}
    </script>

    @yield('scripts')
</head>

<body id="farm" ontouchstart="">
    @include('layouts.menu')

    <div class="container">
        <div class="article">
            @yield('content')
        </div>
    </div>
</body>

@yield('pagespecificscripts')
@yield('modal-delete')
</html>
