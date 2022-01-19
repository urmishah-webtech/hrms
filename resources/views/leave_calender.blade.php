@extends('layout.mainlayout')
@section('content')
<link rel="stylesheet" href="{{asset('css/fullcalendar.min.css')}}"/>
<script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/fullcalendar.min.js')}}"></script>
<div class="content-wrapper">
    <div class="content-heading">
       <div class="heading">{{__('Events')}} </div>
          <div class="ml-auto">
        
       </div>
    </div>
 
    <div class="card card-transparent p-4" role="tabpanel">
       <div class="tab-content p-0 bg-white">
          <div class="tab-pane active" id="home" role="tabpanel">
             <div class="row p-4">
                <div class="col-sm-12">
                   <div class="container">
                      <div class="response"></div>
                      <div id='calendar1'></div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <script>
    $(document).ready(function () {
       var SITEURL = "{{url('/')}}";
       $.ajaxSetup({
          headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
       });
       var calendar = $('#calendar1').fullCalendar({
          events: SITEURL + "/leave_render",  
          eventRender: function (event, element, view) {
               if (event.allDay === 'true') {
                  event.allDay = true;
               } else {
                  event.allDay = false;
               }
            },
           
       });
    });
  
 </script>
@endsection		