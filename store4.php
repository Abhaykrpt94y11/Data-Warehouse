<!DOCTYPE html>
<head>
  <title>Branch No. 4</title>
  <style type="text/css" media="screen">@import "tabs.css";</style>
</head>
<body>
<div align="center">
  <img src="dbms.jpg"/>
</div>
<ul id="tab_ul" class="tabs">
<li><a href="home.php">Home</a></li>
</ul><br><br>

<?php
session_start();
$con=mysqli_connect("localhost","root","root","warehouse");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$cdate = date('Y-m-d');
$sql="SELECT * FROM store_4 WHERE expiry_date >= '$cdate'";
$result = mysqli_query($con,$sql);

echo "<b>Products Present in Branch #4</b><br>";
echo "<table border='1'>";
echo "<tr><th>Product Name</th><th>Quantity</th><th>Batch Number</th><th>Expiry Date</th></tr>";
while ($rows = mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td>".$rows['product_name']."</td>";
	echo "<td>".$rows['quantity']."</td>";
	echo "<td>".$rows['batch_no']."</td>";
	echo "<td>".$rows['expiry_date']."</td>";
	echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
<div align="center">
  <form action="rsuccess.php" method="post">
  		Request To Central Store</br><br>
  		Store ID <input type="number" readonly value="4" name="storeID"  ><br><br>
		Product Required<br>
					Milk: <input type="radio" value="MILK" name="pname">
					Eggs: <input type="radio" value="EGGS" name="pname">
					Bread: <input type="radio" value="BREAD" name="pname">
					Juice: <input type="radio" value="JUICE" name="pname"><br><br>
		Quantity: <input type="number" name="quantity"></br><br>
		<input type="submit" value="Request">
  </form>
</div>

<?php
  	if(isset($_SESSION['s1']))
  		echo "Product Requested";
  	unset($_SESSION['s1']);
  	if(isset($_SESSION['no']))
  		echo "Quantity must be greater than zero";
  	unset($_SESSION['no']);
  ?>
</body>
</html>