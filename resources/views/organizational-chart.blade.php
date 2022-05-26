@extends('layout.mainlayout')
    @section('content')
    <style>
.dtree-wrapper *{
  box-sizing: border-box;
}
.dtree-wrapper{
  position: relative;
  text-align: center;
  overflow: auto;
  padding: 10px;
  transition: 0.3s all ease;
}
.dtree-node-wrapper {
}
.dtree-node-cell {
  position: relative;
  text-align: center;
  z-index: 8;
  display: inline-block;
  white-space: nowrap;
  vertical-align: top;
  transition: 0.3s all ease;
}
.dtree-node{
  text-align: center;
  display: inline-block;
  padding: 10px 10px 20px 10px;
  box-shadow: 0px 0px 8px -2px #888;
}
.dtree-node-main{
  width: 100%;
  position: relative;
  /*padding-top: 1px;*/
}
.dtree-node .dtree-img img{
  max-width: 100%;
  max-width: 90px;
  border-radius: 50px;
  font-size: 0;
}
.dtree-node .dtree-branch{
  position: absolute;
  height: 1px;
  z-index: -1;
}
.dtree-node .dtree-branch.linex{
  width: 50%;
  right: 0;
  bottom: calc(100% - 1px);
  border-top: 1px solid #777;

}
.dtree-node .dtree-branch.liney{
  top: 0;
  height: 100%;
  left: 50%;
  width: 1px;
  border-left: 1px solid #777;
}
.dtree-child-container{
  position: relative;
  overflow: hidden;
  transition: 0.3s all ease;
  /*height: 100%;*/
}
.node-collapse {
  position: absolute;
  bottom: 0;
  background: white;
  color: #333;
  border: 1px solid #ccc;
  border-radius: 50%;
  left: calc(50% - 15px);
  width: 30px;
  height: 30px;
  font-size: 30px;
  line-height: 25px;
  cursor: pointer;
}
.node-collapse:after{
  content: "-";
}
.dtree-collapsed  .node-collapse:after{
  content: "+";
}
.dtree-collapsed.dtree-node .dtree-branch.liney{
  height: 50% !important;
}
.dtree-target-collapsed{
  opacity: 0;
  width: 0;
  height: 0;
  transform: scale(0) translateY(-100%)
}

.dtree-x .dtree-target-collapsed{
  transform: scale(0)  translateX(-100%)
}
.dtree-x .dtree-node-cell{
  text-align: left;
  display: block;
}
.dtree-x .dtree-child-container,
.dtree-x .dtree-node-main{
  display: inline-block;
  vertical-align: middle;
  width: auto;
}
.dtree-x .dtree-branch.linex{
  position: absolute;
  height: 1px;
  z-index: -1;
  right: auto;
  top: auto;
  left: 0;
  border: none;
  border-left: 1px solid #777;
}
.dtree-x .dtree-node .dtree-branch.liney{
  width: 100%;
  top: 50%;
  left: 0;
  border: none;
  border-top: 1px solid #777;
}
.dtree-x .node-collapse{
  bottom: auto;
  left: auto;
  right: 10px;
  top: calc(50% - 15px);
}

.dtree-x  .dtree-collapsed.dtree-node .dtree-branch.liney{
  height: auto !important;
  width : 50% !important;
}

.dtree-searchbox {
  max-width: 200px;
  text-align: left;
  position: relative;
  z-index: 11;
  background-color: white;
  display: none;
}
.dtree-search-icon {
  position: relative;
  display: inline-block;
  vertical-align: top;
  background-color: #eee;
  width: 25px;
  height: 25px;
  border: 1px solid #ccc;
}
.dtree-search-icon:before{
  content: "";
  position: absolute;
  top: 5px;
  left: 5px;
  width: 10px;
  height: 10px;
  border: 1px solid black;
  border-radius: 50%;
}
.dtree-search-icon:after{
  content: "";
  position: absolute;
  top: 11px;
  left: 15px;
  width: 1px;
  height: 10px;
  border-left: 2px solid black;
  border-radius: 50%;
  transform: rotate(-45deg);
}
input.dtree-search-control {
  display: inline-block;
  vertical-align: top;
  border: 1px solid #ccc;
  padding: 0 5px;
  width: calc(100% - 25px);
}
.dtree-search-list {
  padding: 0;
  margin: 0;
  display: block;
  position: absolute;
  overflow: auto;
  top: 100%;
  left: 0;
  width: 100%;
  z-index: 99;
  background-color: white
}
.dtree-search-list li{
  padding : 5px 10px;
  border: 1px solid #ccc;
  border-top: none;
}
.dtree-search-list li:hover{
  background-color: #eee; 

}
/* basic template*/
.dtree-img,.dtree-name{
  display: inline-block;
  vertical-align: middle;
}
.dtree-node{
  background: white;
  border: 1px solid #ccc;
  border-top: 2px solid #2196f3;
  box-shadow: 0px 1px 10px -4px #999;
}
.dtree-name{
  font-size: 16px;
  font-weight: 600;
  /* width: calc(100% - 90px); */
  padding: 10px;
  text-transform: capitalize;
  text-align: left
}
.dtree-name .sub{
  display: block;
  font-weight: 400;
  color: #555;
  font-size: 13px;
}

    </style>
                                

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
                    </div>
                </div>
                <input type="hidden" id="treedata" value="{{$employees}}">
                <div id="ochart"></div>
            </div>
        </div>

    @endsection
    <script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
    <script type="text/javascript">

        var chart = new OrgChart(document.getElementById("tree"), {
            nodeBinding: {
                field_0: "name"
            },
            nodes: @json($employees)
        });
        
    </script>