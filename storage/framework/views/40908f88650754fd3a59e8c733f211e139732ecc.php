
<?php $__env->startSection('content'); ?>
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Employee</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Employee</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
                            <div class="view-icons">
                                <a href="employees" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                                <a href="employees-list" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Search Filter -->
                <form action="<?php echo e(route('search_employee')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row filter-row">
                        <div class="col-sm-6 col-md-3">  
                            <div class="form-group form-focus">
                                <input type="text" value="<?php echo e(@$search_employee_id); ?>" name="search_employee_id" class="form-control floating">
                                <label class="focus-label">Employee ID</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">  
                            <div class="form-group form-focus">
                                <input type="text" value="<?php echo e(@$search_name); ?>"  name="search_name" class="form-control floating">
                                <label class="focus-label" >Employee Name</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3"> 
                            <div class="form-group form-focus select-focus">
                                <select class="select floating" name="search_designation"> 
                                    <option value="">Select Designation</option>
                                    <?php if(isset($des)): ?>
                                        <?php $__currentLoopData = $des; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>" <?php if(@$search_designation==$item->id ): ?> selected <?php endif; ?>><?php echo e($item->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <label class="focus-label">Designation</label>
                            </div>
                        </div>
                    <div class="col-sm-6 col-md-3">  
                        <input type="submit" class="btn btn-success btn-block" value="search">  
                    </div>
                </form>
                </div>
                <!-- Search Filter -->
                <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                   
                    <?php if($errors->any()): ?>
                    <?php echo implode('', $errors->all('<div>:message</div>')); ?>

                    <?php endif; ?>
                   
                </div>
                <?php endif; ?>
                <?php if(isset($emps)): ?>
                <div class="row staff-grid-row">
                    <?php $__currentLoopData = $emps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                <div class="profile-widget">
                                    <div class="profile-img">
                                        <a href="profile" class="avatar"><img src="img/profiles/avatar-02.jpg" alt=""></a>
                                    </div>
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item edtEmpBtn" href="#" data-toggle="modal" data-id="<?php echo e(@$val->id); ?>" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item delEmpBtn" href="#" data-toggle="modal" data-id="<?php echo e(@$val->id); ?>" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile"><?php echo e($val->first_name); ?> <?php echo e($val->last_name); ?></a></h4>
                                    <div class="small text-muted"><?php echo e($val->designation->name); ?></div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </div>
                <?php endif; ?> 
            <!-- /Page Content -->
            
            <!-- Add Employee Modal -->
            <div id="add_employee" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo e(route('add_employee')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="first_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Last Name</label>
                                            <input class="form-control" type="text" name="last_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Username <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="user_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Password</label>
                                            <input class="form-control" type="password" name="password" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Confirm Password</label>
                                            <input class="form-control" type="password" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="employee_id" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="joing_date" type="text" required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Phone </label>
                                            <input class="form-control" type="text" name="phone_no" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Company</label>
                                            <select class="select" name="company_id" required>
            
                                                <option value="1">Delta Infotech</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Department <span class="text-danger">*</span></label>
                                            <select class="select" id="depList" name="department_id" required>
                                                <option>Select Department</option>
                                                <?php if(isset($dep)): ?>
                                                    <?php $__currentLoopData = $dep; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Designation <span class="text-danger">*</span></label>
                                            <select class="select" name="designation_id" id="designationList" required>
                                                <option value="">Select Designation</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive m-t-15">
                                    <table class="table table-striped custom-table">
                                        <thead>
                                            <tr>
                                                <th>Module Permission</th>
                                                <?php if(isset($emp_permissions)): ?>
                                                    <?php $__currentLoopData = $emp_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <th class="text-center"><?php echo e($ep->name); ?></th>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(isset($modules)): ?>
                                        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($val->name); ?></td>
                                                <?php if(isset($emp_permissions)): ?>
                                                <?php $__currentLoopData = $emp_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <td class="text-center">
                                                        <input name="permission_modules[]" value="<?php echo e($val->id); ?>_<?php echo e($ep->id); ?>" type="checkbox">
                                                    </td>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                               
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?> 
                        
                                        </tbody>
                                    </table>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Employee Modal -->
            
            <!-- Edit Employee Modal -->
            <div id="edit_employee" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo e(route('update_employee')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                            <input class="form-control" value="" required type="text" name="first_name" id="emp_first_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Last Name</label>
                                            <input class="form-control" value="" type="hidden" name="id" id="emp_id">
                                            <input class="form-control" value="" type="text" name="last_name" id="emp_last_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Username <span class="text-danger">*</span></label>
                                            <input class="form-control" value="" type="text" name="user_name" id="emp_user_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control" value="" type="email"  name="email" id="emp_email">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Password</label>
                                            <input class="form-control" value="" type="password" name="password" placeholder="*****">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Confirm Password</label>
                                            <input class="form-control" value="" type="password" name="confirm_password">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                            <input type="text" value=""  class="form-control" name="employee_id" id="emp_employee_id">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="joing_date" type="text" id="emp_joing_date"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Phone </label>
                                            <input class="form-control" value="" type="text" name="phone_no" id="emp_phone_no">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Company</label>
                                            <select class="select" name="company_id">
                                                <option value="1">Global Technologies</option>
            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Department <span class="text-danger">*</span></label>
                                            <select class="form-control" id="edit_depList" name="department_id">
                                                <option>Select Department</option>
                                                <?php if(isset($dep)): ?>
                                                    <?php $__currentLoopData = $dep; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Designation <span class="text-danger">*</span></label>
                                            <select class="select" name="designation_id" id="edit_designationList">
                                                <option value="">Select Designation</option>
                      
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive m-t-15">
                                    <table class="table table-striped custom-table">
                                        <thead>
                                            <tr>
                                                <th>Module Permission</th>
                                                <?php if(isset($emp_permissions)): ?>
                                                    <?php $__currentLoopData = $emp_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <th class="text-center"><?php echo e($ep->name); ?></th>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($modules)): ?>
                                            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($val->name); ?></td>
                                                    <?php if(isset($emp_permissions)): ?>
                                                    <?php $__currentLoopData = $emp_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td class="text-center">
                                                            <input class="permissionCheck" name="permission_modules[]" value="<?php echo e($val->id); ?>_<?php echo e($ep->id); ?>" type="checkbox">
                                                        </td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                   
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?> 
                                        </tbody>
                                    </table>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Employee Modal -->
            
            <!-- Delete Employee Modal -->
            <div class="modal custom-modal fade" id="delete_employee" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Employee</h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn deleteEmpCont" data-id="">Delete</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete Employee Modal -->
            
        </div>
        <!-- /Page Wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\orange\resources\views/employees.blade.php ENDPATH**/ ?>