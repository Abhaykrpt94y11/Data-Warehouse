<?php
$p[1] = "MILK";
$p[2] = "EGGS";
$p[3] = "BREAD";
$p[4] = "JUICE";

$rate[1] = 30;
$rate[2] = 50;
$rate[3] = 20;
$rate[4] = 70;
// period is in days probably
$period[1] = 5;
$period[2] = 20;
$period[3] = 10;
$period[4] = 15;


$con=mysqli_connect("localhost","root","root","warehouse");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql = "TRUNCATE TABLE product_details";
  if(mysqli_query($con,$sql))
    echo " truncating table<br>";

  $sql1 = "INSERT INTO product_details(product_ID,product_name,rate,period)
  			VALUES ('1','$p[1]','$rate[1]','$period[1]')";
  $sql2 = "INSERT INTO product_details(product_ID,product_name,rate,period)
  		  VALUES ('2','$p[2]','$rate[2]','$period[2]')";
  $sql3 = "INSERT INTO product_details(product_ID,product_name,rate,period)
  			VALUES ('3','$p[3]','$rate[3]','$period[3]')";
  $sql4 = "INSERT INTO product_details(product_ID,product_name,rate,period)
  		  VALUES ('4','$p[4]','$rate[4]','$period[4]')";

  if(mysqli_query($con,$sql1))
  	echo "data 1<br>";
  if(mysqli_query($con,$sql2))
  	echo "data 2<br>";
  if(mysqli_query($con,$sql3))
  	echo "data 3<br>";
  if(mysqli_query($con,$sql4))
  	echo "data 4<br>";

  mysqli_close($con);

?>