<?php
	
	$data = $_POST['data'];
	//echo mt_rand($min,$max);
	$i=0;

	$cdate = date('Y-m-d');
	$min = 500;
	$max = 5000;		// max and min quantities of a batch

	$dmin = 1;			// manufacturing = cdate - rand(dmin,dmax);
	$dmax = 30;

	$con=mysqli_connect("localhost","root","root","warehouse");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$sql = "TRUNCATE TABLE central_storage";
	if(mysqli_query($con,$sql))
	echo " truncating table<br>";

	$sql = "TRUNCATE TABLE sales";
	if(mysqli_query($con,$sql))
	echo " truncating table<br>";

	$sql = "TRUNCATE TABLE store_1";
	if(mysqli_query($con,$sql))
	echo " truncating table<br>";

	$sql = "TRUNCATE TABLE store_2";
	if(mysqli_query($con,$sql))
	echo " truncating table<br>";

	$sql = "TRUNCATE TABLE store_3";
	if(mysqli_query($con,$sql))
	echo " truncating table<br>";

	$sql = "TRUNCATE TABLE store_4";
	if(mysqli_query($con,$sql))
	echo " truncating table<br>";

	$sql = "TRUNCATE TABLE requests";
	if(mysqli_query($con,$sql))
	echo " truncating table<br>";
	
	for($i=1;$i<=$data;$i=$i+1){
		$pid = mt_rand(1,4);
		$quantity = mt_rand($min,$max);
		$life = mt_rand($dmin,$dmax);
		$mfg_date = $date = date('Y-m-d',strtotime((string)$cdate.' - '.(string)$life.' days'));
		if($pid == 1)
			$batch = "M".(string)$i;
		else if($pid == 2 )
			$batch = "E".(string)$i;
		else if($pid == 3 )
			$batch = "B".(string)$i;
		else if($pid == 4 )
			$batch = "J".(string)$i;

		$sql = "INSERT INTO central_storage(product_ID ,quantity,batch_no,mfg_date, t_stamp )
  					 values($pid,$quantity,'$batch','$mfg_date','$cdate')";
  		if (!mysqli_query($con,$sql)){
  			echo "error";
  		}	
	}

	mysqli_close($con);

	header("Location:incoming.php");
?>