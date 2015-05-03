<!DOCTYPE html>
<html>

<head>
	<title>Incoming</title>
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
<div align="center">
	Goto Storage for normal Purchasing: <a href="storage.php">Storage</a></br><br>

	<form align="center" action="random.php" method="post">
		Clear and Fill Central Storage: <br><br>
		Number Of Entries in Central Storage:
		<input type="number" name="data"><br>
		<input type="submit" value="Generate">
	</form>
	<?php
		$life = 10;
		$date = date('Y-m-d');
		$date = date('Y-m-d',strtotime((string)$date.' - '.(string)$life.' days'));
		//date_sub($date, date_interval_create_from_date_string('10 days'));
		echo $date;
	?>
</div>
</body>
</html>

