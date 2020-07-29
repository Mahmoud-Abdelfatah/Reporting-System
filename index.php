<?php

include_once 'core/init.php';

if (!isset($_SESSION['user_data'])) {
	$login = new Auth();
    $login->index();
}else

{
	//return header('location:controller/Report_controller.class.php?report=queue_report');
	return header('location:view/Dashbord.php');
}



?>