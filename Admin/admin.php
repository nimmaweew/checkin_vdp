<?php

@$act=$_GET['act'];

if($act=='excel'){

header("Content-Type: application/xls");

header("Content-Disposition: attachment; filename=export.xls");

header("Pragma: no-cache");

header("Expires: 0");

}


include('connect.php');
include('loginchecking.php');

?>

<!DOCTYPE html>

<html>

	<head>

		<meta charset="utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link rel="shortcut icon" href="#" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



<script type="text/javascript" >
//disable back button
history.pushState(null, null, '');
window.addEventListener('popstate', function(event) {
  history.pushState(null, null, '');
});
</script>


<style>

body {font-family: Arial, Helvetica, sans-serif;}



/* The Modal (background) */

.modal {

  display: none; /* Hidden by default */

  position: fixed; /* Stay in place */

  z-index: 1; /* Sit on top */

  padding-top: 100px; /* Location of the box */

  left: 0;

  top: 0;

  width: 100%; /* Full width */

  height: 100%; /* Full height */

  overflow: auto; /* Enable scroll if needed */

  background-color: rgb(0,0,0); /* Fallback color */

  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */

}



/* Modal Content */

.modal-content {

  background-color: #fefefe;

  margin: auto;

  padding: 20px;

  border: 1px solid #888;

  width: 80%;

}



/* The Close Button */

.close {

  color: #aaaaaa;

  float: right;

  font-size: 28px;

  font-weight: bold;

}



.close:hover,

.close:focus {

  color: #000;

  text-decoration: none;

  cursor: pointer;

}



	.table {



	}





	

</style>

	</head>

	<body>

		<form action="export.php" method="post" id="frmad">

			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg12" align="center" id="showdata">
						<nav class="navbar navbar-expand-lg navbar-light bg-light">
  							<a class="navbar-brand" href="#">Admin</a>
  							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    							<span class="navbar-toggler-icon"></span>
  							</button>
  							<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    							<div class="navbar-nav">
      								<a class="nav-item nav-link active" href="admin.php">นำข้อมูลออกเป็นไฟล์ Excel</a>
									<a class="nav-item nav-link active" href="admincheck.php">ตรวจสอบการเช็คชื่อ</a>
									 <li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										  ข้อมูลพนักงาน
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										  <a class="dropdown-item" href="registeruser.php">แก้ไขข้อมูลพนักงาน</a>
										  <a class="dropdown-item" href="qrmobile.php" hidden="">อัพเดทไลน์จากมือถือ</a>
										</div>
									  </li>
    							</div>
  							</div>
							<div class="navbar-nav topnav-right">
								<a class="nav-item nav-link active" href="logout.php">ลงชื่อออก</a>
							  </div>
						</nav>
					</div>
				</div>
				<div class="row">
					<div class="col-4"></div>
					<div class="col-4" align="center">
						<br>

						<br>

						<h3 class="text-primary">เลือกวันที่เพื่อแสดงข้อมูล</h3>

						<br>

						<input type="date" id="date" name="date" value="" class="form-control">
						<br>
						<hr>
						<select class="form-control" id="seljob" name="seljob">
							<option value="0">เลือกช่วงเวลาทำงาน</option>
							<option value="1">กะเช้า</option>
							<option value="2">กะดึก</option>
						</select>

						
						<input type="submit" class="btn btn-sm btn-outline-primary btn-sm form-control" value="แสดงข้อมูล" id="btn" hidden="">
						

						<br>

						<br>

								<?php
								//set date
								date_default_timezone_set("Asia/Bangkok");
								$timey = date('Y');
								$timem = date('m');
								$timed = date('d');
								$slad = "-";
								$time = $timey.$slad.$timem.$slad.$timed;
								?>

						<br><br>
						<div class="row-cols-12" align="center" id="btn_export">
							<input type="button" name="export" id="export" value="Export To Excel" onClick="update()" class="btn btn-sm btn-outline-success">
							<input type="hidden" id="today" value="<?php echo $time ?>">
						</div>
						<div id="loading">
							<button class="btn btn-success" type="button" disabled>
							  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
							  <span class="sr-only">Loading...</span>
							</button>
						</div>
					</div>
					<div class="col-4"></div>
				</div>

				</div>

		

		</form>
		<form id="frmad2" action="export2.php" method="post">
			<input type="hidden" name="date" id="date2">
		</form>
		

	<script>
		$(document).ready(function(){
			$('#loading').hide();
		})
			
		
		function update(){
			var date = $('#date').val()
			var seljob = $('#seljob').val();
			console.log(seljob);
			if(seljob == '0'){
				alert('เลือกช่วงเวลาทำงาน');
			}
			else{
				$('#btn_export').hide(500);
				$('#loading').show(500);
				if(date == ''){
					var date = $('#today').val();
				}
				console.log(date);
				var type = 'update_tb_all';
				$.ajax({
					url : 'admin_ajax.php',
					method : 'post',
					data : {type:type,
						   date:date,
						   seljob:seljob},
					success:function(result){
						var len = result.length;
						if(result == ' '){
							if(seljob == '1'){
								$('#frmad').submit();
								$('#loading').hide(500);
								$('#btn_export').show(500);
							}else if(seljob =='2'){
								$('#date2').val(date);
								$('#frmad2').submit();
								$('#loading').hide(500);
								$('#btn_export').show(500);
							}
							
						}else{
							alert('ระบบผิดพลาดกรุณาแจ้งผู้ดูแลระบบ');
							$('#loading').hide(500);
							$('#btn_export').show(500);
						}
					}
				})
			}
			
		}
		</script>
	</body>

</html>



