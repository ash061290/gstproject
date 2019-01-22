<?php include('../attachment/session.php'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <!-- Main content -->
     <section class="content">
      <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua"">
              <div class="inner">
                <h3>10</h3>
                <p>Total Products</p>
              </div>
              <div class="icon" id="dash_icon">
                <i class="fa fa-usd f-s-40 color-primary"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>5</h3>
                <p>Total Paid Orders</p>
              </div>
              <div class="icon" id="dash_icon1">
                <i class="fa fa-shopping-cart f-s-40 color-success"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>10</h3>
                <p>Total Users</p>
              </div>
              <div class="icon" id="dash_icon2">
               <i class="fa fa-user f-s-40 color-danger"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>15</h3>
                <p>Total Stores</p>
              </div>
              <div class="icon" id="dash_icon3">
                
				<i class="fa fa-archive f-s-40 color-warning"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
		  <div class="row">
	  <section class="col-lg-8 connectedSortable">
		  <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Sale</a></li>
              <li><a href="#revenue-chart" data-toggle="tab">Purchase</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i>Order</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
          </div>
		  </section>
		  <section class="col-lg-4 connectedSortable">
		           <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Browser Usage</h3>
              <div class="box-tools pull-right">
               <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="mycanvas" height="160" width="205"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                    <li><i class="fa fa-circle-o text-green"></i> IE</li>
                    <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                    <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                    <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                    <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">United States of America
                  <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
                </li>
                <li><a href="#">China
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
              </ul>
            </div>
            <!-- /.footer -->
          </div>
		   </section>
		   </div>
        <!-- right col -->
		</section> 
      </div>
        <!-- /.row -->
    <!-- /.content -->

  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $(document).ready(function() {
      $("#dashboardMainMenu").addClass('active');
    }); 
  </script>
  <script>
     $(document).ready(function() {
     var ctx = $("#mycanvas").get(0).getContext("2d");
	 var data = [
	  {
	     value: 14,
		 color: "gray",
		 highlight: "gray",
		 label: "Obese"
	 },
	 {
	     value: 30,
		 color: "cornflowerblue",
		 highlight: "lightskyblue",
		 label: "Obese"
	 },
	 {
	     value: 90,
		 color: "red",
		 highlight: "red",
		 label: "Over-weight"
	 },
	 	 {
	     value: 90,
		 color: "green",
		 highlight: "green",
		 label: "Over-weight"
	 },
	 {
	     value: 80,
		 color: "darkorange",
		 highlight: "orange",
		 label: "Normal weight"
	 },
	  {
	     value: 85,
		 color: "cornflowerblue",
		 highlight: "blue",
		 label: "Normal weight"
	 }
	 ];
	 var piechart = new Chart(ctx).Doughnut(data);
    }); 
  var area = new Morris.Area({
    element   : 'revenue-chart',
    resize    : true,
    data      : [
      { y: '2011 Q1', item1: 2666, item2: 2666 },
      { y: '2011 Q2', item1: 2778, item2: 2294 },
      { y: '2011 Q3', item1: 4912, item2: 1969 },
      { y: '2011 Q4', item1: 3767, item2: 3597 },
      { y: '2012 Q1', item1: 6810, item2: 1914 },
      { y: '2012 Q2', item1: 5670, item2: 4293 },
      { y: '2012 Q3', item1: 4820, item2: 3795 },
      { y: '2012 Q4', item1: 15073, item2: 5967 },
      { y: '2013 Q1', item1: 10687, item2: 4460 },
      { y: '2013 Q2', item1: 8432, item2: 5713 }
    ],
    xkey      : 'y',
    ykeys     : ['item1', 'item2'],
    labels    : ['Item 1', 'Item 2'],
    lineColors: ['#a0d0e0', '#3c8dbc'],
    hideHover : 'auto'
  });
  </script>
