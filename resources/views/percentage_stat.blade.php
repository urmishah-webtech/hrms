<div class="row">
    <div class="col-md-12">
        <div class="card-group m-b-30">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">New Employees</span>
                            <span class="d-block">(this month)</span>

                        </div>
                        <div>
                            <span @if($emp_per>=0) class="text-success" @else class="text-danger" @endif>{{ @$emp_per }}%</span>
                        </div>
                    </div>
                    <h3 class="mb-3">{{ @$current_month_emp_count }}</h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <?php
                        $per=$emp_per>=0?$emp_per:2;
                        ?>
                        <div class="progress-bar @if($emp_per>=0) bg-primary @else bg-danger @endif" role="progressbar" style="width: {{ $per }}%;" aria-valuenow="{{ @$emp_per }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0">Overall Employees <span class="text-muted">{{ $emp_total }}</span></p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">Promotions</span>
                        </div>
                        <div>
                            <span class="text-success"><?php $promotion_percent = (count($promotion_month)/100)*100; ?>{{$promotion_percent}}%</span>
                        </div>
                    </div>
                    <h3 class="mb-3">{{@count($promotion_month)}}</h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{$promotion_percent}}%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0">Previous Month <span class="text-muted">{{@count($promotion_previousmonth)}}</span></p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">Expenses</span>
                        </div>
                        <div>
                            <span class="text-danger">-2.8%</span>
                        </div>
                    </div>
                    <h3 class="mb-3">$8,500</h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0">Previous Month <span class="text-muted">$7,500</span></p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">Resignation</span>
                        </div>
                        <div>
                            <span class="text-danger">{{ @$resi_per }}%</span>
                        </div>
                    </div>
                    <?php
                    $per=$resi_per<=0?$resi_per:2;
                    ?>
                    <h3 class="mb-3">{{ @$current_month_resi_count }}</h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar @if($resi_per<=0) bg-primary @else bg-danger @endif" role="progressbar" style="width: {{ @$per }}%;" aria-valuenow="{{ @$resi_per }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0">Previous Month <span class="text-muted">{{ @$last_month_resi_count }}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
