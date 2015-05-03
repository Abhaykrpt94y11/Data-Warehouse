<?php

$name =  $_POST['pname'];
$quantity = $_POST['quantity'];
$mfg_date = mysql_real_escape_string($_POST['mfgdate']);
$mfg_date = strtotime( $mfg_date );
$mfg_date = date('Y-m-d',$mfg_date);
$cdate = date('Y-m-d');

if(strcmp($name,"MILK")==0)
  $pid=1;
else if(strcmp($name,"EGGS")==0)
  $pid=2;
else if(strcmp($name,"BREAD")==0)
  $pid=3;
else if(strcmp($name,"JUICE")==0)
  $pid=4;

$con=mysqli_connect("localhost","root","root","warehouse");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


  $sql = "INSERT INTO central_storage(product_ID ,quantity,mfg_date, t_stamp )
  					 values($pid,$quantity,'$mfg_date','$cdate')";

  if (mysqli_query($con,$sql)){
  echo "Data entered successfully <br/>";
  }
else{
  echo "Error entering data " . mysqli_error($con);
  }
  $sql = "SELECT MAX(ID) FROM central_storage WHERE product_ID='$pid' GROUP BY product_ID";
  $result = mysqli_query($con,$sql);
  $rows = mysqli_fetch_array($result);
  $x = $rows['MAX(ID)'];  
 // $x = mysqli_insert_id();
  echo $x;
  if($pid == 1)
      $batch = "M".$x;
    else if($pid == 2 )
      $batch = "E".$x;
    else if($pid == 3 )
      $batch = "B".$x;
    else if($pid == 4 )
      $batch = "J".$x;

    $sql = "UPDATE central_storage SET batch_no='$batch' WHERE ID='$x'";

     if (mysqli_query($con,$sql)){
  echo "Batch Updated successfully <br/>";
  }
else{
  echo "Error updating batch " . mysqli_error($con);
  }

  header("Location:storage.php")

?>