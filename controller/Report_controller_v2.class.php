<?php

class Report{

	public function queue_index()
	{

		$queues = DB::getInstance()->select('distinct queue','datamart_queue_details','');
		$_SESSION['queues']=$queues;
		return header('location:../view/queue/index.php');
	}

  public function queue_interval_index()
  {
    $queues = DB::getInstance()->select('distinct queue','datamart_queue_details','');
    $_SESSION['queues']=$queues;  
    return header('location:../view/queue_interval/index.php');      
  }

	public function agent_day_index()
	{

		$groups = DB::getInstance()->select('*','cfg_agent_group','');
		$_SESSION['agent_group']=$groups;
		return header('location:../view/Agent_day/index.php');
	}	

  public function calls_index()
  {
    return header('location:../view/call/index.php');    
  }

	public function get_queue_report($sdate,$edate,$queue)
	{
		$data =DB::getInstance()->select('*','datamart_queue_details','queue="'.$queue.'" and event_time>="'.$sdate.'" and event_time<="'.$edate.'" order by tracknum ');
		if ($data) {
			$queud_count = 0;
			$distruputed_after_20 = 0;
			$abandond_after_20 = 0;
			$exited = 0;
			$distributed_befor_20=0;
			$abandoned_before_20=0;
			$queue_data_string ='';
			$queued_time='';
			$distributed_time='';
			$abendond_time='';
			foreach ($data as $row) {

				switch ($row['EVENT']) {
					case 'queued':
					$queud_count++;
					$queued_time = $row['EVENT_TIME'];
					break;
					case 'distributed':
//$distruputed_count++;
					$distributed_time = $row['EVENT_TIME'];
					if ((strtotime($distributed_time)-strtotime($queued_time))<20) {
						$distributed_befor_20++;
					}else{$distruputed_after_20++;}
					break;
					case 'abandoned':
//$abandond_count++;
					$abendond_time = $row['EVENT_TIME'];
					if ((strtotime($abendond_time)-strtotime($queued_time))<20) {
						$abandoned_before_20++;
					}else{$abandond_after_20++;}            		
					break;
					case 'exit':
					$exited++;
					break;  
					case 'exited':
					$exited++;
					break;              		            		              		              		
				}

			}
			$sla=round((($distributed_befor_20+$abandoned_before_20)/$queud_count)*100,1);
			$queue_data_string.= $queue.' '.$queud_count.' '.$distributed_befor_20.' '.$distruputed_after_20.' '.$abandoned_before_20.' '.$abandond_after_20.' '.$exited.' '.$sla;
			return $queue_data_string;


		}else
		{
			echo "no data";
//return header('locaction:/')
		}
	}

  public function get_queue_interval_report($sdate,$edate,$start_int_date,$end_int_date,$queue)
  {
   $data =DB::getInstance()->select('*','datamart_queue_details','queue="'.$queue.'" and event_time>="'.$sdate.'" and event_time<="'.$edate.'" and TRACKNUM in (select TRACKNUM from datamart_queue_details where EVENT_TIME >= "'.$start_int_date.'" and event_time <= "'.$end_int_date.'" and event = "queued") order by tracknum , event_time ');
    if ($data) {
      $queud_count = 0;
      $distruputed_after_20 = 0;
      $abandond_after_20 = 0;
      $exited = 0;
      $distributed_befor_20=0;
      $abandoned_before_20=0;
      $queue_data_string ='';
      $queued_time='';
      $distributed_time='';
      $abendond_time='';

$counter=1;

      foreach ($data  as $row) {
          $cdata = count($data);
           if ($cdata==($counter)) {
        switch ($row['EVENT']) {
          case 'queued':
          $queud_count++;
          $queued_time = $row['EVENT_TIME'];
          $GLOBALS['last_traknum']=$row['TRACKNUM'];
          //echo $queued_time = $row['EVENT_TIME'].'   '.$start_int_date.'   '.$end_int_date.'<br>';
          break;
          case 'distributed':
//$distruputed_count++;
          $distributed_time = $row['EVENT_TIME'];
          if ((strtotime($distributed_time)-strtotime($queued_time))<20) {
            $distributed_befor_20++;
            $GLOBALS['last_traknum']=$row['TRACKNUM'];
          }else{$distruputed_after_20++;
             $GLOBALS['last_traknum']=$row['TRACKNUM'];
          }
          break;
          case 'abandoned':
//$abandond_count++;
          $abendond_time = $row['EVENT_TIME'];
          if ((strtotime($abendond_time)-strtotime($queued_time))<20) {
            $abandoned_before_20++;
            $GLOBALS['last_traknum']=$row['TRACKNUM'];
          }else{$abandond_after_20++;
             $GLOBALS['last_traknum']=$row['TRACKNUM'];
          }                
          break;
          case 'exit':
          $exited++;
          $GLOBALS['last_traknum']=$row['TRACKNUM'];
          break;  
          case 'exited':
          $GLOBALS['last_traknum']=$row['TRACKNUM'];
          $exited++;
          break;                                                                      
        }      
           }
           else
           {
           $counter++;

           if (isset($GLOBALS['last_traknum'])) {
                          
            if ($GLOBALS['last_traknum']==$row['TRACKNUM']) {
              //echo 'do nothing';

            }else
            {
        switch ($row['EVENT']) {
          case 'queued':
          $queud_count++;
          $queued_time = $row['EVENT_TIME'];
           //echo $queued_time = $row['EVENT_TIME'].'   '.$start_int_date.'   '.$end_int_date.'<br>';
          break;
          case 'distributed':
//$distruputed_count++;
          $distributed_time = $row['EVENT_TIME'];
          if ((strtotime($distributed_time)-strtotime($queued_time))<20) {
            $distributed_befor_20++;
          }else{$distruputed_after_20++;}
          break;
          case 'abandoned':
//$abandond_count++;
          $abendond_time = $row['EVENT_TIME'];
          if ((strtotime($abendond_time)-strtotime($queued_time))<20) {
            $abandoned_before_20++;
          }else{$abandond_after_20++;}                
          break;
          case 'exit':
          $exited++;
          break;  
          case 'exited':
          $exited++;
          break;                                                                      
        }                       
            }
           }
           else
           {
        switch ($row['EVENT']) {
          case 'queued':
          $queud_count++;
          $queued_time = $row['EVENT_TIME'];
          // echo $queued_time = $row['EVENT_TIME'].'   '.$start_int_date.'   '.$end_int_date.'<br>';
          break;
          case 'distributed':
//$distruputed_count++;
          $distributed_time = $row['EVENT_TIME'];
          if ((strtotime($distributed_time)-strtotime($queued_time))<20) {
            $distributed_befor_20++;
          }else{$distruputed_after_20++;}
          break;
          case 'abandoned':
//$abandond_count++;
          $abendond_time = $row['EVENT_TIME'];
          if ((strtotime($abendond_time)-strtotime($queued_time))<20) {
            $abandoned_before_20++;
          }else{$abandond_after_20++;}                
          break;
          case 'exit':
          $exited++;
          break;  
          case 'exited':
          $exited++;
          break;                                                                      
        }               
           }
         
           }


      }
      $period = $start_int_date.'/'.$end_int_date;
      $sla=round((($distributed_befor_20+$abandoned_before_20)/$queud_count)*100,1);
      $queue_data_string.= $queue.' '.$queud_count.' '.$distributed_befor_20.' '.$distruputed_after_20.' '.$abandoned_before_20.' '.$abandond_after_20.' '.$exited.' '.$sla.'@'.$period;
     return $queue_data_string;


    }else
    {
      echo "no data";
//return header('locaction:/')
    }    
  }

	public function get_agent_details($sdate,$edate,$agent_id)
	{
      $data = DB::getInstance()->select('*','datamart_agent_details left join cfg_person on agent_id=login_id','agent_id="'.$agent_id.'" and event_time>="'.$sdate.'" and event_time<="'.$edate.'" order by event_time');
      if ( $data) {
      	$full_name ='';
      	$agent_data = array();
      	////////waiting///////
      	$waiting_event='';
      	$waiting_time=0;
      	$waiting_flag=0;
      	////////Login/////// 
      	$login_event='';
      	$login_time=0;
      	$login_flag=0;  
      	////////Logout/////// 
      	$shift_time=0;  
      	////////Login/////// 
      	$notready_event='';
      	$notready_reson='';
      	$notready_break1=0;
      	$notready_break2=0; 
      	$notready_break3=0; 
      	$notready_break4=0;
      	$notready_wc=0;
      	$notready_Meeting=0;  
      	$notready_Coaching=0; 
      	$notready_Technical=0;  
      	$notready_Support=0;      	    	     	    	      	      	     	     	      	
      	$notready_time=0;
      	$notready_flag=0;   
      	////////Talk ime///////
      	$Talk_event='';
      	$call_dirction='';
      	$incall_count=0;
      	$outcall_count=0;
      	$incallTalk_time=0;
      	$outcallTalk_time=0;
      	$Talk_flag=0;  
      	////////hold///////      	   
      	$hold_event = '';
      	$incall_hold_time =0; 
      	$outcall_hold_time=0;	 
      	////////waiting///////
      	$wrapup_event='';
      	$wrapup_time=0;
      	$wrapup_flag=0;  
      	////////others/////// 
      	$THT_IN =0;
      	$THT_OUT=0;
      	$AHT_IN=0;
      	$AHT_OUT=0; 
      	$Total_THT=0;  
      	$productivety=0;
      	$ocupancy=0; 	    	   	    	    	     	
      	foreach ($data as  $row) {

      		if ($waiting_flag==1){ 
      			$current_event_time = $row['EVENT_TIME'];
      			$waiting_time += strtotime($current_event_time) - strtotime($waiting_event);
      			$waiting_flag =0;
      		}

      		if ($login_flag==1 && $row['EVENT']=='LOGOUT') {
                $current_event_time = $row['EVENT_TIME'];
                $shift_time+= strtotime($current_event_time) - strtotime($login_event);
                $login_flag=0;
      		}
            if ($wrapup_flag == 1) {
            	$current_event_time = $row['EVENT_TIME'];
                $wrapup_time +=  strtotime($current_event_time) - strtotime($wrapup_event);
                $wrapup_flag=0;
            }

      		if ($Talk_flag == 1 && $row['EVENT'] == 'WRAP_UP') {
      			$current_event_time = $row['EVENT_TIME'];
      			$Talk_flag =0;
      			switch ($call_dirction) {
      				case 'IN_CALL_INBOUND':
      				    $incallTalk_time += strtotime($current_event_time) - strtotime($Talk_event);
      					$incall_count++;
      					$call_dirction='';
      					break;
       				case 'IN_CALL_OUTBOUND':
      				    $outcallTalk_time += strtotime($current_event_time) - strtotime($Talk_event);      
      				    $outcall_count++;
      					$call_dirction='';
      					break;     				

      			}
      		}

      		if ($notready_flag==1) {
      			$current_event_time = $row['EVENT_TIME'];
      			$notready_time += strtotime($current_event_time) - strtotime($notready_event);
      			$notready_flag=0;
      			switch ($notready_reson) {
      	  		case 'Break1':
      	  			$notready_break1 += strtotime($current_event_time) - strtotime($notready_event);
      	  			$notready_reson='';
      	  			break;
       	  		case 'Break2':
      	  			$notready_break2 += strtotime($current_event_time) - strtotime($notready_event);
      	  			$notready_reson='';
      	  			break;  
       	  		case 'Break3':
      	  			$notready_break3 += strtotime($current_event_time) - strtotime($notready_event);
      	  			$notready_reson='';
      	  			break;    
       	  		case 'Break4':
      	  			$notready_break4 += strtotime($current_event_time) - strtotime($notready_event);
      	  			$notready_reson='';
      	  			break;  
       	  		case 'WC':
      	  			$notready_wc += strtotime($current_event_time) - strtotime($notready_event);
      	  			$notready_reson='';
      	  			break; 
       	  		case 'Meeting':
      	  			$notready_Meeting += strtotime($current_event_time) - strtotime($notready_event);
      	  			$notready_reson='';
      	  			break;       	  			       	  			    	  			    	  		
       	  		case 'Coaching':
      	  			$notready_Coaching += strtotime($current_event_time) - strtotime($notready_event);
      	  			$notready_reson='';
      	  			break; 
       	  		case 'Technical':
      	  			$notready_Technical += strtotime($current_event_time) - strtotime($notready_event);
      	  			$notready_reson='';
      	  			break;  
       	  		case 'Support':
      	  			$notready_Support += strtotime($current_event_time) - strtotime($notready_event);
      	  			$notready_reson='';
      	  			break;   
      				

      			}
      		}
      	  
      	  if ($row['EVENT']=='WAITING_FOR_NEXT_CALL') {
      	  	$waiting_event =$row['EVENT_TIME'];
            $waiting_flag =1;
      	  }

      	  else if ($row['EVENT']=='LOGIN') {
      	  	$login_event = $row['EVENT_TIME'];
      	  	$login_flag=1;
      	  }

      	  else if ($row['EVENT']=='NOT_READY') {
      	  	$notready_event = $row['EVENT_TIME'];
      	  	$notready_flag=1;
      	  	switch ($row['EVENTDETAILS']) {
      	  		case 'Break1':
      	  			$notready_reson = 'Break1';
      	  			break;
       	  		case 'Break2':
      	  			$notready_reson = 'Break2';
      	  			break;  
       	  		case 'Break3':
      	  			$notready_reson = 'Break3';
      	  			break;    
       	  		case 'Break4':
      	  			$notready_reson = 'Break4';
      	  			break;  
       	  		case 'WC':
      	  			$notready_reson = 'WC';
      	  			break; 
       	  		case 'Meeting':
      	  			$notready_reson = 'Meeting';
      	  			break;       	  			       	  			    	  			    	  		
       	  		case 'Coaching':
      	  			$notready_reson = 'Coaching';
      	  			break; 
       	  		case 'Technical':
      	  			$notready_reson = 'Technical';
      	  			break;  
       	  		case 'Support':
      	  			$notready_reson = 'Support';
      	  			break;          	  			     	  			     	  			     	  				   	  		
      	  	}

      	  }
        else if ($row['EVENT']=='IN_CALL_INBOUND' || $row['EVENT']=='IN_CALL_OUTBOUND') {
            $Talk_event = $row['EVENT_TIME'];
            $Talk_flag = 1;
            switch ($row['EVENT']) {
            	case 'IN_CALL_INBOUND':
            		$call_dirction = 'IN_CALL_INBOUND';
            		break;
            	case 'IN_CALL_OUTBOUND':
            		$call_dirction = 'IN_CALL_OUTBOUND';
            		break;            	
            }
      	  }

      	  else if ($row['EVENT']=='HOLD') {
      	  	$hold_event = $row['EVENT_TIME'];
      	  }
      	  else if ($row['EVENT']=='UNHOLD')
      	  {
            $current_event_time = $row['EVENT_TIME'];
            switch ($call_dirction) {
            	case 'IN_CALL_INBOUND':
                  $incall_hold_time += strtotime($current_event_time) - strtotime($hold_event);
            		break;
            	case 'IN_CALL_OUTBOUND':
                  $outcall_hold_time += strtotime($current_event_time) - strtotime($hold_event);
            		break;            	

            }

      	  }

      	  else if ($row['EVENT']=='WRAP_UP') {
      	  	$wrapup_event = $row['EVENT_TIME'];
      	  	$wrapup_flag =1;
      	  }
          $full_name = $row['FIRST_NAME'].' '.$row['LAST_NAME'];

        }
          $THT_IN = $incallTalk_time+$incall_hold_time+$wrapup_time;
          if ($incall_count) {
             $AHT_IN = $THT_IN / $incall_count;
          }

          $THT_OUT = $outcallTalk_time+$outcall_hold_time;
          if ($outcall_count) {
             $AHT_OUT = $THT_OUT / $outcall_count;
          }

          $Total_THT =$THT_IN+$THT_OUT;
          $productivety = round(($Total_THT/($shift_time-($notready_break1+$notready_break2+$notready_break3+$notready_break4+$notready_Support)))*100,1);
          $ocupancy = round($Total_THT/ ($Total_THT + $waiting_time),1);

         $agent_data['date']=$sdate.' '.$edate ;         
         $agent_data['Agent_id']=$agent_id;
         $agent_data['Agent_name']=$full_name;
         $agent_data['WAITING_FOR_NEXT_CALL']=$waiting_time;
         $agent_data['Actual_login']=$shift_time;
         $agent_data['NOT_READY']=$notready_time;    
         $agent_data['NOT_READY_break1']=$notready_break1;
      	 $agent_data['NOT_READY_break2']=$notready_break2; 
      	 $agent_data['NOT_READY_break3']=$notready_break3; 
      	 $agent_data['NOT_READY_break4']=$notready_break4;
      	 $agent_data['NOT_READY_wc']=$notready_wc;
      	 $agent_data['NOT_READY_meeting']=$notready_Meeting;  
      	 $agent_data['NOT_READY_coaching']=$notready_Coaching; 
      	 $agent_data['NOT_READY_technical']=$notready_Technical;  
      	 $agent_data['NOT_READY_support']=$notready_Support; 
      	 $agent_data['Call_IN']=$incall_count;
      	 $agent_data['Call_IN_Talk_time']=$incallTalk_time;  
         $agent_data['Call_IN_Hold']=$incall_hold_time;  
         $agent_data['WrapUp']=$wrapup_time; 
         $agent_data['Call_IN_THT']=$THT_IN;                     
         $agent_data['Call_IN_AHT']=$AHT_IN;         	       	 
      	 $agent_data['Call_OUT']=$outcall_count;
         $agent_data['Call_OUT_Talk_time']=$outcallTalk_time;
         $agent_data['Call_OUT_Hold']=$outcall_hold_time;
         $agent_data['Call_OUT_THT']=$THT_OUT;                     
         $agent_data['Call_OUT_AHT']=$AHT_OUT; 
         $agent_data['TOTAL_THT']= $Total_THT;   
         $agent_data['Productivity']= $productivety; 
         $agent_data['Ocupancy']= $ocupancy;                         
   
        return $agent_data;

      }

	}

	public function get_agent_day_report($sdate,$edate,$group)
	{

      $agents = DB::getInstance()->select('distinct Agent_id','datamart_agent_details','grp_dbid="'.$group.'" and event_time>="'.$sdate.'" and event_time<="'.$edate.'"');
      if ($agents) {
        $group_data = array();
      	foreach ($agents as  $agent) {
          $agent_id = $agent['Agent_id'];
        	$group_data[$agent_id]=$this->get_agent_details($sdate,$edate,$agent_id);
         }

        $_SESSION['get_group_report_data'] = $group_data;
         return header('location:../view/Agent_day/view_data.php');
      }

	}

  public function get_hang_resoun($tracknum)
  {
    $data = DB::getInstance()->select('*','aheevaccs.datamart_agent_details','tracknum="'.$tracknum.'"');
    foreach ( $data as $row) {
      if ($row['EVENT']=='WRAP_UP') {
        return $row['END_CALL_REASON'];
      }
    }
  }
  public function get_calls($sdate,$edate)
  {
    $calls = DB::getInstance()->select('*','aheevaccs.datamart_call_details left join aheevaccs.cfg_agent_group on grp_dbid = dbid left join aheevaccs.cfg_person on agent_id=login_id','start_time>="'.$sdate.'" and event_time<="'.$edate.'"');
      if($calls)
      {
        $calls_string = '';
        $calls_details =array();
        foreach ($calls as $call) {
          $hangup_resoun = $this->get_hang_resoun($call['TRACKNUM']);
          $call_duration=(strtotime($call['END_TIME'])-strtotime($call['START_TIME']));
          $full_name=$call['FIRST_NAME'].' '.$call['LAST_NAME'];
          $call_string .=$call['START_TIME'].'@'.$call_duration.' '.$call['ANI'].' '.$call['DNIS'].' '.$call['DIRECTION'].' '.$call['NAME'].' '.$full_name.' '.$call['AGENT_ID'].' '.$hangup_resoun;
          $calls_details[]=$call_string;
          $call_string='';
        }
         $_SESSION['calls_data'] = $calls_details;
         return header('location:../view/call/view_data.php');
      }

  }

}


if (isset($_POST['queue_submit'])) {
	require_once '../core/init.php';

	if (!empty($_POST['Sdate']) && !empty($_POST['Edate']) && !empty($_POST['queue'])) {
		$report = new Report();
		$report_data=array();

		foreach ($_POST['queue'] as  $queue) {

			$report_data []= $report->get_queue_report($_POST['Sdate'],$_POST['Edate'],$queue);

		}
		$_SESSION['get_queue_report_data'] = $report_data;
		return header('location:../view/queue/view_data.php');

	}else
	{
		echo 'wrong';
	}


}

else if (isset($_POST['queue_inteval_submit'])) {
    require_once '../core/init.php';
  if (!empty($_POST['Sdate']) && !empty($_POST['Edate']) && !empty($_POST['queue'])) {
           $report_iterval_data=array();
    foreach ($_POST['queue'] as  $queue) {
       $interval   = $_POST["interval"];
       $start_int_date = $_POST['Sdate'];
       $end_int_date = strtotime($start_int_date) + $interval;
       $end_int_date = date('Y-m-d H:i:s', $end_int_date); 
       $interval_queue = new Report();

        while (strtotime($end_int_date)<=strtotime($_POST['Edate'])){

         $report_iterval_data [] = $interval_queue->get_queue_interval_report($_POST['Sdate'],$_POST['Edate'],$start_int_date,$end_int_date,$queue);
         $start_int_date = $end_int_date;
         $end_int_date = strtotime($start_int_date) + $interval;
         $end_int_date = date('Y-m-d H:i:s', $end_int_date);             
        } 
       }
          $_SESSION['get_queue_interval_report_data'] = $report_iterval_data;  
          return header('location:../view/queue_interval/view_data.php');
  }
}

else if (isset($_POST['agent_day_submit'])) {
	require_once '../core/init.php';
	if (!empty($_POST['Sdate']) && !empty($_POST['Edate']) && !empty($_POST['group'])) {
		$report = new Report();
		$report_data=array();
		foreach ($_POST['group'] as  $group) {
					$report_data []= $report->get_agent_day_report($_POST['Sdate'],$_POST['Edate'],$group);
				}		
	}
}
else if (isset($_POST['call_submit'])) {
    require_once '../core/init.php';
  if (!empty($_POST['Sdate']) && !empty($_POST['Edate'])) {
    $report = new Report();
    $report->get_calls($_POST['Sdate'],$_POST['Edate']);
  }
}

if (isset($_GET['report'])) {
	require_once '../core/init.php';	
	if ($_GET['report']=='queue_report') {
		$view_report = new Report();
		$view_report->queue_index();
	}elseif ($_GET['report']=='agent_daily') {
		$view_report = new Report();
		$view_report->agent_day_index();
	}elseif ($_GET['report']=='queue_report_interval') {
    $view_report = new Report();
    $view_report->queue_interval_index();    
  }elseif ($_GET['report']=='calls_report') {
    $view_report = new Report();
    $view_report->calls_index(); 
  }

}