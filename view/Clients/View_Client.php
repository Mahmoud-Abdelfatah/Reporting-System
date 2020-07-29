<?php 

         $date =strtotime('2019-12-3');


      if ( date('Y m d')>=date('Y m d',$date)) {
           return header('location:index.php');
      }

include_once '../../core/init.php';
$search_data=$_SESSION['search_data'];
$call_hist_data=$_SESSION['call_hist_data'];


 
$categorys = DB::getInstance()->select('*','cats','');
 $sub_cat_data=DB::getInstance()->select('*','sub_cat','')  

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


  <style type="text/css">
  body{
    background: -webkit-linear-gradient(left, #DEDEDE, #DEDEDE);
  }
  .emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
  }
  .profile-img{
    text-align: center;
  }

  .profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
  }
  .profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
  }
  .profile-head h5{
    color: #333;
  }
  .profile-head h6{
    color: #0062cc;
  }
  .profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
  }
  .proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
  }
  .proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
  }
  .profile-head .nav-tabs{
    margin-bottom:5%;
  }
  .profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
  }
  .profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
  }
  .profile-work{
    padding: 14%;
    margin-top: -15%;
  }
  .profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
  }
  .profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
  }
  .profile-work ul{
    list-style: none;
  }
  .profile-tab label{
    font-weight: 600;
  }
  .profile-tab p{
    font-weight: 600;
    color: #0062cc;
  }
</style>

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

    <div class=" emp-profile">


      <div class="row">
        <div class="col-md-4">
          <div class="profile-img">
            <img src="../../img/Manager-512.png" style="width: 200px; height: 200px" />

          </div>
        </div>
        <div class="col-md-6">
          <div class="profile-head">
            <h5>
              <?php echo $search_data[0]['first_name'].' '.$search_data[0]['last_name'] ?>
            </h5>
            <h6>
              <?php echo $search_data[0]['Client_number'] ?>
            </h6>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Call History</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Booking-tab" data-toggle="tab" href="#Booking" role="tab" aria-controls="Booking" aria-selected="false">Call Details</a>
              </li>                                
            </ul>
          </div>
        </div>
        <div class="col-md-2">
          <a href="../../controller/Clients_controller.class.php?edit=<?php echo $search_data[0]['id'] ?> " class="profile-edit-btn btn btn-info">edit</a>

        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="profile-work">
<!--                             <p>WORK LINK</p>
<a href="">Website Link</a><br/>
<a href="">Bootsnipp Profile</a><br/>
<a href="">Bootply Profile</a>
<p>SKILLS</p>
<a href="">Web Designer</a><br/>
<a href="">Web Developer</a><br/>
<a href="">WordPress</a><br/>
<a href="">WooCommerce</a><br/>
<a href="">PHP, .Net</a><br/> -->
</div>
</div>
<div class="col-md-8">
  <div class="tab-content profile-tab" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="row">
        <div class="col-md-6">
          <label>User Id</label>
        </div>
        <div class="col-md-6">
          <p><?php echo $search_data[0]['id'] ?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label>Name</label>
        </div>
        <div class="col-md-6">
          <p><?php echo $search_data[0]['first_name'].' '.$search_data[0]['last_name'] ?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label>First Phone</label>
        </div>
        <div class="col-md-6">
          <p><?php echo $search_data[0]['Client_number'] ?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label>Second Phone</label>
        </div>
        <div class="col-md-6">
          <p><?php echo $search_data[0]['Client_snumber'] ?></p>
        </div>
      </div>                                        
      <div class="row">
        <div class="col-md-6">
          <label>Email</label>
        </div>
        <div class="col-md-6">
          <p><?php echo $search_data[0]['client_email'] ?></p>
        </div>
      </div>


    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Call Start</th>
            <th scope="col">Call End</th>
            <th scope="col">Agent</th>
            <th scope="col">Location</th>
            <th scope="col">BID</th>  
            <th scope="col">Type</th> 
            <th scope="col">Stype</th>                         
          </tr>
        </thead>
        <tbody>

          <?php
          $counter =0;

if (!empty($call_hist_data)) {


          foreach ($call_hist_data as  $data) {





            echo '<tr>';
            echo '<td>'.++$counter.'</td>';              
            echo '<td>'.$data['START_TIME'].'</td>';
            echo '<td>'.$data['END_TIME'].'</td>';             
            echo '<td>'.$data['AGENT_ID'].'</td>';
            switch ($data['DNIS']) {
              case '33473100':
              echo '<td>'.'Egypt'.'</td>';                      
              break;
              case '8080':
              echo '<td>'.'Kuwait'.'</td>';                      
              break;
              case '5191006':
              echo '<td>'.'KSA'.'</td>';                      
              break;
              case '5060':
              echo '<td>'.'UAE'.'</td>';                      
              break; 
              case '33473101':
              echo '<td>'.'Egypt'.'</td>';                      
              break;
                            case '33473103':
              echo '<td>'.'Egypt'.'</td>';                      
              break;
                            case '33473104':
              echo '<td>'.'Egypt'.'</td>';                      
              break;
                            case '33473105':
              echo '<td>'.'Egypt'.'</td>';                      
              break;
                            case '33473106':
              echo '<td>'.'Egypt'.'</td>';                      
              break;                                                                                                                                                 
            }
             echo '<td>'.$data['booking_id'].'</td>';
             echo '<td>'.$data['cat_name'].'</td>';
             echo '<td>'.$data['sub_name'].'</td>'; 

            echo '</tr>';

          }
}          
          ?>

        </tbody>
      </table>
    </div>
    <div class="tab-pane fade" id="Booking" role="tabpanel" aria-labelledby="Booking-tab">
      <form  method="POST" action="../../controller/clients_controller.class.php">

        <div class="row">
          <div class="form-group input-group col-lg-6">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="far fa-list-alt"></i> </span>
            </div>

            <select name="categorys" class="form-control" id="categorys">
              <option>Select Category</option>
              <?php 
              foreach ($categorys as  $category) {
                echo '<option value='.$category['id'].'>'.$category['cat_name'].'</option>';
              }
              ?>
            </select>
          </div> <!-- form-group end.// --> 

          <div class="form-group input-group col-lg-6">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="far fa-list-alt"></i> </span>
            </div>

            <select name="sub_category" class="form-control" id="sub_category">
              <?php 
              foreach ($sub_cat_data as  $sub_category) {

                echo '<option id='.$sub_category['cat_id'].' value='.$sub_category['id'].'>'.$sub_category['sub_name'].'</option>';

              }
              ?>
            </select>
          </div> <!-- form-group end.// --> 

        </div>  

        <div class="row">
          <div class="form-group input-group col-lg-6">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fas fa-qrcode"></i> </span>
            </div>
            <input type="text" name="new_booking_id" placeholder="Add New Booking ID" class="form-control" required>
          </div>

        </div>
        <div class="row">
          <div class="form-group col-lg-12" >
            <input type="submit" name="booking_id_submit" class="btn btn-info btn-block" value="Submit">

          </div>




        </form>
      </div>

    </div>
  </div>
</div>

</div>


<script type="text/javascript">
//Reference: https://jsfiddle.net/fwv18zo1/
var $categorys = $( '#categorys' ),
$sub_category = $( '#sub_category' ),
$options = $sub_category.find( 'option' );

$categorys.on( 'change', function() {
  console.log($sub_category.val());
  $sub_category.html( $options.filter( '[id="' + this.value + '"]' ) );
} ).trigger( 'change' );
</script>



