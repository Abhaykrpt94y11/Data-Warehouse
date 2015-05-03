<!DOCTYPE html>
<html>
<head>
	<title>Statistics</title>
	<div align="center">
  <img src="dbms.jpg"/>
</div>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

      	<?php
      		$sdate = $_POST['sdate'];
      		$edate = $_POST['edate'];
      	//	echo $sdate;
      	//	echo $edate;
      		$con=mysqli_connect("localhost","root","root","warehouse");
			// Check connection
			if (mysqli_connect_errno())
			  {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }

			  $sql = "SELECT product_ID,rate FROM product_details";
			  $result = mysqli_query($con,$sql);
			  while($rows = mysqli_fetch_array($result)) {
			  		if($rows['product_ID']==1)
						$r[1] = $rows['rate'];
					else if	($rows['product_ID']==2)
						$r[2] = $rows['rate'];
					else if	($rows['product_ID']==3)
						$r[3] = $rows['rate'];
					else
						$r[4] = $rows['rate'];	
			  }
			  $p[1] =0;
			  $p[2] =0;
			  $p[3] =0;
			  $p[4] =0;
			  $l[1] =0;
			  $l[2] =0;
			  $l[3] =0;
			  $l[4] =0;

			  $sql = "SELECT SUM(quantity),product_ID FROM sales WHERE t_stamp >= '$sdate' and t_stamp <= '$edate' GROUP BY product_ID";
			  $result = mysqli_query($con,$sql);

			  while($rows = mysqli_fetch_array($result)) {
			  		if($rows['product_ID']==1)
						$p[1] = $rows['SUM(quantity)'] * $r[1];
					else if	($rows['product_ID']==2)
						$p[2] = $rows['SUM(quantity)'] * $r[2];
					else if	($rows['product_ID']==3)
						$p[3] = $rows['SUM(quantity)'] * $r[3];
					else
						$p[4] = $rows['SUM(quantity)'] * $r[4];	
			  }

			  $sql = "SELECT * FROM central_storage WHERE valid=0 and quantity!=0 GROUP BY product_ID";
      		  $result = mysqli_query($con,$sql);
      		  while($rows = mysqli_fetch_array($result)) {

      		  		$sql_nested = "SELECT * from product_details WHERE product_ID=".$rows['product_ID']."";
					$result_nested = mysqli_query($con,$sql_nested);
					while($rows_nested = mysqli_fetch_array($result_nested))
						$shelf_life = $rows_nested['period'];

					$mfg_date = $rows['mfg_date'];
					$expiry_date = date('Y-m-d', strtotime((string)$mfg_date.' + '.(string)$shelf_life.' days'));


					if(strtotime($sdate) <= strtotime($expiry_date) and strtotime($edate) >= strtotime($expiry_date)){
				  		if($rows['product_ID']==1)
							$l[1] = $l[1] + $rows['quantity'] * $r[1];
						else if	($rows['product_ID']==2)
							$l[2] = $l[2] + $rows['quantity'] * $r[2];
						else if	($rows['product_ID']==3)
							$l[3] = $l[3] + $rows['quantity'] * $r[3];
						else
							$l[4] = $l[4] + $rows['quantity'] * $r[4];	
			  		}
			  }
			  mysqli_close($con);
      	?>
      	var data2 = [
          ['Products', 'Profit', 'Loss'],
          ['Milk',  <?php echo $p[1] ?>,  <?php echo $l[1] ?>],
          ['Eggs',  <?php echo $p[2] ?>,  <?php echo $l[2] ?>],
          ['Bread', <?php echo $p[3] ?>,  <?php echo $l[3] ?>],
          ['Juice', <?php echo $p[4] ?>,  <?php echo $l[4] ?>]
        ];
        var data = google.visualization.arrayToDataTable(data2);
        var dis = 'Profit/ Loss between ';
        dis = dis.concat("<?php echo $sdate ?>");
        dis = dis.concat(" and  ");
        dis = dis.concat("<?php echo $edate ?>"); 
        var options = {
          title: dis,
          vAxis: {title: 'Products',  titleTextStyle: {color: 'red'}},
          hAxis: {title: 'Cost',  titleTextStyle: {color: 'blue'}}
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <style>
    .wrapper{position:relative;}
    .right,.left{width:50%; position:absolute;}
    .right{right:0;}
    .left{left:0;}
    </style>
	<style type="text/css" media="screen">@import "tabs.css";</style>
</head>
<body>

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
<div align="center"; style="width:100 %" overflow: "hidden";>
<div class="right" id="chart_div" style="width: 600px; height: 400px;" float="right";></div>
<div class="left" style="width: 930px; float:left;"> 
<form action="stats_refined.php" method="post">
	 	<b>Profit/Loss Between:</b><br>
	 	Start Date: <input type="date" name="sdate"></br>
	 	End Date : <input type="date" name="edate"></br>
	 	<input type="submit" value="find"></br>
	 </form>
<div align="left" style="width: 1130px; float:left;">
	<?php 
		$con=mysqli_connect("localhost","root","root","warehouse");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
		$sql = "SELECT * FROM product_details";
	  $result = mysqli_query($con,$sql);
	  echo "<b>Product Details</b><br>";
		echo "<table border='1'>";
		echo "<tr><th>Product Name</th><th>Rate</th><th>Shelf Life</th></tr>";
	  while($rows = mysqli_fetch_array($result)) {		
			echo "<tr>";
			echo "<td>".$rows['product_name']."</td>";
			echo "<td>".$rows['rate']."</td>";
			echo "<td>".$rows['period']."</td>";
//					echo "<td>".$rows['t_stamp']."</td>";
			echo "</tr>";
	  }
	  echo "</table><br><br>";
	  mysqli_close($con);
	 ?>
	 
</div>
<div align="left" style="width: 1130px; float:left;">
<?php
$con=mysqli_connect("localhost","root","root","warehouse");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql = "SELECT * FROM sales WHERE t_stamp >= '$sdate' and t_stamp <= '$edate'";
$result = mysqli_query($con,$sql);
echo "<b>Sales made by the Central Store between  ".$sdate." and ".$edate."</b><br>";
echo "<table border='1'>";
echo "<tr><th>Branch Name</th><th>Product Sold</th><th>Quantity Sold</th><th>Time Stamp</th></tr>";
while($rows = mysqli_fetch_array($result)) {
	if($rows['store_ID']==1)
		$s = "North Store";
	else if($rows['store_ID']==2)
		$s = "East Store";
	else if($rows['store_ID']==3)
		$s = "West Store";
	else if($rows['store_ID']==4)
		$s = "South Store";
	if($rows['product_ID']==1)
		$p = "Milk";
	else if	($rows['product_ID']==2)
		$p = "Eggs";
	else if	($rows['product_ID']==3)
		$p = "Bread";
	else
		$p = "Juice";		
	echo "<tr>";
	echo "<td>".$s."</td>";
	echo "<td>".$p."</td>";
	echo "<td>".$rows['quantity']."</td>";
	echo "<td>".$rows['t_stamp']."</td>";
	echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</div>
</div>
</div>
</body>
</html>