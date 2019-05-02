<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> Code For Iraq </title>

        <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">
        
        <link rel="shortcut icon" href="{{ asset('images/c4i.png') }}">

        <link href='{{ asset("css/material.css",true) }}' rel="stylesheet">
        
    </head>
    <body>

        <div id="app">
           <home-view></home-view>
        </div>
        
        <script src="{{ asset("js/app.js",true) }}"></script>
    </body>
</html>
