<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Billfox</title>

        {{-- Script --}}
        <script src="{{mix('/js/app.js')}}"></script>

        @stack('post-script')

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    </head>
    <body>
        @section('body')
        @show
    </body>
</html>
