<?php 

    require_once '../../core/init.php';
 $group_data=$_SESSION['get_group_report_data'];

?>
<!DOCTYPE html>
<html>
<head>


  <title></title>
   
       <!-- style links -->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../styless/TableExport-master/src/stable/css/tableexport.css"> 



   <!-- scripts -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>  
	<script src="../styless/jquery-3.4.1.min.js"></script>
	<script src="../styless/Blob.js-master/Blob.js"></script>
	<script src="../styless/js-xlsx-master/xlsx.core.js"></script>
	<script src="../styless/FileSaver.js-master/FileSaver.js"></script>
    <script src="../styless/TableExport-master/src/stable/js/tableexport.js"></script>
        <script type="text/javascript">
    $( document ).ready(function() {
    	$("table").tableExport({
  headings: true,                    // (Boolean), display table headings (th/td elements) in the <thead>
  bootstrap: false,                   // (Boolean), style buttons using bootstrap
    footers: true,                     // (Boolean), display table footers (th/td elements) in the <tfoot>
    formats: ["xlsx", "csv", "txt"],    // (String[]), filetypes for the export
    fileName: "id",                    // (id, String), filename for the downloaded file
    
    position: "top",                 // (top, bottom), position of the caption element relative to table
    ignoreRows: null,                  // (Number, Number[]), row indices to exclude from the exported file(s)
    ignoreCols: null,                  // (Number, Number[]), column indices to exclude from the exported file(s)
    ignoreCSS: ".tableexport-ignore",  // (selector, selector[]), selector(s) to exclude from the exported file(s)
    emptyCSS: ".tableexport-empty",    // (selector, selector[]), selector(s) to replace cells with an empty string in the exported file(s)
    trimWhitespace: false              // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s)

});
});

    </script>
</head>
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
              <a class="dropdown-item" href="../../../controller/Report_controller.class.php?report=call_history">Call History</a>
              <a class="dropdown-item" href="../../controller/Report_controller.class.php?report=agent_daily">Agent Daily</a>             
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
   	<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
<!-- 					<div class="panel-heading">
						<h3 class="panel-title">Call History</h3>
					</div> -->




<br>
 <table class="table table-hover"  >
  <thead>
    <tr>
      <th scope="col" style="text-align: center;" >From - To</th>  
      <th scope="col" style="text-align: center;" >Agent ID</th> 
      <th scope="col" style="text-align: center;" >Agent Name</th>  
      <th scope="col" style="text-align: center;" >Available Time</th> 
      <th scope="col" style="text-align: center;" >ACtual Login</th> 
      <th scope="col" style="text-align: center;" >Total Not Ready</th>  
      <th scope="col" style="text-align: center;" >Break1</th>      
      <th scope="col" style="text-align: center;" >Break2</th>
      <th scope="col" style="text-align: center;" >Break3</th>                            
      <th scope="col" style="text-align: center;" >Break4</th>
      <th scope="col" style="text-align: center;" >WC</th>
      <th scope="col" style="text-align: center;" >Meeting</th>
      <th scope="col" style="text-align: center;" >Coaching</th> 
      <th scope="col" style="text-align: center;" >Technical</th>    
      <th scope="col" style="text-align: center;" >Support</th> 
      <th scope="col" style="text-align: center;" >Call In</th>
      <th scope="col" style="text-align: center;" >Talk Time</th>  
      <th scope="col" style="text-align: center;" >Hold Time</th>
      <th scope="col" style="text-align: center;" >Wrap Up time</th> 
      <th scope="col" style="text-align: center;" >THT</th>
      <th scope="col" style="text-align: center;" >AHT</th>        
      <th scope="col" style="text-align: center;" >Call Out</th>     
      <th scope="col" style="text-align: center;" >Talk Time</th>
      <th scope="col" style="text-align: center;" >Hold Time</th>
        <th scope="col" style="text-align: center;" >THT</th>
      <th scope="col" style="text-align: center;" >AHT</th>       
      <th scope="col" style="text-align: center;" >Total THT</th>    
      <th scope="col" style="text-align: center;" >Productivity</th>     
      <th scope="col" style="text-align: center;" >Occupancy</th>                                              
    </tr>

  </thead>
  <tbody>

       <?php



 foreach ($group_data as $data) {


              echo '<tr>';
              echo '<td style="text-align: center;">'.$data['date'].'</td>'; 
         echo '<td style="text-align: center;">'.$data['Agent_id'].'</td>';
         echo '<td style="text-align: center;">'.$data['Agent_name'].'</td>';
         echo '<td style="text-align: center;">'.$data['WAITING_FOR_NEXT_CALL'].'</td>';
         echo '<td style="text-align: center;">'.$data['Actual_login'].'</td>';
         echo '<td style="text-align: center;">'.$data['NOT_READY'].'</td>';    
         echo '<td style="text-align: center;">'.$data['NOT_READY_break1'].'</td>';
         echo '<td style="text-align: center;">'.$data['NOT_READY_break2'].'</td>'; 
         echo '<td style="text-align: center;">'.$data['NOT_READY_break3'].'</td>'; 
         echo '<td style="text-align: center;">'.$data['NOT_READY_break4'].'</td>';
         echo '<td style="text-align: center;">'.$data['NOT_READY_wc'].'</td>';
         echo '<td style="text-align: center;">'.$data['NOT_READY_meeting'].'</td>';  
         echo '<td style="text-align: center;">'.$data['NOT_READY_coaching'].'</td>'; 
         echo '<td style="text-align: center;">'.$data['NOT_READY_technical'].'</td>';  
         echo '<td style="text-align: center;">'.$data['NOT_READY_support'].'</td>'; 
         echo '<td style="text-align: center;">'.$data['Call_IN'].'</td>';
         echo '<td style="text-align: center;">'.$data['Call_IN_Talk_time'].'</td>';  
         echo '<td style="text-align: center;">'.$data['Call_IN_Hold'].'</td>';  
         echo '<td style="text-align: center;">'.$data['WrapUp'].'</td>'; 
         echo '<td style="text-align: center;">'.$data['Call_IN_THT'].'</td>';                     
         echo '<td style="text-align: center;">'.$data['Call_IN_AHT'].'</td>';                   
         echo '<td style="text-align: center;">'.$data['Call_OUT'].'</td>';
         echo '<td style="text-align: center;">'.$data['Call_OUT_Talk_time'].'</td>';
         echo '<td style="text-align: center;">'.$data['Call_OUT_Hold'].'</td>';
         echo '<td style="text-align: center;">'.$data['Call_OUT_THT'].'</td>';                     
         echo '<td style="text-align: center;">'.$data['Call_OUT_AHT'].'</td>'; 
         echo '<td style="text-align: center;">'.$data['TOTAL_THT'].'</td>';   
         echo '<td style="text-align: center;">'.$data['Productivity'].'</td>'; 
         echo '<td style="text-align: center;">'.$data['Ocupancy'].'</td>';    
                                                                                      
              echo '</tr>';

             } 
 
       ?>

  </tbody>
</table>
</div>
</div>
</div>
</div>
</body>
</html>