<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wise clientes -  @yield('title')</title>
    <!--
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-clearmin.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/roboto.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/material-design.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/small-n-flat.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/all.css')}}">
     
        
        
       <!-- jQuery library -->
       
    </head>
     <body class="cm-login">
<!--<div id="app">-->
    <div class="text-center" style="padding:90px 0 30px 0;background:#fff;border-bottom:1px solid #ddd">
      <img src="{{url('/img/wisee.png')}}" width="300" >
    </div>
    
    <div class="col-sm-6 col-md-4 col-lg-3" style="margin:40px auto; float:none;">

        <main class="py-4">
            @yield('content')
        </main>
         <script src="{{asset('js/lib/jquery-2.1.3.min.js')}}"></script>      
        <script src="{{asset('js/jquery.mousewheel.min.js')}}"></script>
        <script src="{{asset('js/jquery.cookie.min.js')}}"></script>
        <script src="{{asset('js/fastclick.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/clearmin.min.js')}}"></script>
        <script src="{{asset('js/demo/home.js')}}"></script>
       
       <!-- <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js">
        </script>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
        <script>
        $.noConflict();
        jQuery( document ).ready(function( $ ) {
          $('#grid').DataTable();
        });
        // Code that uses other library's $ can follow here.
        </script>-->
    </div>
    </body>
</html>