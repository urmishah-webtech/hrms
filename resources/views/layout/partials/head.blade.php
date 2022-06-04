<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
	 <meta name="_token" content="{!! csrf_token() !!}" />
        <meta name="robots" content="noindex, nofollow">
		<?php
			$theme_setting=DB::table('theme_settings')->first();
		?>
       @if($theme_setting)
	   @if($theme_setting->website_name!=null)
	   <title>Dashboard - {{ @$theme_setting->website_name }}</title>
	   @else
	   <title>Dashboard - HRMS admin template</title>
	   @endif
	   @else
	   <title>Dashboard - HRMS admin template</title>
	   @endif
		
		<!-- Favicon -->
        @if($theme_setting)
			@if($theme_setting->favicon!=null)
			<link rel="shortcut icon" type="image/x-icon" href="{{ asset('/').'/setting_images/'.@$theme_setting->favicon }}">
			@else
			<link rel="shortcut icon" type="image/x-icon" href="{{ asset('/').'img/favicon.png'}}">
			@endif
		@else
			<link rel="shortcut icon" type="image/x-icon" href="{{ asset('/').'img/favicon.png'}}">
		@endif
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('/').'css/bootstrap.min.css'}}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('/').'css/font-awesome.min.css'}}">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ asset('/').'css/line-awesome.min.css'}}">
		
        	<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{ asset('/').'css/select2.min.css'}}">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{ asset('/').'css/bootstrap-datetimepicker.min.css'}}">
		
		<!-- Calendar CSS -->
		<link rel="stylesheet" href="{{ asset('/').'css/fullcalendar.min.css'}}">

        <!-- Tagsinput CSS -->
		<link rel="stylesheet" href="{{url('/').'plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'}}">

		<!-- Datatable CSS -->
		<link rel="stylesheet" href="{{ url('/').'css/dataTables.bootstrap4.min.css'}}">
        
		<!-- Chart CSS -->
		<link rel="stylesheet" href="{{ asset('/').'plugins/morris/morris.css'}}">

		<!-- Summernote CSS -->
		<link rel="stylesheet" href="{{ asset('/').'plugins/summernote/dist/summernote-bs4.css'}}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('/').'css/style.css'}}">

    </head>
