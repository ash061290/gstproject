<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Samsung Smart Plaza</title>
  <?php include("link_css.php")?>

</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
<?php include("../attachment/header.php")?>
<?php include("../attachment/sidebar.php")?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	   <div class="col-lg-8">
	   <h4>&nbsp;&nbsp;&nbsp;&nbsp;Sales Activity</h4>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
		 
          <div class="small-box" style="padding:15px; background-color:#fff;">
           <center><p style="font-size:20px;"><span style="color:red;">0</span></p></center>
		   <center><p style="font-size:20px;"><span style="color:red;">Qty</span></p></center>
			
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
           <div class="small-box" style="padding:15px; background-color:#fff;">
           <center><p style="font-size:20px;"><span style="color:green;">0</span></p></center>
		   <center><p style="font-size:20px;"><span style="color:green;">Pkgs</span></p></center>
			
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
           <div class="small-box" style="padding:15px; background-color:#fff;">
           <center><p style="font-size:20px;"><span style="color:green;">0</span></p></center>
		   <center><p style="font-size:20px;"><span style="color:green;">Pkgs</span></p></center>
			
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
         
            <div class="small-box" style="padding:15px; background-color:#fff;">
           <center><p style="font-size:20px;"><span style="color:brown;">0</span></p></center>
		   <center><p style="font-size:20px;"><span style="color:brown;">Qty</span></p></center>
			
          </div>
        </div>
		</div>
		 <div class="col-lg-4">
		 <h4>&nbsp;&nbsp;Inventory Summary</h4>
		 <div class="">
          <!-- small box -->
         
            <div style="padding:2px; background-color:#fff;">
           <p style="font-size:15px;">&nbsp;&nbsp;QUANTITY IN HAND&nbsp;&nbsp;<span style="color:red;float:right;">&nbsp;&nbsp;&nbsp;&nbsp;0</span></p></div><br>
		   <div style="padding:2px; background-color:#fff;">
           <p style="font-size:15px;">&nbsp;&nbsp;QUANTITY TO BE RECEIVED&nbsp;&nbsp;<span style="color:red;float:right;">&nbsp;&nbsp;&nbsp;&nbsp;0</span></p></div>
			 </div>
          
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
	  <br>
     
	  <!-------------------------------product details---------------->
	   <div class="row">
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">PRODUCT DETAILS</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row invoice-info">
        <div class="col-sm-8 invoice-col">
		<table class="table table-striped">
         
			<tr>
              <th>Low Stock Items</th>
              <th>0</th>
			  </tr>
			  <tr>
              <th>All Item Group</th>
              <th>0</th>
              </tr>
			  <tr>
              <th>All Items</th>
              <th>0</th>
              </tr>
           
		   </table>
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
         <div class="col-sm-4 invoice-col">
          <p style="font-size:20px;"><span style="color:red;">Active</span></p>
		 
          
        </div>
        <!-- /.col -->
      </div>
             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (left) -->
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">TOP SELLING ITEMS</h3>
			  <div class="btn-group" style="float:right;">
			  <button  type="button" class="btn btn-default" style="margin-left:8px;">This Month</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Another action</a></li>
                  </ul>
				  </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <p> No items were invoiced in this time frame</p>
            </div>
          </div>
        </div>
      </div>
	   <!-------------------------------product details---------------->
     </section>
     
    <section class="content">
     
	  <!-------------------------------PURCHASE details---------------->
	   <div class="row">
        <div class="col-md-4">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">PURCHASE ORDER</h3>
			   <div class="btn-group" style="float:right;">
			  <button  type="button" class="btn btn-default" style="margin-left:8px;">This Month</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Another action</a></li>
                  </ul>
				  </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row invoice-info">
        <div class="invoice-col">
		<center><p style="font-size:15px;"><span style="color:#000;">Quantity Ordered</span></p></center>
		   <center><p style="font-size:20px;"><span style="color:red;">0</span></p></center>
        </div>
		<hr>
		<center><p style="font-size:15px;"><span style="color:#000;">Total Cost</span></p></center>
		   <center><p style="font-size:20px;"><span style="color:red;">Rs.0.00</span></p></center>
        
       </div>
           </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (left) -->
        <div class="col-md-8">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">SALES ORDER</h3>
			  <div class="btn-group" style="float:right;">
			  <button  type="button" class="btn btn-default">This Month</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Another action</a></li>
                  </ul>
				  </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Channel</th>
              <th>Draft</th>
              <th>Confirmed</th>
              <th>Packed</th>
			  <th>Shipped</th>
			  <th>Invoiced</th>
             
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
              <td>Call of Duty</td>
              <td>455-981-221</td>
              <td>$64.50</td>
			  <td>455-981-221</td>
              <td>$64.50</td>
            </tr>
			
           
            
            </tbody>
          </table>
        </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      </div>
	   <!-------------------------------PURCHASE details---------------->
     </section>
	   <!-- Main content -->
      <!-- Main content -->
    
   
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("link_js.php")?>
</body>
</html>