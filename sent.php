

<!doctype html>

<html>

<head>

<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<title>Untitled Document</title>

</head>

<body>

<?php 
include('connect.php');

require_once 'Mobile_Detect.php';

$detect = new Mobile_Detect;

$user = $_SERVER['HTTP_USER_AGENT'];



	$array_date=explode(')',$user);

	$msg1=$array_date[0];

	$msg2=$array_date[1];



	$mobile=str_replace("(","",$msg1);

if( $detect->isiOS() ){

 list($browser, $model) = preg_split('[;]', $mobile ,2);

}

 

if( $detect->isAndroidOS() ){

 list($browser, $version, $model) = preg_split('[;]', $mobile , 3);

}

else{

	$model = $mobile;

}





	//$NAME = $mac = system('arp -an');

	//set value

	date_default_timezone_set("Asia/Bangkok");

		$timey = date('Y');

        $timem = date('m');

        $timed = date('d');

        $slad = "-";

        $time = $timey.$slad.$timem.$slad.$timed;

	


	$tel = $_POST['tel'];

	$lati = $_POST['lati'];

	$lon = $_POST['lon'];
	
	$comment = $_POST['comment'];
	
	$nameloc = $_POST['nameloc2'];

	$seltime = $_POST['Hsel_time'];
	
	//connect


	//ค้นหาจากรหัส

	

		date_default_timezone_set("Asia/Bangkok");

		$timenowh = date("G");

		$timenowm = date("i");

		$dot = ".";

		$timenowa = $timenowh.$dot.$timenowm ;

		$timenow = number_format($timenowa,2,'.','');
		
		$sql = "select * from tb_user where tel = '$tel'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		$rowcount = mysqli_num_rows($result);
	
		//ดึงข้อมูลเวลา
		//ช่วงเช้า
		$result_time_morning = mysqli_query($conn,"select * from tb_time where name = 'morning'");
		$row_time_morning = mysqli_fetch_assoc($result_time_morning);
		$time_morning_st = number_format($row_time_morning['st_time']);
		$time_morning_en = number_format($row_time_morning['en_time']);
		//ช่วงบ่าย
		$result_time_afternoon = mysqli_query($conn,"select * from tb_time where name = 'afternoon'");
		$row_time_afternoon = mysqli_fetch_assoc($result_time_afternoon);
		$time_afternoon_st = number_format($row_time_afternoon['st_time']);
		$time_afternoon_en = number_format($row_time_afternoon['en_time']);
		//ช่วงเย็น
		$result_time_evening = mysqli_query($conn,"select * from tb_time where name = 'evening'");
		$row_time_evening = mysqli_fetch_assoc($result_time_evening);
		$time_evening_st = number_format($row_time_evening['st_time']);
		$time_evening_en = number_format($row_time_evening['en_time']);
		if($rowcount > 0 ){
			$id = $row['id'];
			$grop = $row['grop'];
		if($timenow < $time_morning_st){
			echo "<script>window.location ='results3.php?id=$id'</script>";
		}
		else if($timenow >= $time_morning_st && $timenow < $time_morning_en){
				echo "<script>window.location='update.php?id=$id&grop=$grop&lati=$lati&lon=$lon&model=$model&no=0&comment=$comment&nameloc=$nameloc&seltime=$seltime&num=1'</script>";
		}
		else if($timenow >= $time_afternoon_st && $timenow < $time_afternoon_en){
			echo "<script>window.location='update.php?id=$id&grop=$grop&lati=$lati&lon=$lon&model=$model&no=0&comment=$comment&nameloc=$nameloc&seltime=$seltime&num=2'</script>";
		}
		else if($timenow >= $time_evening_st && $timenow <= $time_evening_en){
			echo "<script>window.location='update.php?id=$id&grop=$grop&lati=$lati&lon=$lon&model=$model&no=0&comment=$comment&nameloc=$nameloc&seltime=$seltime&num=3'</script>";
		}
		else if($timenow > $time_evening_en){
			echo "<script>window.location ='results4.php?id=$id'</script>";
		}else{
			echo "<script>window.location ='results3.php?id=$id'</script>";
		}
		//if($stset > 0)

		//{

			//echo "<script>window.location='update.php?id=$id&grop=$grop&lati=$lati&lon=$lon&model=$model&no=0'</script>";

			//echo '<script>alert("รอบเช้า")</script>';

			/*if($stone > 0)

			{

				//echo '<script>alert("ยังไม่ถึงเวลาเช็คชื่อรอบเช้า")</script>';

				echo "<script>window.location='results3.php?id=$id'</script>";

			}

			else if($sttwo > 0)

			{

				//echo '<script>alert("เลยเวลาเช็คชื่อรอบเช้า")</script>';

				echo "<script>window.location='results4.php?id=$id'</script>";

			}

			else

			{

				//echo '<script>alert("เช็คชื่อรอบเช้า")</script>';

				echo "<script>window.location='update.php?id=$id&grop=$grop&lati=$lati&lon=$lon&model=$model&no=0'</script>";

			}*/

		//}

		//else if ($stset <= 0)

		//{

			//echo "<script>window.location='update.php?id=$id&grop=$grop&lati=$lati&lon=$lon&model=$model&no=0'</script>";

			//echo '<script>alert("รอบบ่าย")</script>';

			/*if($stthree > 0)

			{

				//echo '<script>alert("ยังไม่ถึงเวลาเช็คชื่อรอบบ่าย")</script>';

				echo "<script>window.location='results3.php?id=$id'</script>";

			}

			else if ($stfour > 0)

			{

				//echo "<script>window.location='results4.php?id=$id'</script>";

				echo '<script>alert("เลยเวลาเช็คชื่อรอบบ่าย")</script>';

			}

			else

			{

				//echo "<script>alert('เช็คชื่อรอบบ่าย')</script>";

				echo "<script>window.location='update.php?id=$id&grop=$grop&lati=$lati&lon=$lon&model=$model&no=1'</script>";

			}*/

		//}
	}
	//ไม่พบข้อมูลที่ลงทะเบียน
	else

		{

			echo"<script>alert('ไม่พบข้อมูล กรุณาตรวจตอบสอบเบอร์มือถืออีกครั้งหรือติดต่อแอดมินเพื่อแจ้งปัญหา');</script>";

			echo"<script>window.location='Home.html';</script>";

		}


	$conn->close();



?>

<form action="../Register.html" method="post" id="sent">

<input type="hidden" name="ID" id="id" value="<?php echo $_POST['tel']; ?>">

<input type="hidden" value="<?php echo $_POST['lati'];?>">

<input type="hidden" value="<?php echo $_POST['lon']; ?>">

</form>

</body>

</html>