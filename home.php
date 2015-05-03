<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<style type="text/css" media="screen">@import "tabs.css";</style>
</head>
<body>

<div align="center">
	<img src="dbms.jpg"/>
</div>

<ul id="tab_ul" class="tabs">
<li><a href="home.php">Home</a></li>
<li><a href="incoming.php">Incoming</a></li>
<li><a href="stats.php">Stats</a></li>
<li><a href="sell.php">Sell</a></li>
<li><a href="storage.php">Storage</a></li>
<li><a href="store1.php">Store_1</a></li>
<li><a href="store2.php">Store_2</a></li>
<li><a href="store3.php">Store_3</a></li>
<li><a href="store4.php">Store_4</a></li>
</ul><br><br>




<?php
//Time of Querry 
//Explain all Querry 
//explain Indexing required or not ?
$con=mysqli_connect("localhost","root","root","warehouse");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$msc=microtime(true);
$sql = "SELECT * FROM central_storage WHERE valid=1";
$result = mysqli_query($con,$sql);

echo "<div  align=\"right\";overflow: hidden;\">";
echo "<div style=\"width: 550px; float: left;\">";
	echo "<b>Products going to expire in the next ONE WEEK</b><br>";
echo "<table border='1'>";
echo "<tr><th>Product ID</th><th>Quantity</th><th>Batch Number</th><th>Expiry Date</th></tr>";
while($rows = mysqli_fetch_array($result)){
	//echo "32";
	$sql_nested = "SELECT * from product_details WHERE product_ID=".$rows['product_ID']."";
	$result_nested = mysqli_query($con,$sql_nested);
	while($rows_nested = mysqli_fetch_array($result_nested))
		$shelf_life = $rows_nested['period'];

	$mfg_date = $rows['mfg_date'];
	$expiry_date = date('Y-m-d', strtotime((string)$mfg_date.' + '.(string)$shelf_life.' days'));

	$cdate = date('Y-m-d');

	// updating central storage if product is expired
	$sqlE = "UPDATE central_storage SET valid=0 WHERE ID=".$rows['ID']."";
	
	if($cdate > $expiry_date){
		mysqli_query($con,$sqlE);
		//echo "done";
	}
	$one_week = date('Y-m-d', strtotime((string)$cdate.' + 7 days'));
	#$two_week = date('Y-m-d', strtotime((string)$cdate.' + 14 days'));
	#$three_week = date('Y-m-d', strtotime((string)$cdate.' + 21 days'));
	#$four_week = date('Y-m-d', strtotime((string)$cdate.' + 28 days'));
	if($cdate <= $expiry_date){
		if ($expiry_date<$one_week) {
			echo "<tr>";
			echo "<td>".$rows['product_ID']."</td>";
			echo "<td>".$rows['quantity']."</td>";
			echo "<td>".$rows['batch_no']."</td>";
			echo "<td>".(string)$expiry_date."</td>";
			echo "</tr>";
		}
	}
}
echo "</table><br>";
$msc=microtime(true)-$msc;
echo "Time Taken: ".$msc.' seconds'; 

echo "</div>";
$msc = microtime(true);
echo "<div style=\"width: 550px; float: left;\">";
$sql = "SELECT * FROM central_storage WHERE valid=1";
$result = mysqli_query($con,$sql);

echo "<b>Products going to expire in the next TWO WEEKS</b><br>";
echo "<table border='1'>";
echo "<tr><th>Product ID</th><th>Quantity</th><th>Batch Number</th><th>Expiry Date</th></tr>";
while($rows = mysqli_fetch_array($result)){
	$sql_nested = "SELECT * from product_details WHERE product_ID=".$rows['product_ID']."";
	$result_nested = mysqli_query($con,$sql_nested);
	while($rows_nested = mysqli_fetch_array($result_nested))
		$shelf_life = $rows_nested['period'];

	$mfg_date = $rows['mfg_date'];
	$expiry_date = date('Y-m-d', strtotime((string)$mfg_date.' + '.(string)$shelf_life.' days'));

	$cdate = date('Y-m-d');
	#$one_week = date('Y-m-d', strtotime((string)$cdate.' + 7 days'));
	$two_week = date('Y-m-d', strtotime((string)$cdate.' + 14 days'));
	#$three_week = date('Y-m-d', strtotime((string)$cdate.' + 21 days'));
	#$four_week = date('Y-m-d', strtotime((string)$cdate.' + 28 days'));

	if ($expiry_date<$two_week) {
		echo "<tr>";
		echo "<td>".$rows['product_ID']."</td>";
		echo "<td>".$rows['quantity']."</td>";
		echo "<td>".$rows['batch_no']."</td>";
		echo "<td>".(string)$expiry_date."</td>";
		echo "</tr>";
	}
}
echo "</table><br>";
$msc=microtime(true)-$msc;
echo "Time Taken: ".$msc.' seconds'; 

echo "</div>";
$msc=microtime(true);
echo "<div style=\"width: 550px; float: left;\">";
$sql = "SELECT * FROM central_storage WHERE valid=1";
$result = mysqli_query($con,$sql);

echo "<b>Products going to expire in the next THREE WEEKS</b><br>";
echo "<table border='1'>";
echo "<tr><th>Product ID</th><th>Quantity</th><th>Batch Number</th><th>Expiry Date</th></tr>";
while($rows = mysqli_fetch_array($result)){
	$sql_nested = "SELECT * from product_details WHERE product_ID=".$rows['product_ID']."";
	$result_nested = mysqli_query($con,$sql_nested);
	while($rows_nested = mysqli_fetch_array($result_nested))
		$shelf_life = $rows_nested['period'];

	$mfg_date = $rows['mfg_date'];
	$expiry_date = date('Y-m-d', strtotime((string)$mfg_date.' + '.(string)$shelf_life.' days'));

	$cdate = date('Y-m-d');


	#$one_week = date('Y-m-d', strtotime((string)$cdate.' + 7 days'));
	#$two_week = date('Y-m-d', strtotime((string)$cdate.' + 14 days'));
	$three_week = date('Y-m-d', strtotime((string)$cdate.' + 21 days'));
	#$four_week = date('Y-m-d', strtotime((string)$cdate.' + 28 days'));

	if ($expiry_date<$three_week) {
		echo "<tr>";
		echo "<td>".$rows['product_ID']."</td>";
		echo "<td>".$rows['quantity']."</td>";
		echo "<td>".$rows['batch_no']."</td>";
		echo "<td>".(string)$expiry_date."</td>";
		echo "</tr>";
	}
}
echo "</table><br>";
$msc=microtime(true)-$msc;
echo "Time Taken: ".$msc.' seconds'; 
echo "</div>";
$msc=microtime(true);
echo "<div style=\"width: 550px; float: left;\">";
$sql = "SELECT * FROM central_storage WHERE valid=1";
$result = mysqli_query($con,$sql);

echo "<b>Products going to expire in the next ONE MONTH</b><br>";
echo "<table border='1'>";
echo "<tr><th>Product ID</th><th>Quantity</th><th>Batch Number</th><th>Expiry Date</th></tr>";
while($rows = mysqli_fetch_array($result)){
	$sql_nested = "SELECT * from product_details WHERE product_ID=".$rows['product_ID']."";
	$result_nested = mysqli_query($con,$sql_nested);
	while($rows_nested = mysqli_fetch_array($result_nested))
		$shelf_life = $rows_nested['period'];

	$mfg_date = $rows['mfg_date'];
	$expiry_date = date('Y-m-d', strtotime((string)$mfg_date.' + '.(string)$shelf_life.' days'));

	$cdate = date('Y-m-d');
	#$one_week = date('Y-m-d', strtotime((string)$cdate.' + 7 days'));
	#$two_week = date('Y-m-d', strtotime((string)$cdate.' + 14 days'));
	#$three_week = date('Y-m-d', strtotime((string)$cdate.' + 21 days'));
	$four_week = date('Y-m-d', strtotime((string)$cdate.' + 28 days'));

	if ($expiry_date<$four_week) {
		echo "<tr>";
		echo "<td>".$rows['product_ID']."</td>";
		echo "<td>".$rows['quantity']."</td>";
		echo "<td>".$rows['batch_no']."</td>";
		echo "<td>".(string)$expiry_date."</td>";
		echo "</tr>";
	}
}
echo "</table><br>";
$msc=microtime(true)-$msc;
echo "Time Taken: ".$msc.' seconds';
echo "</div>";
echo "</div>";





mysqli_close($con);
?>

</body>
</html>