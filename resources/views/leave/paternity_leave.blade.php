<div class="card leave-box" id="leave_paternity">
    <div class="card-body">
        <div class="h3 card-title with-switch">
            Paternity  <span class="subtitle">Assigned to male only</span>
            <div class="onoffswitch">
                <input type="checkbox"  name="paternity_active_status" @if(@$lt->paternity_active_status==1) checked  @endif  class="onoffswitch-checkbox" id="switch_paternity">
                <label class="onoffswitch-label" for="switch_paternity">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </div>
        </div>
        <div class="leave-item">
            <div class="leave-row">
                <div class="leave-left">
                    <div class="input-box">
                        <div class="form-group">
                            <label>Days</label>
                            <input type="number" min="1" value="{{ @$lt->paternity_days }}" name="paternity_days" class="form-control" disabled>
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