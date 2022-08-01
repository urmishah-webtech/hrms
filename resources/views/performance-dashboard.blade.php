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
                                    </tr>
                                </thead>   
                                <tbody>
                                    @isset($manger_emp) 
                                    @foreach ($manger_emp as $item) 
                                    <tr>  
                                        <td>  
                                            <h2><a href="edit-performance/{{@$item->id}}/{{@$item->perfomance_date}}">{{ @$item->first_name }} </a></h2>
                                        </td>
										<td>  
                                            <h2><a href="{{route('profile_details', @$item->id)}}">  {{ @$item->last_name }}</a></h2>
                                        </td> 
                                        <td>{{@$item->perfomance_date}}</td>
										<td>@if($item->complete_perfomance_by_hr == 2 ) Reject @else Accept @endif</td>
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
                                            <h2><a href="edit-performance/{{@$item->id}}/{{$item->perfomance_date}}">{{ @$item->first_name }} </a></h2>
                                        </td>
										<td>  
                                            <h2><a href="{{route('profile_details', @$item->id)}}">  {{ @$item->last_name }}</a></h2>
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
 
 
<script>

</script>
@endsection
