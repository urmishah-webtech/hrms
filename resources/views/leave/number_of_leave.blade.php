<br>
<div class="card leave-box" id="">
    <div class="card-body">
        <div class="h3 card-title with-switch">
            Annual leave  <span class="subtitle"></span>
        </div>
        <div class="leave-item">
            <div class="leave-row">
                <div class="leave-left">
                    <div class="input-box">
                        <div class="form-group">
                            <label>Days</label>
                            <input type="number" min="1" value="{{ @$lt->annual_leave }}" name="annual_leave" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="leave-right">
                    <button class="leave-edit-btn">
                        Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card leave-box" id="">
    <div class="card-body">
        <div class="h3 card-title with-switch">
            Medical leave  <span class="subtitle"></span>
        </div>
    </div>
</div>
<div class="card leave-box" id="">
    <div class="card-body">
        <div class="h3 card-title with-switch">
            Other leave  <span class="subtitle"></span>
        </div>
    </div>
</div>