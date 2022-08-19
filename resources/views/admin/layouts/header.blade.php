<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{isset($title)?$title:'Merch'}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Datatable -->
  <link rel="stylesheet" href="{{url('http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{url('https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css')}}">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{url('des/admin/'.styledir())}}/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('des/admin/'.styledir())}}/dist/css/AdminLTE.min.css">
  <!-- Croppie -->
  <link rel="stylesheet" href="{{url('')}}/des/croppie/croppie.css">
  <!-- DatePicker -->
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{url('des/admin/'.styledir())}}/plugins/datepicker/datepicker3.css">
  <!-- intlTelInput -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/css/intlTelInput.css" type="text/css" media="all" />
  <!-- Tags Input -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />

  <link href="{{url('https://fonts.googleapis.com/css?family=Cairo:600')}}" rel="stylesheet">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="{{url('des/admin/'.styledir())}}/dist/css/skins/skin-blue.min.css">
  <style media="screen">

    .dataTables_length{
    position:relative;
    top:2px;
    left:10px;
    }
    #loadingspinner{
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    }
    #loadingspinner img{
    position: relative;
    {{app()->getLocale()=='ar'?'right':'left'}}: 50%;
    top: 50%;
    z-index: 9999;
    }
    #main-table , .dataTables_info, .dataTables_paginate{
    position:relative;
    top:10px;
    }
    .bootstrap-tagsinput {
      width: 100% !important;
    }

  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<div id="loadingspinner" class="hide"><img src='{{url("des/site/animated_spinner.gif")}}' width="50" height="50" /></div>
