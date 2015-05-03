<?php
$pid =(int) ($_POST['pname']);
$demand = $_POST['quantity'];
$store = (int)($_POST['store']);

$con=mysqli_connect("localhost","root","root","warehouse");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$sql = "SELECT * FROM central_storage WHERE value=1 and product_ID=pid ORDER BY t_stamp";
$result = mysqli_query($con,$sql);

while($demand>0){
	$rows = mysqli_fetch_array($result);
	if($demand >= $rows['quantity']){
		$demand = $demand - $rows['quantity'];
		$sql2 = "UPDATE central_storage SET quantity=0 and valid=0 WHERE ID=$rows['ID']";
	}
	else{
			$new_quantity = $rows['quantity']-$demand;
			$sql2 = "UPDATE central_storage SET quantity=$new_quantity WHERE ID=$rows['ID']";
			$demand = 0;
	}
	if (mysqli_query($con,$sql2)){
	  echo "Data updated successfully <br/>";
	  }
	else{
	  echo "Error updating data " . mysqli_error($con);
	  }
}
mysqli_close($con);

?>