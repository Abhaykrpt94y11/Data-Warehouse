<?php

$cdate = date('Y-m-d');
$pid =(int) ($_POST['pname']);
$demand = (int)($_POST['quantity']);
$initial_demand = $demand;
$storeid = (int)($_POST['store']);

if($storeid==1)
	$storename = "store_1";
else if($storeid==2)
	$storename = "store_2";
else if($storeid==3)
	$storename = "store_3";
else if($storeid==4)
	$storename = "store_4";

if($pid==1)
	$p_name = "Milk";
else if($pid==2)
	$p_name = "Eggs";
else if($pid==3)
	$p_name = "Bread";
else if($pid==4)
	$p_name = "Juice";

$con=mysqli_connect("localhost","root","root","warehouse");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql5 = "SELECT * from product_details WHERE product_ID=$pid";
$result = mysqli_query($con,$sql5);
while($rows = mysqli_fetch_array($result))
	$shelf_life = $rows['period'];

$sql = "SELECT * FROM central_storage WHERE valid=1 and product_ID=$pid ORDER BY t_stamp";
$result = mysqli_query($con,$sql);

while($rows = mysqli_fetch_array($result)){
	$cur_row_quantity = $rows['quantity'];
	$mfg_date = $rows['mfg_date'];
	$expiry_date = date('Y-m-d', strtotime((string)$mfg_date.' + '.(string)$shelf_life.' days'));
	$batch_no = $rows['batch_no'];
	if($demand >= $cur_row_quantity){
		$demand = $demand - $cur_row_quantity;
		$sql2 = "UPDATE central_storage SET quantity=0 WHERE ID=".$rows['ID']."";
		$sql4 = "INSERT INTO $storename (product_name,quantity,batch_no,expiry_date,received_date) 
		VALUES ('$p_name','$cur_row_quantity','$batch_no','$expiry_date','$cdate')";
	}
	else{
		$new_quantity = $cur_row_quantity - $demand;
		$sql2 = "UPDATE central_storage SET quantity=$new_quantity WHERE ID=".$rows['ID']."";
		$sql4 = "INSERT INTO $storename (product_name,quantity,batch_no,expiry_date,received_date) 
		VALUES ('$p_name','$demand','$batch_no','$expiry_date','$cdate')";
		$demand = 0;
	}
	if (mysqli_query($con,$sql2)){
	  echo "Central Store updated successfully!<br>";
	  }
	else{
	  echo "Error in updating Central Store: " . mysqli_error($con);
	  }
	if (mysqli_query($con,$sql4)){
	  echo "Corresponding Branch Store updated successfully!<br>";
	  }
	else{
	  echo "Error in updating Corresponding Branch Store: " . mysqli_error($con);
	  }
	 if($demand==0)
	 	break; 
}

$sql3 = "INSERT INTO sales(store_ID,product_ID,quantity,t_stamp) values($storeid,$pid,$initial_demand,'$cdate')";
if (mysqli_query($con,$sql3))
	echo "Sales recorded in log successfully <br/>";
else
	echo "Error recording sales in log " . mysqli_error($con);	  

mysqli_close($con);
header('Location:sell.php');
?>