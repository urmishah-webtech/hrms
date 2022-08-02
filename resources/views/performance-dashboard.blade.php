@extends('layout.mainlayout')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Performance Dashboard </h3>
                    
                </div>
            </div>
        </div>
          
			@if(auth::user()->role_id ==  1 || auth::user()->role_id == 5)
			<div class="col-md-12 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Employes To Be Reviewed </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>First Name </th>
                                        <th>Last Name </th>
                                        <th>Performance Date</th> 
                                        <th>Status</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>   
                                <tbody>
                                    @isset($manger_emp) 
                                    @foreach ($manger_emp as $item) 
                                    <tr>  
                                        <td>  
                                            <h2>{{ @$item->first_name }}</h2>
                                        </td>
										<td>  
                                            <h2>{{ @$item->last_name }}</h2>
                                        </td> 
                                        <td>{{@$item->perfomance_date}}</td>
										<td>@if($item->complete_perfomance_by_hr == 2 ) Reject @else Accept @endif</td>
										<td>
											<div class="">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item edtEmpBtn" href="edit-performance/{{@$item->id}}/{{@$item->perfomance_date}}"    data-id="{{ @$val->id }}" ><i class="fa fa-pencil m-r-5"></i> Change Status</a>
													<a class="dropdown-item delEmpBtn" href="edit-performance-view/{{@$item->id}}/{{@$item->perfomance_date}}"  data-id="{{ @$val->id }}"><i class="fa fa-eye m-r-5"></i> View Details </a>
												</div>
											</div>
										</td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                     
                </div>
            </div>
			<!-- Accepted -->
			<div class="col-md-12 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Employeed Perfomence Accepted</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>First Name </th>
                                        <th>Last Name </th>
                                        <th>Performance Date</th> 
                                        <th>Status</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>   
                                <tbody>
                                    @isset($accept_emp) 
                                    @foreach ($accept_emp as $item) 
                                    <tr>  
                                        <td>  
                                            <h2>{{ @$item->first_name }} </h2>
                                        </td>
										<td>  
                                            <h2>{{ @$item->last_name }}</h2>
                                        </td> 
                                        <td>{{@$item->perfomance_date}}</td>
										<td>@if($item->complete_perfomance_by_hr == 2 ) Reject @else Accept @endif</td>
										<td>
											<div class="">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item edtEmpBtn" href="edit-performance/{{@$item->id}}/{{@$item->perfomance_date}}"    data-id="{{ @$val->id }}" ><i class="fa fa-pencil m-r-5"></i> Change Status</a>
													<a class="dropdown-item delEmpBtn" href="edit-performance-view/{{@$item->id}}/{{@$item->perfomance_date}}"  data-id="{{ @$val->id }}"><i class="fa fa-eye m-r-5"></i> View Details </a>
												</div>
											</div>
										</td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                     
                </div>
            </div>
			<!-- Rejected  -->
			<div class="col-md-12 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Employeed Perfomence Rejected </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>First Name </th>
                                        <th>Last Name </th>
                                        <th>Performance Date</th> 
                                        <th>Status</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>   
                                <tbody>
                                    @isset($reject_emp) 
                                    @foreach ($reject_emp as $item) 
                                    <tr>  
                                        <td>  
                                            <h2>{{ @$item->first_name }}</h2>
                                        </td>
										<td>  
                                            <h2>{{ @$item->last_name }}</h2>
                                        </td> 
                                        <td>{{@$item->perfomance_date}}</td>
										<td>@if($item->complete_perfomance_by_hr == 2 ) Reject @else Accept @endif</td>
										<td>
											<div class="">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item edtEmpBtn" href="edit-performance/{{@$item->id}}/{{@$item->perfomance_date}}"    data-id="{{ @$val->id }}" ><i class="fa fa-pencil m-r-5"></i> Change Status</a>
													<a class="dropdown-item delEmpBtn" href="edit-performance-view/{{@$item->id}}/{{@$item->perfomance_date}}"  data-id="{{ @$val->id }}"><i class="fa fa-eye m-r-5"></i> View Details </a>
												</div>
											</div>
										</td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                     
                </div>
            </div>
			@endif
			
			
			@if(Auth::user()->role_id == 2)
			<div class="col-md-12 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Employess To Be Reviewed</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>First Name </th>
                                        <th>Last Name </th>
                                        <th>Performance Date</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($pending_emp)
                                    @foreach ($pending_emp as $item)
                                    <tr>
                                        <td>  
                                            <h2>{{ @$item->first_name }}</h2>
                                        </td>
										<td>  
                                            <h2>{{ @$item->last_name }}</h2>
                                        </td>
                                        <td>{{@$item->perfomance_date}}</td>

                                         
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                     
                </div>
            </div>
			<div class="col-md-12 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Employess Reviewed Completed</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>First Name </th>
                                        <th>Last Name </th>
                                        <th>Performance Date</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($reviewed_emp)
                                    @foreach ($reviewed_emp as $item)
                                    <tr>
                                        <td>  
                                            <h2>{{ @$item->first_name }}</h2>
                                        </td>
										<td>  
                                            <h2>{{ @$item->last_name }}</h2>
                                        </td>
                                        <td>{{@$item->perfomance_date}}</td> 
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                     
                </div>
            </div>
			@endif
            </div>
		</div> 

</div>
 
<style>
.dropdown-toggle::after{display:none;}
</style>
 
@endsection
