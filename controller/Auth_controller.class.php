<?php

/**
 * 
 */
include_once 'Report_controller.class.php';
class Auth extends Report 
{
	
  function index()
  {
    return header('location:view/Auth/login.php');
  }

  function check_login($user_name,$password)
  {
    //$db = new DB();
   // $conn = $db->connect('localhost','root','','morder');
    $data = DB::getInstance()->select('*','users LEFT JOIN roles on users.role_id = roles.id','user_name="'.$user_name.'" and password="'.$password.'"','')
    ;
    // $data = $db->select($conn,'*','users','user_name="'.$user_name.'" and password="'.$password.'"','')
     ;
    
    if ($data) {

            $_SESSION['user_data']=$data;
            $this->Dashbord();
            // $monitor = DB::getInstance()->sele
            // return header('location:../view/Dashbord.php');    	
    }
    else
    {
      return header('location:../view/Auth/login.php?result=wrong_values');
    }
  }

  function Dashbord()
  {
    $day_start = date("Y-m-d 00:00:00");
    $day_end =  date("Y-m-d 23:59:59");
    $queues = DB::getInstance()->select('distinct queue','datamart_queue_details','');
    $monitoring_data=array();
    foreach ($queues as $queue) {
      if ($queue['queue']!='KSA' && $queue['queue']!='Kuwait' && $queue['queue']!='UAE' && $queue['queue']!='Egypt' && $queue['queue']!='agent' && $queue['queue']!='Dial-Ag' && $queue['queue']!='testing' && $queue['queue']!='test-test' && $queue['queue']!='dial'  && $queue['queue']!='transfer-agent' ) {
       $monitoring_data[] = $this->get_queue_report($day_start,$day_end,$queue['queue']);
      }
      
    }
     $_SESSION['get_monitor_data'] = $monitoring_data;
     return header('location:../view/Dashbord.php');
  }
}


if (isset($_POST['login_submit'])) {

	require_once '../core/init.php';
  if (!empty($_POST['user_name'])&& !empty($_POST['password'])) {

      $check_login = new Auth();
      $check_login->check_login($_POST['user_name'],$_POST['password']);   
  }

}

if (isset($_GET['status'])) {
    require_once '../core/init.php';
    if ($_GET['status']=='logout') {
      session_unset();
      session_destroy();
      return header('location:../view/Auth/login.php');
    }else if ($_GET['status']=='monitoring') {
      $monitor = new Auth();
      $monitor->Dashbord();
    }
}