@extends('layout.mainlayout')
@section('content')
<?php use Illuminate\Support\Str;
?>
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Success </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Success</li>
                            </ul>
                        </div>
                    </div>
                </div> 
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-view"> 
                                    <div class="profile-basic">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="" style="text-align:center">
                                                    <h3 class="user-name m-t-0 mb-0">  Your Performance for this Period has now been Submitted.</h3>  <br>
                                                    <h6 class="staff-id">We have notified your manager.</h6><br>
                                                    <small class="staff-id">Please allow some time for their review, and other follow ups.</small> 
                                                </div>
                                            </div> 
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>  
        </div>
        <!-- /Page Wrapper -->
@endsection