<?php
session_start();
$storeid =      $_POST['storeID']; 
$quantity = $_POST['quantity'];
$product = $_POST['pname'];
if($quantity <= 0){
	$_SESSION['no'] = "true";
	if($storeid==1)
			header("Location:store1.php");
		else if($storeid==2)
			header("Location:store2.php");
		else if($storeid==3)
			header("Location:store3.php");
		else if($storeid==4)
			header("Location:store4.php");
}
else{
if($storeid==1)
	$storename = "store_1";
else if($storeid==2)
	$storename = "store_2";
else if($storeid==3)
	$storename = "store_3";
else if($storeid==4)
	$storename = "store_4";

$con=mysqli_connect("localhost","root","root","warehouse");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql = "INSERT INTO requests ( store_ID, product_name, quantity)
					VALUES ('$storeid','$product','$quantity') ";  

	if (mysqli_query($con,$sql)){
	  echo "Product Requested !<br>";
	  }
	else{
	  echo "Error in product Request: " . mysqli_error($con);
	  }

	  $_SESSION['s1'] = "yes";
		if($storeid==1)
			header("Location:store1.php");
		else if($storeid==2)
			header("Location:store2.php");
		else if($storeid==3)
			header("Location:store3.php");
		else if($storeid==4)
			header("Location:store4.php");
}	  
?>