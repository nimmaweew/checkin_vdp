<?php 
include('connect.php');
date_default_timezone_set("Asia/Bangkok");

		$timey = date('Y');

        $timem = date('m');

        $timed = date('d');

        $slad = "-";

        $time = $timey.$slad.$timem.$slad.$timed;
$sql = "select  * from tb_count where date = '$time' ";
$result = mysqli_query($conn,$sql);
$rowcount = mysqli_num_rows($result);
if($rowcount > 0){
	$row = mysqli_fetch_assoc($result);
	$no = $row['count'];
	$date = $row['date'];
	$no++;
	$sql = "update tb_count set count = '$no' where date = '$date'";
	if(mysqli_query($conn,$sql)){
		echo('update success');
	}
	else{
		echo('update false');
	}
}else{
	$no = '1';
	$sql = "INSERT INTO `tb_count`(`date`, `count`) VALUES ('$time','$no')";
	if(mysqli_query($conn,$sql)){
		echo ('insert success');
	}else{
		echo ('insert false');
	}
}
?>