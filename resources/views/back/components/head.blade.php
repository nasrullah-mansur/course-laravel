<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  
  <title>Dashboard :: {{ isset($title) ? $title : '' }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" href="{{ asset('back/images/ico/apple-icon-120.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('back/images/ico/favicon.ico') }}">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('back/css/vendors.css') }}">
  
  <link rel="stylesheet" href="{{ asset('back/plugins/nestable/netable.css') }}">

  <!-- END VENDOR CSS-->
  <link rel="stylesheet" href="{{ asset('back/vendors/css/extensions/toastr.css') }}">
  
  <link rel="stylesheet" type="text/css" href="{{ asset('back/vendors/css/extensions/sweetalert.css') }}">
  
  <!-- BEGIN STACK CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('back/css/app.css') }}">
  <!-- END STACK CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('back/css/core/menu/menu-types/vertical-menu.css') }}">
  <!-- END Page Level CSS-->

  <link rel="stylesheet" href="{{ asset('back/css/custom.css') }}">

  <link rel="stylesheet" href="{{ asset('back/plugins/datepicker/bootstrap-datepicker.min.css') }}">
 