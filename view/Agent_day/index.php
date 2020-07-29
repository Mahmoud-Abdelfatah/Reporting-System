<?php

 require_once '../../core/init.php';
$groups= $_SESSION['agent_group'];

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>



   <!-- style links -->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.9/css/bootstrap-select.css" />


  <!-- scripts -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.9/js/bootstrap-select.min.js"></script>
</head>
<!-- body -->
<body style="background-color: #DEDEDE;">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../../Clients/index.php">Customer Care</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">

    <ul class="nav navbar-nav ml-auto">
<?php 

    $user = $_SESSION['user_data'];

         if ($user[0]['role_name']=='Super Admin') {
           
             echo '<li class="nav-item dropdown " >
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Reporting
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="../../../CRM/controller/Report_controller.class.php?report=call_history">Call History</a>
              <a class="dropdown-item" href="#">Agent Daily</a>             
              <a class="dropdown-item" href="../../controller/Report_controller.class.php?report=queue_report">Queue</a>
              <a class="dropdown-item" href="../../controller/Report_controller.class.php?report=queue_report_interval">Queue_Interval</a> 
              <a class="dropdown-item" href="../../controller/Report_controller.class.php?report=calls_report">Calls</a> 
               <a class="dropdown-item" href="../../controller/Report_controller.class.php?report=all_queues_report">All Queues</a>
               <a class="dropdown-item" href="../../controller/Report_controller.class.php?report=login_report">Login</a>
               <a class="dropdown-item" href="../../controller/Report_controller.class.php?report=not_ready_report">Not Ready</a>                              
              </div>
              </li>
              ';
           }
 
      ?>
      <li class="nav-item">
        <a class="nav-link " href="../../Clients/index.php">Search</a>
      </li>
            <li class="nav-item dropdown " >

        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php

            echo $user[0]['user_name'];
          ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="../../controller/Auth_controller.class.php?status=logout">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<div class="container" >


<br>
<br>
<br>
<br>
<br>
<br>


<div class="row">
	<div class="col-md-8 offset-md-2 ">
<div class="card" style="border-color: #435d7d;">
  <div class="card-header" style="background-color: #435d7d; ">
    Report view
  </div>
  <div class="card-body" style="">
           <form action="../../controller/Report_controller.class.php" method="Post">
			<div class="row">

				<div class='col-sm-6'>
					<div class="form-group">
						<label>Start Date</label>
						<div class='input-group date' id='datetimepicker1'>
							<input type='text' class="form-control" name="Sdate" required />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>

				<div class='col-sm-6'>
					<div class="form-group">
						<label>End Date</label>
						<div class='input-group date' id='datetimepicker2'>
							<input type='text' class="form-control"  name="Edate" required />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>

			</div>
			<div class="row">
				<div class='col-sm-6'>
					<div class="form-group">
						<label>Group Name</label>
						<div class='input-group date' id='datetimepicker1'>
							<select class="selectpicker form-control" multiple data-live-search="true" name="group[]">
								<?php
                                   foreach ($groups as $group) {
                                   	 echo '<option value="'.$group['DBID'].'">'.$group['NAME'].'</option>';
                                   }
								?>

							</select >
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>



			</div>

			  <input type="submit" name="agent_day_submit" value="Submit" class="btn btn-primary" style="float: right">
			</form>
  </div>
</div>
</div>
</div>

         <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                	format: 'YYYY/MM/DD HH:mm:ss',
                });
               $('#datetimepicker2').datetimepicker({format: 'YYYY/MM/DD HH:mm:ss'});

            });

        </script>

    </body>

    </html>