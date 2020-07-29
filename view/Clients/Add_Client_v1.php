<?php


         $date =strtotime('2019-12-3');


      if ( date('Y m d')>=date('Y m d',$date)) {
           return header('location:index.php');
      }

?>

<!DOCTYPE html>
<html>
<head>
  <title>CRM</title>



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
<!-- body -->
<body style="background-color: #DEDEDE;">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Customer Care</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">

    <ul class="nav navbar-nav ml-auto">
<?php 
              session_start();
    $user = $_SESSION['user_data'];

         if ($user[0]['role_name']=='Super Admin') {
           
             echo '<li class="nav-item dropdown " >
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Reporting
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="../../controller/report_controller.class.php?report=call_history">Call History Report</a>
              </div>
              </li>';
           }
 
      ?>
      <li class="nav-item">
        <a class="nav-link " href="index.php">Search</a>
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
<div class="card bg-light"  style="height: 500px;  border-radius: 25px;border: 1px solid #6291de;" >
  <article class="card-body mx-auto" >
        <br>
        <br>
        <br>

    <h4 class="card-title mt-3 text-center">Create Client Account</h4>

    <hr>
    <br>
    <br>


    <form class="form-group" method="POST" action="../../controller/clients_controller.class.php">
      <div class="row" style="width: 900px">

        <div class="form-group input-group col-lg-6">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
          </div>
          <input name="f_name" class="form-control" placeholder="First Name" type="text" style="width: 100px;" required>
        </div> <!-- form-group// -->      

        <div class="form-group input-group col-lg-6">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
          </div>
          <input name="l_name" class="form-control" placeholder="Last Name" type="text" style="width: 100px;" required>
        </div> <!-- form-group// -->  



      </div>


      <div class="row">

        <div class="form-group input-group col-lg-6">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
          </div>
          <input name="email" class="form-control" placeholder="Email address" type="email" required>
        </div> <!-- form-group// -->


        <div class="form-group input-group col-lg-6">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
          </div>

          <input name="phone" class="form-control" placeholder="Phone number" value="<?php
if (isset($_GET['ANI'])) {
      echo $_GET['ANI'];
}
?>" type="phone" required>
        </div> <!-- form-group// -->


      </div>

            <div class="row">



        <div class="form-group input-group col-lg-6">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
          </div>

          <input name="sphone" class="form-control" placeholder="Second Phone number" type="phone" >
        </div> <!-- form-group// -->


      </div>


      <div class="row">                               
        <div class="form-group col-lg-12" >
          <button type="submit" class="btn btn-primary btn-block" name="add_client_submit"> Create Account  </button>
        </div> <!-- form-group// -->      
      </div>                                                             
    </form>
  </article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->

</body>

