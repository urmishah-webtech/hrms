
<?php $__env->startSection('content'); ?>
<!-- Page Wrapper -->
            <div class="page-wrapper">
            
                <!-- Page Content -->
                <div class="content container-fluid">
                    
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Visitied Jobs</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <li class="breadcrumb-item ">Jobs</li>
                                    <li class="breadcrumb-item">User Dashboard</li>
                                    <li class="breadcrumb-item active">Visitied Jobs</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <!-- Content Starts -->
                    <div class="card">
                        <div class="card-body">
                            <!-- <h4 class="card-title">Solid justified</h4> -->
                            <ul class="nav nav-tabs nav-tabs-solid nav-justified">
                                <li class="nav-item"><a class="nav-link" href="user-dashboard">Dashboard</a></li>
                                <li class="nav-item"><a class="nav-link" href="user-all-jobs">All </a></li>
                                <li class="nav-item"><a class="nav-link" href="saved-jobs">Saved</a></li>
                                <li class="nav-item"><a class="nav-link" href="applied-jobs">Applied</a></li>
                                <li class="nav-item"><a class="nav-link" href="interviewing">Interviewing</a></li>
                                <li class="nav-item"><a class="nav-link" href="offered-jobs">Offered</a></li>
                                <li class="nav-item"><a class="nav-link active" href="visited-jobs">Visitied </a></li>
                                <li class="nav-item"><a class="nav-link" href="archived-jobs">Archived </a></li>
                            </ul>
                        </div>
                    </div>  
                    
                    <!-- Search Filter -->
                    <div class="row filter-row">
                        <div class="col-sm-6 col-md-3">  
                            <div class="form-group form-focus select-focus">
                                <select class="select floating"> 
                                    <option>Select</option>
                                    <option>Development</option>
                                    <option>Designing</option>
                                    <option>Android</option>
                                </select>
                                <label class="focus-label">Department</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">  
                            <div class="form-group form-focus select-focus">
                                <select class="select floating"> 
                                    <option>Select</option>
                                    <option>Full Time</option>
                                    <option>Part Time</option>
                                    <option>Internship</option>
                                </select>
                                <label class="focus-label">Job Type</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3"> 
                            <div class="form-group form-focus select-focus">
                                <select class="select floating"> 
                                    <option>Select Designation</option>
                                    <option>Web Developer</option>
                                    <option>Web Designer</option>
                                    <option>Android Developer</option>
                                    <option>Ios Developer</option>
                                </select>
                                <label class="focus-label">Designation</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">  
                            <a href="#" class="btn btn-success btn-block"> Search </a>  
                        </div>
                    </div>
                    <!-- Search Filter -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Job Title</th>
                                            <th>Department</th>
                                            <th>Start Date</th>
                                            <th>Expire Date</th>
                                            <th class="text-center">Job Type</th>
                                            <th class="text-center">Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><a href="job-details">Web Developer</a></td>
                                            <td>Development</td>
                                            <td>3 Mar 2019</td>
                                            <td>31 May 2019</td>
                                            <td class="text-center">
                                                <div class="action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded" href="#" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o text-danger"></i> Full Time
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded" href="#" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o text-danger"></i> Open
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><a href="job-details">Web Designer</a></td>
                                            <td>Designing</td>
                                            <td>3 Mar 2019</td>
                                            <td>31 May 2019</td>
                                            <td class="text-center">
                                                <div class="action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded" href="#" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o text-success"></i> Part Time
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded" href="#" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o text-success"></i> Closed
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><a href="job-details">Android Developer</a></td>
                                            <td>Android</td>
                                            <td>3 Mar 2019</td>
                                            <td>31 May 2019</td>
                                            <td class="text-center">
                                                <div class="action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded" href="#" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o text-danger"></i> Internship
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded" href="#" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o text-danger"></i> Cancelled
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
                    <!-- /Content End -->
                    
                </div>
                <!-- /Page Content -->
                
            </div>
            <!-- /Page Wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\smarthr_laravel\blue\resources\views/visited-jobs.blade.php ENDPATH**/ ?>