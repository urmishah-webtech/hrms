@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Holidays</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Holidays</li>
                            </ul>
                        </div>
                        <div class="col cal-icon calendar-view"></div>
                        @if(Auth::user()->role_id==1 || Auth::user()->role_id == 5)
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> Add Holiday</a>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                     <div id="calendar" style="display: none;"></div>
                 </div>
                </div>
                <!-- /Page Header -->
                
               

                <div class="faq-card">
                    @if($holidays)
                    @foreach($holidays as $key=>$holiday)
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <a @if($key !== now()->year) class="collapsed" @endif data-toggle="collapse" href="#collapse{{$key}}">Holidays {{$key}}</a>
                            </h4>
                        </div>
                        <div id="collapse{{$key}}" class="card-collapse collapse @if($key == now()->year) show  @endif">
                            <div class="card-body">
                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped custom-table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title </th>
                                                        <th>Holiday Date</th>
                                                        <th>Day</th>
                                                        @if(Auth::user()->role_id==1 || Auth::user()->role_id == 5)
                                                        <th class="text-right">Action</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($holiday as $key1=>$day)
                                                    <tr @if($day['date'] > now()) class="holiday-upcoming" @else class="holiday-completed" @endif>
                                                        <td>{{$key1 +1}}</td>
                                                        <td>{{$day['name']}}</td>
                                                        <td>{{ date('d M Y', strtotime($day['date'])) }}</td>
                                                        <td>{{ date('l', strtotime($day['date'])) }}</td>
                                                        @if(Auth::user()->role_id==1 || Auth::user()->role_id == 5)
                                                        <td>
                                                            @if($day['date'] > now())
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a id="editForm" class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_holiday" data-id="{{$day['id']}}" data-name="{{$day['name']}}" data-date="{{$day['date']}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                    <a id="deleteForm" class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_holiday" data-id="{{$day['id']}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    No Holidays yet!!
                    @endif
                    
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Add Holiday Modal -->
            <div class="modal custom-modal fade" id="add_holiday" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Holiday</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('holiday.save')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Holiday Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name">
                                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Holiday Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date"></div>
                                    @error('date')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Holiday Modal -->
            
            <!-- Edit Holiday Modal -->
            <div class="modal custom-modal fade" id="edit_holiday" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Holiday</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('holiday.update')}}">
                                @csrf
                                <input type="hidden" name="id" id="id" />
                                <div class="form-group">
                                    <label>Holiday Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" id="name">
                                </div>
                                <div class="form-group">
                                    <label>Holiday Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date" id="date"></div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Holiday Modal -->

            <!-- Delete Holiday Modal -->
            <div class="modal custom-modal fade" id="delete_holiday" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Holiday</h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a id="delete_url" href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
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
            <!-- /Delete Holiday Modal -->

        </div>
        <!-- /Page Wrapper -->

@endsection
<script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript">
        $(document).ready(function () {
            $('.datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'en'
            });
        

        $('body').on('click', '#editForm', function (event) {

            event.preventDefault();
            var name = $(this).data('name'), date = $(this).data('date'), id = $(this).data('id');
            $('#id').val(id);
            $('#name').val(name);
            $('#date').val(date);
           
        });

        $('body').on('click', '#deleteForm', function (event) {

            event.preventDefault();
            var id = $(this).data('id');
            $('#delete_url').attr("href", '/delete-holiday/'+id); 
           
        });
        $('body').on('click', '.calendar-view', function (event) {

            event.preventDefault();
            $('#calendar').toggle(); 
           
        });
});



</script>