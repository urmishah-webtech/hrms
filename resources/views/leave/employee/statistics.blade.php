<div class="row">
    <div class="col-md-3">
        <div class="stats-info">
            <h6>Annual Leave</h6>
            <h4>{{ @$lt->annual_days }}</h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-info">
            <h6>Medical Leave</h6>
            <h4>{{ @$lt->sick_days }}</h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-info">
            <h6>Hospitalisation</h6>
            <h4>{{ @$lt->hospitalisation_days }}</h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-info">
            <h6>Remaining Leave</h6>
            <h4>{{ @$remaining_leaves }}</h4>
        </div>
    </div>
</div>