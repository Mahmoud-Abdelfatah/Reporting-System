<?php

/**
 * 
 */
class Clients 
{
    function index()
    {

        return header('location:views/Clients/index.php');
    }


    function client_search($number)
    {



        $data=DB::getInstance()->select('*','Clients','client_number="'.$number.'" or client_snumber="'.$number.'"');



        $call_hist_data=DB::getInstance()->select('*','datamart_call_details LEFT JOIN booking_new
on datamart_call_details.START_TIME=booking_new.call_time LEFT JOIN cats ON cats.id=booking_new.cat_id LEFT JOIN sub_cat ON sub_cat.id=booking_new.sub_id','datamart_call_details.ANI="'.$number.'"  ');
        $call_hist_details = array();
        $call_hist_string='';

        // foreach ($call_hist_data as $call) {
            
        //  $Call_ID = $call['call_id'];
        //  $call_details = $call_hist_db->select($conn_call_hist,'*','queuemetrics.queue_log LEFT JOIN booking_new ON call_time=time_id LEFT JOIN cats ON cats.id=booking_new.cat_id LEFT JOIN sub_cat ON sub_cat.id=booking_new.sub_id','call_id="'.$Call_ID.'"');
            
        //  foreach ($call_details as  $details) {


                  
        //      if($details['verb']=='CONNECT')
        //      {
        //              $agent_data = explode('/', $details['agent']);
        //              $explode_agent = explode('@',$agent_data[1]);
        //              $agent =$explode_agent[0]; 
        //          $call_hist_string.= $details['cat_name'].'/'.$details['sub_name'].'@'.$details['time_id'].' '.$agent.' '.$details['booking_id'].'<br>';
        //      }
        //      if ($details['verb']=='COMPLETEAGENT' || $details['verb']=='COMPLETECALLER') {
        //          $call_hist_string.= ' '.$details['time_id'].' '.$agent.' '.$details['queue'];
                    
        //      }

        //  }
        //      $call_hist_details[] = $call_hist_string;
        //      $call_hist_string='';

        // }



        if ($data) {
            
              $_SESSION['call_hist_data']=$call_hist_data;
              $_SESSION['search_data']= $data;
            return header('location:../view/Clients/View_Client.php');
        }else
        {
            return header('location:../view/Clients/Add_Client_v1.php?ANI='.$number.'');
        }
    }


    function client_add($f_name,$l_name,$phone,$sphone,$email)
    {


        DB::getInstance()->insert('Clients',array('first_name','last_name','Client_number','Client_snumber','client_email'),array("'$f_name","$l_name","$phone","$sphone","$email'"),'');
    }

    function add_booking_id($booking_id,$Category,$Subcategory)
    {


        $datetime =$_SESSION['call_time'];
        $start_time=strtotime($datetime)-1;
        $end_time=strtotime($datetime)+1;
        $start_time = date('Y-m-d H:i:s',$start_time);
        $end_time = date('Y-m-d H:i:s',$end_time);

        $call_hist_data=DB::getInstance()->select('*','datamart_call_details','START_TIME>="'.$start_time.'" and START_TIME<="'.$end_time.'" and ANI = "'.$_SESSION['ANI'].'" and AGENT_ID ="'.$_SESSION['agent_id'].'" ');
         $ANI = $_SESSION['ANI'];
         $AGINT_ID = $_SESSION['agent_id'];
        if ($call_hist_data) {
                    foreach ($call_hist_data as $call) {
                      $call_time = $call['START_TIME'];
                      DB::getInstance()->insert('booking_new',array('booking_id','call_time','ani','agent_id','cat_id','sub_id'),array("'$booking_id","$call_time","$ANI","$AGINT_ID","$Category","$Subcategory'"),'');

                    }
                }  
                else
                {
                    echo "no call in that time ";
                }      

    }

    function client_edit($client_id)
    {


      $data = DB::getInstance()->select('*','Clients','id="'.$client_id.'"');

      if ($data) {
           $_SESSION['client_edit']=$data;
          return header('location:../view/Clients/Edit_Client.php');
      }
    }

    function client_update($f_name,$l_name,$phone,$sphone,$email,$client_id)
    {


      $update = DB::getInstance()->update('Clients','first_name="'.$f_name.'",last_name="'.$l_name.'",
      Client_number="'.$phone.'",Client_snumber="'.$sphone.'",client_email="'.$email.'" ',' id="'.$client_id.'" ');
    }


}

if (isset($_POST['search_cleint_submit'])) {
  include_once '../core/init.php';
    $client_find = new Clients();
    $client_find->client_search($_POST['Search']);
}

if (isset($_POST['add_client_submit'])) {
    include_once '../core/init.php';
    if (!empty($_POST['f_name']) && !empty($_POST['l_name']) && !empty($_POST['phone']) && !empty($_POST['email'])) {
       $new_client = new Clients();
       $new_client->client_add($_POST['f_name'],$_POST['l_name'],$_POST['phone'],$_POST['sphone'],$_POST['email']);
       // echo $_POST['phone'];
       $new_client->client_search($_POST['phone']);

         
    }
    else
    {
        return header('location:../view/Clients/Add_Client_v1.php');
    }
}


if(isset($_POST['booking_id_submit']))
{

    include_once '../core/init.php';

    if(!empty($_POST['new_booking_id']) && $_POST['categorys']!='Select Category')
    {

     $new_booking_id= new Clients();
     $new_booking_id->add_booking_id($_POST['new_booking_id'],$_POST['categorys'],$_POST['sub_category']);
     $new_booking_id->client_search($_SESSION['ANI']);
    }
}

if (isset($_GET['edit'])) {
    include_once '../core/init.php';  

   $client = new Clients();
   $client->client_edit($_GET['edit']); 
}
else if(isset($_GET['ANI']))
{
    include_once '../core/init.php';
    $client_find = new Clients();
    $_SESSION['call_time'] = date('Y-m-d H:i:s');
    $_SESSION['ANI'] = $_GET['ANI'];
    $_SESSION['agent_id'] = $_GET['AGENT'];
    $client_find->client_search($_GET['ANI']);

}

if (isset($_POST['edit_client_submit'])) {
    
    include_once '../core/init.php';


    if (!empty($_POST['f_name']) && !empty($_POST['l_name']) && !empty($_POST['phone']) && !empty($_POST['email'])) {
        $edit_client = new Clients();
        $edit_client->client_update($_POST['f_name'],$_POST['l_name'],$_POST['phone'],$_POST['sphone'],$_POST['email'],$_POST['client_id']);
        $edit_client->client_search($_POST['phone']);
    }
}

