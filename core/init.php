<?php

session_start();

$GLOBALS['config'] = array(
  'mysql' => array(
     'host' => '192.168.100.139',
     'username' => 'aheevaccs',
     'password' =>'aheevaccs',
     'db' => 'aheevaccs'
  )
 );


spl_autoload_register(function($class){

	$array = explode('\\', getcwd());
    if (in_array('controller', $array)) {
	 	  require_once $class.'_controller.class.php';
        }
     elseif (in_array('view', $array)) {
        	require_once '../../controller/'.$class.'_controller.class.php';
        }else{
           require_once 'controller/'.$class.'_controller.class.php';
        }  

});
