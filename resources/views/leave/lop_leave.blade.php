<div class="card leave-box mb-0" id="leave_custom01">
    <div class="card-body">
        <div class="h3 card-title with-switch">
            LOP 											
            <div class="onoffswitch">
                <input type="checkbox" name="lop_active_status" @if(@$lt->lop_active_status==1) checked  @endif  class="onoffswitch-checkbox" id="switch_custom01" checked>
                <label class="onoffswitch-label" for="switch_custom01">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </div>
            {{-- <button class="btn btn-danger leave-delete-btn" type="button">Delete</button> --}}
        </div>
        <div class="leave-item">
        
            <!-- Annual Days Leave -->
            <div class="leave-row">
                <div class="leave-left">
                    <div class="input-box">
                        <div class="form-group">
                            <label>Days</label>
                            <input type="number" min="1" value="{{ @$lt->lop_days }}" name="lop_days" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="leave-right">
                    <button class="leave-edit-btn">Edit</button>
                </div>
            </div>
            <!-- /Annual Days Leave -->
            
            <!-- Carry Forward -->
            <div class="leave-row">
                <div class="leave-left">
                    <div class="input-box">
                        <label class="d-block">Carry forward</label>
                        <div class="leave-inline-form">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @if(@$lt->lop_carry_fwd==0) checked @endif  type="radio" name="lop_carry_fwd" id="carry_no_01" value="0" disabled>
                                <label class="form-check-label" for="carry_no_01">No</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @if(@$lt->lop_carry_fwd==1) checked @endif type="radio" name="lop_carry_fwd" id="carry_yes_01" value="1" disabled>
                                <label class="form-check-label" for="carry_yes_01">Yes</label>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Max</span>
                                </div>
                                <input type="number" min="1" value="{{ @$lt->annual_max }}" name="lop_max"  class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="leave-right">
                    <button class="leave-edit-btn">
                        Edit
                    </button>
                </div>
            </div>
            <!-- /Carry Forward -->
            
            <!-- Earned Leave -->
            <div class="leave-row">
                <div class="leave-left">
                    <div class="input-box" style="display: none">
                        <label class="d-block">Earned leave</label>
                        <div class="leave-inline-form">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" disabled>
                                <label class="form-check-label" for="inlineRadio1">No</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" disabled>
                                <label class="form-check-label" for="inlineRadio2">Yes</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="leave-right">
                    <button class="leave-edit-btn">
                        Edit
                    </button>
                </div>
            </div>
            <!-- /Earned Leave -->
            
        </div>
        
        <!-- Custom Policy -->
        <div class="custom-policy">
            <div class="leave-header">
                <div class="title">Custom policy</div>
                <div class="leave-action">
                    <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#add_custom_policy"><i class="fa fa-plus"></i> Add custom policy</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-nowrap leave-table mb-0">
                    <thead>
                        <tr>
                            <th class="l-name">Name</th>
                            <th class="l-days">Days</th>
                            <th class="l-assignee">Assignee</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>5 Year Service </td>
                            <td>5</td>
                            <td>
                                <a href="#" class="avatar"><img alt="" src="img/profiles/avatar-02.jpg"></a>
                                <a href="#">John Doe</a>
                            </td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#edit_custom_policy"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#delete_custom_policy"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /Custom Policy -->
        
    </div>
</div>