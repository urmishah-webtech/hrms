@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">

            <!-- Page Content -->
            <div class="content">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Notifications</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Notifications</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="activity">
                            <div class="activity-box">
                                <ul class="activity-list">
                                    @foreach ($notifications as $note)
                                    <li>
                                        <div class="activity-user">
                                            <a href="{{route('profile_details', $note->employeeid)}}" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                                <img src="img/profiles/avatar-01.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="activity-content">
                                            <div class="timeline-content">
                                                <a href="profile" class="name"></a> {{$note->message}}
                                            <?php $note_time = date('Y-m-d', strtotime($note->created_at)); ?>
                                                <span class="time">@if ($note_time == date('Y-m-d'))
                                                    {{date('H:i', strtotime($note->created_at))}}
                                                @else
                                                    {{date('d-m-Y H:i', strtotime($note->created_at))}}
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Wrapper -->
@endsection
