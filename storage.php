<!DOCTYPE html>
<html>
<head>
	<title>Storage</title>
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
<div style="width: 100%; overflow: hidden;">
	<div style="width: 500px; float: right;">
	<p><b>Purchase</b></p>
	<form action="isuccess.php" method="post">
	Enter Product Details</br>
	Product Name:<br>
	Milk: <input type="radio" value="MILK" name="pname"><br>
	Eggs: <input type="radio" value="EGGS" name="pname"><br>
	Bread: <input type="radio" value="BREAD" name="pname"><br>
	Juice: <input type="radio" value="JUICE" name="pname"><br>

	</br>
	Quantity: <input type="number" name="quantity"></br>
	Manufacturing Date <input type="date" name="mfgdate"></br>
	<input type="submit" value="purchase">

	</form>
	</div>
	<div style="width: 630px; float: right;"> 

	<?php
	$con=mysqli_connect("localhost","root","root","warehouse");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	$cdate = date('Y-m-d');
	$sql = "UPDATE central_storage SET valid=0 WHERE quantity=0";
	if(!mysqli_query($con,$sql))
		echo "Error updating data " . mysqli_error($con);

	$sql = "SELECT * FROM central_storage WHERE valid=1";
	$result = mysqli_query($con,$sql);
	echo "<b>Products In Central Storage</b><br>";
	echo "<table border='1'>";
	echo "<tr><th>Product Name</th><th>Quantity</th><th>Batch Number</th><th>MFG Date</th></tr>";
	while($rows = mysqli_fetch_array($result)) {
	if($rows['product_ID']==1)
		$p = "Milk";
	else if	($rows['product_ID']==2)
		$p = "Eggs";
	else if	($rows['product_ID']==3)
		$p = "Bread";
	else
		$p = "Juice";		
	echo "<tr>";
	echo "<td>".$p."</td>";
	echo "<td>".$rows['quantity']."</td>";
	echo "<td>".$rows['batch_no']."</td>";
	echo "<td>".$rows['mfg_date']."</td>";
	echo "</tr>";
	}
	echo "</table>";

	mysqli_close($con);
	?>
	</div>
	<div>
		<?php
			$con=mysqli_connect("localhost","root","root","warehouse");
			// Check connection
			if (mysqli_connect_errno())
			  {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
			  $sql = "SELECT SUM(quantity),product_ID FROM central_storage WHERE valid=1 GROUP BY product_ID";
			  $result = mysqli_query($con,$sql);

			  echo "<b>Total Quantity</b><br>";
			  echo "<table border='1'>";
			  echo "<tr><th>Product Name</th><th>Quantity</th></tr>";

			  while($rows = mysqli_fetch_array($result)) {
			//  	echo $rows['SUM(quantity)']."<br>";
			  	if($rows['product_ID']==1)
					$p = "Milk";
				else if	($rows['product_ID']==2)
					$p = "Eggs";
				else if	($rows['product_ID']==3)
					$p = "Bread";
				else
					$p = "Juice";		
				echo "<tr>";
				echo "<td>".$p."</td>";
				echo "<td>".$rows['SUM(quantity)']."</td>";
				echo "</tr>";
			  }
		 ?>
	</div>
</div>

</body>
</html>