<div id="change_info_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Personal Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update_employee') }}" method="post">
                @csrf
                    <input type="hidden" name="id" value="@if(isset($emp_profile)){{$emp_profile->id}}@endif" id="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Firstname <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$emp_profile->first_name}}" name="first_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lastname <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$emp_profile->last_name}}" name="last_name">
                            </div>
                        </div>
                      
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Phone number <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" value="{{$emp_profile->phone_no}}" name="phone_no">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>password<span class="text-danger">*</span></label>
                                <input class="form-control" value="" type="password" autocomplete="off" name="password" placeholder="*****">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm Password<span class="text-danger">*</span></label>
                                <input class="form-control" value="" type="password" name="confirm_password">
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>