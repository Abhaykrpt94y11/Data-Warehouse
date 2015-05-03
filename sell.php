<!DOCTYPE html>
<html>
<head>
	<title>Sell</title>
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
</ul>

<br><br>

<div align="center" ; overflow: "hidden";>
	
	<div style="width: 400px; float: right;">
		<form action="sale_success.php" method="post">
		Enter Sale Details</br>
		Product Name:<br>
		Milk: <input type="radio" value="1" name="pname"><br>
		Eggs: <input type="radio" value="2" name="pname"><br>
		Bread: <input type="radio" value="3" name="pname"><br>
		Juice: <input type="radio" value="4" name="pname"><br>

		</br>
		Quantity: <input type="number" name="quantity"></br>
		Store ID 
		North Store : <input type="radio" value="1" name="store"><br>
		East Store: <input type="radio" value="2" name="store"><br>
		West Store: <input type="radio" value="3" name="store"><br>
		South Store: <input type="radio" value="4" name="store"><br>

		<input type="submit" value="Sell">
		</form>
	</div>
    <div style="width: 530px; float: right;"> 
    	<?php
    	session_start();
$con=mysqli_connect("localhost","root","root","warehouse");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  	$i = 0;
  	$sql = "SELECT * FROM requests WHERE fulfilled=0";
	$result = mysqli_query($con,$sql);

	echo "<b>Pending Requests From Stores</b><br><br>";
	echo "<table border='1'>";
	echo "<tr><th>Request id</th><th>Store Name</th><th>Product</th><th>Quantity</th>"; 
	//store_ID, product_name, quantity
	while($rows = mysqli_fetch_array($result)) {
	if($rows['store_ID']==1)
		$p = "Store 1";
	else if	($rows['store_ID']==2)
		$p = "Store 2";
	else if	($rows['store_ID']==3)
		$p = "Store 3";
	else
		$p = "Store 4";		
	echo "<tr>";
	echo "<td>".$rows['ID']."</td>";
	echo "<td>".$p."</td>";
	echo "<td>".$rows['product_name']."</td>";
	echo "<td>".$rows['quantity']."</td>";
	echo "</tr>";

	$data[$i] = $rows['ID'];
	$i = $i+1;
	}
	echo "</table>";

	mysqli_close($con);

 ?> 
    </div>
    <div style="margin-left: 200px;">
    <form action="sell_success2.php" method="post">
    Request ID: 
    <?php
		echo'<select name="id">'; 
		foreach($data as $word){ 
		    echo'<option value="'.$word.'">'.$word.'</option>'; 
		} 
		echo'</select>';
    ?>	
    	<br><input type="submit" value="Fulfill request">
    </form>
    <?php
    	if(isset($_SESSION['fulfilled']))
    		echo "Request fulfilled<br>";
    		echo "Time Taken :".$_SESSION['fulfilled'];
    	unset($_SESSION['fulfilled']);	 
     ?>
    </div>
</form>

</div>

</body>
</html>