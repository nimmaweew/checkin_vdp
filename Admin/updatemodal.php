<?php
include('connect.php');
		$seltime = $_POST['seltime'];
		$dataid = $_POST['dataid'];
		$query = "select * from tb_locat where data_id ='$dataid' ";
		$result = mysqli_query($conn,$query);
		while($row = mysqli_fetch_assoc($result)){
		if($seltime == '1'){
			$lati = $row['lati1'];
			$lon = $row['lon1'];
			$time = $row['time1'];
			$dis1 = $row['dis1r1'];
			$dis2 = $row['dis1r1'];
			$nameloc = $row['nameloc1'];
		}
		else if($seltime == '2'){
			$lati = $row['lati2'];
			$lon = $row['lon2'];
			$time = $row['time2'];
			$dis1 = $row['dis1r2'];
			$dis2 = $row['dis1r2'];
			$nameloc = $row['nameloc2'];
		}
		else if($seltime == '3'){
			$lati = $row['lati3'];
			$lon = $row['lon3'];
			$time = $row['time3'];
			$dis1 = $row['dis1r3'];
			$dis2 = $row['dis1r3'];
			$nameloc = $row['nameloc3'];
		}
		}
		$output = array($lati,$lon,$time,$dis1,$dis2,$nameloc);
		print_r($output);
?>
