<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Admin Panel</title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
      <script src="https://kit.fontawesome.com/b902445226.js" crossorigin="anonymous"></script>
      
      <link rel="stylesheet" href="{{ asset('css/admin.css')}}">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   </head>
   <body class="hold-transition skin-nit sidebar-mini fixed" ng-app="myApp" ng-controller="myCtrl" >
      <div class="wrapper" >
         <!-- Main Header -->
         
         @include('layouts.header')
         <!-- Left side column. contains the logo and sidebar -->
         @include('layouts.sidebar')
         <!-- Content Wrapper. Contains page content -->
         {{ $slot }}
         <!-- /.content-wrapper -->
      </div>
      <!-- ./wrapper -->
      <!-- REQUIRED JS SCRIPTS --> 
      @include('layouts.footer')
   </body>
</html>




