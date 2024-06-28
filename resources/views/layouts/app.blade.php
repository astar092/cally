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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/datepicker-locale-ru.js'])

    @vite(['public/js/script.js'])
    @vite(['resources/css/semantic.min.css'])

    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.5/semantic.min.css"> --}}

    <!-- Styles -->
    @vite(['public/css/app.css'])
    @vite(['resources/sass/main.scss'])
    {{-- <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">

    {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css"> --}}
    {{-- <link href="{{ mix('css/main.css') }}" rel="stylesheet" type="text/css"> --}}
    {{-- <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet"> --}}
    {{-- <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/select2.min.js') }}"></script> --}}

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
