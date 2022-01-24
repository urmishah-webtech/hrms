<div class="row">    
    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Experience</h3>
                <hr> 
                <div class="experience-box">
                    <ul class="experience-list">
                        @if (!empty($promotiondata))
                            @foreach ($promotiondata as $key =>  $promotions)
                                @if ($key == 0)
                                <li>
                                    <div class="experience-user">
                                        <div class="before-circle"></div>
                                    </div>
                                    <div class="experience-content">
                                        <div class="timeline-content">
                                            <a href="#/" class="name">{{optional($promotions->desfrom)->name}} at {{optional(optional($promotions->employee)->getcompany)->company_name}}</a>
                                            <span class="time">{{date('d F, Y', strtotime(optional($promotions->employee)->joing_date))}} - {{date('d F, Y', strtotime($promotions->date))}}</span>
                                        </div>
                                    </div>
                                </li>
                                @endif
                                <li>
                                    <div class="experience-user">
                                        <div class="before-circle"></div>
                                    </div>
                                    <div class="experience-content">
                                        <div class="timeline-content">
                                            <a href="#/" class="name">{{optional($promotions->desto)->name}} at {{optional(optional($promotions->employee)->getcompany)->company_name}}</a>
                                            <span class="time">{{date('d F, Y', strtotime($promotions->date))}} - @if(!empty($promotiondata[$key+1])) {{date('d F, Y', strtotime($promotiondata[$key+1]->date))}}  @else Present  @endif</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                        <li>
                            <div class="experience-user">
                                <div class="before-circle"></div>
                            </div>
                            <div class="experience-content">
                                <div class="timeline-content">
                                    <a href="#/" class="name">{{Auth::user()->destination->name}} </a>
                                    <span class="time">{{date('d F, Y', strtotime(Auth::user()->joining_date))}} Present </span>
                                </div>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Performance</h3>
                <div class="card card-transparent p-4" role="tabpanel">
                    <div class="tab-content p-0 bg-white">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <p>Personal Excellence  <span class="">{{ @$personal_excellence->total_percentage_manager }} %</span></p>
                            <div class="grade-span">
                                <h4>Grade</h4>
                                <span class="badge bg-inverse-danger">Below 65 Poor</span> 
                                <span class="badge bg-inverse-warning">65-74 Average</span> 
                                <span class="badge bg-inverse-info">75-84 Satisfactory</span> 
                                <span class="badge bg-inverse-purple">85-92 Good</span> 
                                <span class="badge bg-inverse-success">Above 92 Excellent</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>