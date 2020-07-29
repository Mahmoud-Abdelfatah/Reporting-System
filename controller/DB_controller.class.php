<?php


class DB{
  
  private static $_instance = null;
  private static $_conn= null;


 private function __construct()
 {
  try{
     self::$_conn = mysqli_connect(
      Config::get('mysql/host'),
      Config::get('mysql/username'),
      Config::get('mysql/password'),
      Config::get('mysql/db')
      );
  }catch(Exception $e)
  {
    echo $e->errorMessage();
  }
 }
  // function connect($localhost,$username,$password,$dbname)
  // {
  //   $conn = mysqli_connect($localhost,$username,$password,$dbname);

  //   if($conn)
  //   {
  //     return $conn;
  //   }else
  //   {
  //     die("failed to connect to databas:%s\n".$conn->error);
  //   }


  // }

public static function getInstance(){
  if (!isset(self::$_instance)) {
    
    self::$_instance = new DB();
  }
   return self::$_instance;
   
}
  public function select($columns=array(),$table,$condetion)
  {

    if($columns=='*')
    {
      $selected_col =$columns;
    }elseif(strpos($columns,'distinct')!==false)
    {
     $selected_col =$columns;
    }elseif(strpos($columns,',')!==false)
    {
      $selected_col =$columns;
    }
    else{$selected_col=implode(',',$columns);}





    if ($condetion=='') {
      $sql = "SELECT $selected_col from $table";
    }else
    {
     // $order_by_str = implode(',', $order_by);
      $sql = "SELECT $selected_col from $table where $condetion ";

    }

    $data = array();
    $result = mysqli_query(self::$_conn, $sql);
    if($row=mysqli_num_rows($result)>0)
    {
      while ($row = mysqli_fetch_assoc($result)) {

        $data[]=$row;
//echo $row['LAST_NAME'];

      }
      return $data;
    }else{
      return false;
    }

  } 


public function insert($table,$columns=array(),$values=array(),$condetion)
{
  $selected_col=implode(',',$columns);
  $inserted_val = implode("','",$values);
   if ($condetion=='') {
       $sql_insert = "INSERT INTO $table ($selected_col) VALUES ($inserted_val)";
             

    }else
    {
      $sql_insert = "INSERT INTO $table ($selected_col) VALUES ($inserted_val) where $condetion ";

    }
     mysqli_query(self::$_conn, $sql_insert);
}

public function update($table,$values,$condetion)
{
   $sql_update = "UPDATE $table SET $values where $condetion";

  mysqli_query(self::$_conn, $sql_update);
}

}
