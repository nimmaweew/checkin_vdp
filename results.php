<?php 

	date_default_timezone_set("Asia/Bangkok");

		$timey = date('Y');

        $timem = date('m');

        $timed = date('d');

        $slad = "-";

        $time = $timey.$slad.$timem.$slad.$timed;
include('connect.php');

	
	if(isset($_POST['id'])){
		$id = $_POST['id'];		
	}else{
		echo "<script>alert('กรุณาเช็คชื่อตามระบบ')</script>" ;
		echo "<script>window.location='Home_1.php'</script>";
	}
	
	$row_label = mysqli_fetch_assoc($result = mysqli_query($conn,"select * from tb_label where name = 'Result_Company'"));
	$label = $row_label['text'];
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src ="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
<title>แจ้งผลการดำเนินการ</title>
</head>

<body>
	<form>
		<div class="container-fluid">
			<div class="col-12 col-sm-12" align="center">
				<br>				
				<h5 class="text-primary" >อยู่บ้านหยุดเชื้อช่วยชาติ</h3>
				<br>
				<h5 class="text-primary"><?php echo $label ?></h3>
				<br>
				<h5 class="text-primary"><?php echo $time ?></h3>
				<br>
				<h5 hidden="" class="text-primary" id="result"></h3>
				<input type="hidden" id="round" value="<?php echo $_POST['round'] ?>">
				<br>
				<h5 id="res" class="text-success">ทำการเช็คชื่อเสร็จเรียบร้อยแล้ว!!!</h1>
				<br>

				<br><br><br>
				<h5>ข้อมูลพนักงาน</h5>

				<br>
				<table class="table">
					<?php 
						$result_user = mysqli_query($conn,"select * from tb_user where id = '$id'");
							$row = mysqli_fetch_assoc($result_user);
							$name = $row['name'];
							$lname = $row['lname'];
					?>
					<tbody>
						<tr>
						<td>รหัสพนักงาน</td>
						<td><?php echo $_POST['id'] ?></td>
						</tr>
						<tr>
						<td>ชื่อพนักงาน</td>
						<td><?php echo $name ?>&nbsp;&nbsp;<?php echo $lname ?></td>
						</tr>
					</tbody>
					
				</table>
				<a href="https://checkin.vandapac.com" class="btn btn-outline-success">ปิด</a>
			<br><br>
			</div>
		</div>
	</form>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript" >

//disable back button
history.pushState(null, null, '');
window.addEventListener('popstate', function(event) {
  history.pushState(null, null, '');
});
	
$(document).ready(function(){
	var round = document.getElementById('round').value;
	if(round == '0'){
		$('#result').text('รอบเช้า');
	}
	if(round == '1'){
		$('#result').text('รอบบ่าย');
	}
	if(round == '2'){
		$('#result').text('รอบพิเศษ');
	}
})
</script>
</html>