<?php

 require_once '../core/init.php';
 $monitor_data = $_SESSION['get_monitor_data'];

?>
<!DOCTYPE html>
<html>
<meta http-equiv="refresh" content="5;URL='../controller/Auth_controller.class.php?status=monitoring'" />

<head>
  <title></title>



   <!-- style links -->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">




  <!-- scripts -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>


</head>

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
              <a class="dropdown-item" href="../../controller/Report_controller.class.php?report=call_history">Call History</a>
              <a class="dropdown-item" href="../controller/Report_controller.class.php?report=agent_daily">Agent Daily</a>              
              <a class="dropdown-item" href="../controller/Report_controller.class.php?report=queue_report">Queue</a>
              <a class="dropdown-item" href="../controller/Report_controller.class.php?report=queue_report_interval">Queue_Interval</a>
               <a class="dropdown-item" href="../controller/Report_controller.class.php?report=calls_report">Calls</a> 
               <a class="dropdown-item" href="../controller/Report_controller.class.php?report=all_queues_report">All Queues</a>
               <a class="dropdown-item" href="../controller/Report_controller.class.php?report=login_report">Login</a>
               <a class="dropdown-item" href="../controller/Report_controller.class.php?report=not_ready_report">Not Ready</a>     

                                                          
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
          <a class="dropdown-item" href="../controller/Auth_controller.class.php?status=logout">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<body style="background-image: url(); height: 530px; /* You must set a specified height */
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; /* Resize the background image to cover the entire container */background-color: #DEDEDE;"
  >
<div class="container" >
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-primary">
<!--          <div class="panel-heading">
            <h3 class="panel-title">Call History</h3>
          </div> -->




<br>
 <table class="table table-hover"  >
  <thead>
    <tr>
      <th scope="col" style="text-align: center;" >Queue</th>  
      <th scope="col" style="text-align: center;" >Entered</th>  
      <th scope="col" style="text-align: center;" colspan="3">Distributed</th>
      <th scope="col" style="text-align: center;" colspan="3">Abandoned</th> 
      <th scope="col" style="text-align: center;" >Exit</th> 
      <th scope="col" style="text-align: center;" >SLA</th>                                                   
    </tr>
    <tr>
            <th  style="text-align: center;"><b></b></th>  
            <th  style="text-align: center;"><b></b></th>                 
            <th  style="text-align: center;"><b>Befor Timeout</b></th>
            <th  style="text-align: center;"><b>After Timeout</b></th>
            <th  style="text-align: center;"><b>Total</b></th>                         
            <th  style="text-align: center;"><b>Befor Timeout</b></th>
            <th  style="text-align: center;"><b>After Timeout</b></th> 
            <th  style="text-align: center;"><b>Total</b></th>             
            <th  style="text-align: center;"><b></b></th>  
            <th  style="text-align: center;"><b></b></th>                                 
    </tr>
  </thead>
  <tbody>

       <?php


$total_enterd=0;
$total_distrubuted_before_20=0;
$total_distrubuted_after_20=0;
$total_abendond_before_20=0;
$total_abendond_after_20=0;
$total_exite=0;
$sum_sla=0;
$total_sla=0;
$count =0;
 foreach ($monitor_data as $data) {
  if ($data) {
    
                 $row = explode(' ', $data);
                 
$distrubuter_per_queue = $row[2]+$row[3];
$abendond_per_queue =$row[4]+$row[5];
              echo '<tr>';
              echo '<td style="text-align: center;">'.$row[0].'</td>'; 
              echo '<td style="text-align: center;">'.$row[1].'</td>';              
              echo '<td style="text-align: center;">'.$row[2].'</td>';  
              echo '<td style="text-align: center;">'.$row[3].'</td>'; 
              echo '<td style="text-align: center;">'.$distrubuter_per_queue .'</td>';           
              echo '<td style="text-align: center;">'.$row[4].'</td>'; 
              echo '<td style="text-align: center;">'.$row[5].'</td>';
              echo '<td style="text-align: center;">'.$abendond_per_queue.'</td>';                 
              echo '<td style="text-align: center;">'.$row[6].'</td>';
              echo '<td style="text-align: center;">'.$row[7].'%'.'</td>';
$total_enterd+=$row[1];
$total_distrubuted_before_20+=$row[2];
$total_distrubuted_after_20+=$row[3];
$total_abendond_before_20+=$row[4];
$total_abendond_after_20+=$row[5];
$total_exite+=$row[6];
$sum_sla+=$row[7];
$count++;                                                                                        
              echo '</tr>';
  }


             } 
 $total_sla=round((($total_distrubuted_before_20+$total_abendond_before_20)/$total_enterd)*100,1);
 $total_distrbuted = ($total_distrubuted_before_20+$total_distrubuted_after_20 );
 $total_abendond = ($total_abendond_before_20+$total_abendond_after_20);    
             echo '<tr style="text-align: center;">';
             echo'<td><b>Total</b></td>';
             echo'<td><b>'.$total_enterd.'</b></td>';
             echo'<td><b>'.$total_distrubuted_before_20.'</b></td>';
             echo'<td><b>'.$total_distrubuted_after_20.'</b></td>';
             echo'<td><b>'.$total_distrbuted.'</b></td>';                         
             echo'<td><b>'.$total_abendond_before_20.'</b></td>';
             echo'<td><b>'.$total_abendond_after_20.'</b></td>';
             echo'<td><b>'.$total_abendond.'</b></td>';              
             echo'<td><b>'.$total_exite.'</b></td>';
             echo'<td><b>'.$total_sla.'%</b></td>';                          
             echo'</tr>';           

       //   header('Refresh: 5;url=../controller/Auth_controller.class.php');
       ?>

  </tbody>
</table>
</div>
</div>
</div>
</div>
</body>
</html>