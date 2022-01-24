@extends('layout.mainlayout')
    @section('content')
        <div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Organizational Chart</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Organizational Chart</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                            <div id="tree"></div>
                                <script src="https://balkangraph.com/js/latest/OrgChart.js"></script>

                            <script>
                                var chart = new OrgChart(document.getElementById("tree"), {
                                    nodeBinding: {
                                        field_0: "name"
                                    },
                                    nodes: @json($employees)
                                });
                              
                                
                            </script>      
                    </div>
                </div>
            </div>
        </div>
    @endsection