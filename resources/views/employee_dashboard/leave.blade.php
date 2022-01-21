<div class="row">

    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Leave Calendar</h3>
                <div class="card card-transparent p-4" role="tabpanel">
                    <div class="tab-content p-0 bg-white">
                        <div class="tab-pane active home_calendar" id="home" role="tabpanel">
                            <div class="response"></div>
                            <div id='calendar1'></div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card flex-fill">
            <div class="card-body">
                <h3 class="card-title">My leaves</h3>
                @isset($on_leave_data)
                @foreach($on_leave_data as $val)
                <div class="leave-info-box">
                    <div class="media align-items-center">

                    </div>
                    <div class="row align-items-center mt-3">
                        <div class="col-6">
                            <h6 class="mb-0">{{ $val->from_date }} - {{$val->to_date}}</h6>
                            <span class="text-sm text-muted">Leave Date</span>
                        </div>
                        <div class="col-6 text-right">
                            <span class="badge bg-inverse-danger">
                            @if(@$val->status==1)Pending
                            @elseif(@$val->status==2)Approved
                            @else Disapproved @endif</span>
                        </div>
                    </div>
                </div>
                @endforeach
                @endisset
                <div class="load-more text-center">
                    <a class="text-dark" href="{{ url('leaves') }}">Load More</a>
                </div>
            </div>
        </div>
    </div>
</div>
