<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title> @yield('title')</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link rel="stylesheet"  href="{{asset('css/admin.css')}}"> 
    @yield('styles')
	




    <!-- PAGE LEVEL STYLES-->
</head>

<body class="fixed-navbar">