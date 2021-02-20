<!doctype html>
<?php 
session_start();  
include('loginchecking.php');
	include('connect.php');

		$timey = date('Y');

        $timem = date('m');

        //$timed = date('d');
		$timed = date('d');

        $slad = "-";

       $date = $timey.$slad.$timem.$slad.$timed;
	$select_grop =$_GET['grop'];
	$result1 = mysqli_query($conn,"select * from tb_grop where name = '$select_grop'");
	$row1 = mysqli_fetch_assoc($result1);
	$postgrop  = $row1['id'];
	if(isset($_POST['selloc'])){
		$selloc = $_POST['selloc'];
	}else{
		$selloc = '';
	}
	if(isset($_POST['seltime'])){
		$seldate = $_POST['date'];
		$seltime = $_POST['seltime'];
		$selfun = $_POST['selfun'];
		$selgrop = $_POST['Hselgrop2'];
	}
	else{
		$seldate = $date;
		$selfun = '';
		$seltime = '';
		$selgrop = $postgrop;
	}
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://api.longdo.com/map/?key=b78fe9d3e3500a56ab918f015c603a70"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript" >
//disable back button
history.pushState(null, null, '');
window.addEventListener('popstate', function(event) {
  history.pushState(null, null, '');
});
</script>
<script>
$(document).ready(function(){
	$('#table').DataTable({
		"lengthMenu": [ 50, 75, 100 ],
		"pageLength":50,
		"bSort":false,
		"bAutoWidth": false,
		scrollX: true

	});
	
	var Hseltime = $('#Hseltime').val();
	if(Hseltime == ''){
		document.getElementById('seltime0').selected = "true";
	}
	else if(Hseltime == 'all'){
		document.getElementById('seltimeall').selected = "true";
	}
	else{
		document.getElementById('seltime'+Hseltime).selected = "true";
	}
	
	var Hselfun = $('#Hselfun').val();
	if(Hselfun == ''){
		document.getElementById('selfun0').selected = "true";
	}else{
		document.getElementById('selfun'+Hselfun).selected = "true";
	}
		
	
	var Hselgrop = $('#Hselgrop').val()
	if(Hselgrop == ''){
		document.getElementById('grop0').selected = "true";
	}
	else if(Hselgrop == 'all'){
		document.getElementById('gropall').selected = "true";
	}
	else{
		document.getElementById('grop'+Hselgrop).selected = "true";
	}
	
	
	
	$('#selloc').on('change',function(){
		$('#check').submit();
	})
});
</script>



	

<title>Admin Check</title>
</head>

<body>
	<form name="check" id="check" method="post">
		
			<div class="container-fluid">
			<div class="row-cols-12" align="center">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">

  							<a class="navbar-brand" href="#">Admin</a>

  							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">

    							<span class="navbar-toggler-icon"></span>

  							</button>

  							<div class="collapse navbar-collapse" id="navbarNavAltMarkup">

    							<div class="navbar-nav">

      								<a class="nav-item nav-link active" href="admin.php" hidden="">นำข้อมูลออกเป็นไฟล์ Excel</a>
									

									<a class="nav-item nav-link active" href="#">ตรวจสอบการเช็คชื่อ</a>
									 <li class="nav-item dropdown" hidden="">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										  ข้อมูลพนักงาน
										</a>
										<div hidden="" class="dropdown-menu" aria-labelledby="navbarDropdown">
										  <a class="dropdown-item" href="registeruser.php">แก้ไขข้อมูลพนักงาน</a>
										  <a hidden="" class="dropdown-item" href="qrmobile.php">อัพเดทไลน์จากมือถือ</a>
										</div>
									  </li>

    							</div>

  							</div>
							<div class="navbar-nav topnav-right">
								<a class="nav-item nav-link active" href="logout.php">ลงชื่อออก</a>
							  </div>
						</nav>
			<br>
				<input type="hidden" name="Hselloc" id="Hselloc" value="<?php echo $selloc ?>">
				<label class="text-primary form-control-plaintext">เลือกข้อมูลที่ต้องการค้นหา</label>
				<select hidden="" name="selloc" id="selloc" class="form-control">
					<option value="0" id="selloc0">เลือกสถานที่</option>
					<?php 
					$sql = "select * from tb_location";
					$result = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_assoc($result)){
					$id = $row['id'];
					$name = $row['name'];
					
					?>
					<option id="selloc<?php echo $id ?>" value='<?php echo $id ?>'><?php echo $name ?></option>
					<?php 
					}
					?>
				</select>
			<br>
					<input type="date" class="form-control" name="date" id="date" onChange="checktime()" value="<?php echo $seldate ?>">
			<br>
			<input type="hidden" name="Hselgrop" id="Hselgrop" value="<?php echo $selgrop ?>">
				<input type="hidden" name="Hselgrop2" id="Hselgrop2" value="<?php echo $selgrop ?>">
				<select id="selgrop" name="selgrop" class="form-control" disabled>
					<option id="grop0" value="">เลือกกลุ่ม</option>
					<?php 
						$grop = "select * from tb_grop";
						$resultgrop = mysqli_query($conn,$grop);
						while($rowgrop = mysqli_fetch_assoc($resultgrop)){
						?>
						<option id="grop<?php echo $rowgrop['id']?>" value="<?php echo $rowgrop['id']?>"><?php echo $rowgrop['name']?></option>
					<?php
						}
					?>
					<option id="gropall" value="all">ทั้งหมด</option>
				</select>
			<br>
			<input type="hidden" name="Hseltime" id="Hseltime" value="<?php echo $seltime ?>">
				<select id="seltime" name="seltime" class="form-control">
					<option id="seltime0" value="0">เลือกช่วงเวลา</option>
					<option id="seltime1" value="1">ช่วงเช้า</option>
					<option id="seltime2" value="2">ช่วงบ่าย</option>
					<option id="seltime3" value="3">ช่วงเย็น</option>
					<option id="seltimeall" value="all">ทุกช่วง</option>
				</select>
			<br>
			<input type="hidden" name="Hselfun" id="Hselfun" value="<?php echo $selfun ?>">
				<select id="selfun" name="selfun" class="form-control">
					<option name="selfun0" id="selfun0" value="0">เลือกเงื่อนไข</option>
					<option name="selfun1" id="selfun1" value="1">คนที่ยังไม่ได้เช็คชื่อ</option>
					<option name="selfun2" id="selfun2" value="2">คนที่ระยะห่างเกิน 5 กม. ไม่ระบุหมายเหตุ</option>
					<option name="selfun3" id="selfun3" value="3">คนที่ระยะห่างเกิน 5 กม. ระบุหมายเหตุ</option>
					<option name="selfun4" id="selfun4" value="4">คนที่เช็คชื่อผ่านปกติ</option>
					<option name="selfun5" id="selfun5" value="5">คนที่ไม่ได้เช็คชื่อ หรือ คนที่ระยะห่างเกิน 5 กม.</option>
					<option hidden="" name="selfun7" id="selfun7" value="7">คนที่เช็คจุดที่ 2 </option>
				</select>
			<br>
				<input type="button" id="btshow" class="btn btn-sm btn-outline-success form-control" value="แสดงข้อมูล">
				<br>
				<br>
				<table id="table" class="table table-striped table-bordered" style="width:100%;height: auto" >
					<thead>
						<tr>
							<th>ชื่อ</th>
							<th hidden=""></th>
							<th>เบอร์โทรศัพท์</th>
							<th>ระยะห่าง(กม.)</th>
							<th>สถานที่</th>
							<th>หมายเหตุ</th>
							<th hidden="hidden"></th>
						</tr>
					</thead>
					<tbody id="table_body">
						<?php 
						if(isset($_POST['date'])){
							$date = $_POST['date'];
							$grop = $_POST['Hselgrop2'];
							$time = $_POST['seltime'];
							$fun = $_POST['selfun'];
							$result_grop = mysqli_query($conn,"select * from tb_grop where id = '$grop'");
							$row_grop = mysqli_fetch_assoc($result_grop);
							$grop_name = $row_grop['name'];
						
						if($grop == 'all'){
							//morning
							if($time == '1'){
								//ไม่เช็คชื่อ
								if($fun == '1'){
									$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_mon where date = '$date')";
								}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep_mon where distance > 5 and comment = '' and date = '$date'";
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep_mon where distance > 5 and comment <> '' and date = '$date'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep_mon where distance < 5 and date = '$date'";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_mon where date = '$date')
											UNION
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_mon where distance > 5 AND date = '$date'";

								}

							}
							//after
							if($time == '2'){
								//ไม่เช็คชื่อ
								if($fun == '1'){
									$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_after where date = '$date')";
								}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep_after where distance > 5 and comment = '' and date = '$date'";
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep_after where distance > 5 and comment <> '' and date = '$date'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep_after where distance < 5 and date = '$date'";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_after where date = '$date')
											UNION
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_after where distance > 5 AND date = '$date'";

								}

							}
							//eve
							if($time == '3'){
								//ไม่เช็คชื่อ
								if($fun == '1'){
									$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_eve where date = '$date')";
								}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep_eve where distance > 5 and comment = '' and date = '$date'";
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep_eve where distance > 5 and comment <> '' and date = '$date'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep_eve where distance < 5 and date = '$date'";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_eve where date = '$date')
											UNION
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_eve where distance > 5 AND date = '$date'";

								}

							}
							//alltime
							if($time == 'all'){
								//ไม่เช็คชื่อ
								if($fun == '1'){
									$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_mon where date = '$date')
											UNION
											select * from tb_user where not tb_user.id in(select id from tb_rep_after where date = '$date')
											UNION
											select * from tb_user where not tb_user.id in(select id from tb_rep_eve where date = '$date')";
								}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep_mon where distance > 5 and comment = '' and date = '$date'
											UNION ALL
											select * from tb_rep_after where distance > 5 and comment = '' and date = '$date'
											UNION ALL
											select * from tb_rep_after where distance > 5 and comment = '' and date = '$date'";
								
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep_mon where distance > 5 and comment <> '' and date = '$date'
											UNION ALL
											select * from tb_rep_after where distance > 5 and comment <> '' and date = '$date'
											UNION ALL
											select * from tb_rep_eve where distance > 5 and comment <> '' and date = '$date'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep_mon where distance < 5 and date = '$date'
											UNION ALL
											select * from tb_rep_after where distance < 5 and date = '$date'
											UNION ALL
											select * from tb_rep_eve where distance < 5 and date = '$date'";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_mon where date = '$date')
											UNION ALL
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_mon where distance > 5 AND date = '$date'
											UNION ALL
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_after where date = '$date')
											UNION ALL
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_after where distance > 5 AND date = '$date'
											UNION ALL
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_eve where date = '$date')
											UNION ALL
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_eve where distance > 5 AND date = '$date'";
								}

							}
						}
						//Select Group
						else{
							//morning
							if($time == '1'){
								//ไม่เช็คชื่อ
								if($fun == '1'){
									$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_mon where date = '$date' and grop = '$grop_name')";
								}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep_mon where distance > 5 and comment = '' and date = '$date' and grop = '$grop_name'";
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep_mon where distance > 5 and comment <> '' and date = '$date' and grop = '$grop_name'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep_mon where distance < 5 and date = '$date' and grop = '$grop_name'";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_mon where date = '$date' and grop = '$grop_name')
											UNION
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_mon where distance > 5 AND date = '$date' and grop = '$grop_name'";
								}

							}
							//after
							if($time == '2'){
								//ไม่เช็คชื่อ
								if($fun == '1'){
									$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_after where date = '$date' and grop = '$grop_name')";
								}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep_after where distance > 5 and comment = '' and date = '$date' and grop = '$grop_name'";
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep_after where distance > 5 and comment <> '' and date = '$date' and grop = '$grop_name'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep_after where distance < 5 and date = '$date' and grop = '$grop_name'";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_after where date = '$date' and grop = '$grop_name')
											UNION
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_after where distance > 5 AND date = '$date' and grop = '$grop_name'";
								}

							}
							//eve
							if($time == '3'){
								//ไม่เช็คชื่อ
								if($fun == '1'){
									$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_eve where date = '$date' and grop = '$grop_name')";
								}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep_eve where distance > 5 and comment = '' and date = '$date' and grop = '$grop_name'";
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep_eve where distance > 5 and comment <> '' and date = '$date' and grop = '$grop_name'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep_eve where distance < 5 and date = '$date' and grop = '$grop_name'";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_eve where date = '$date' and grop = '$grop_name')
											UNION
											SELECT id,type,name,lname,tel,distance,comment FROM tb_rep_eve where distance > 5 AND date = '$date' and grop = '$grop_name'";
								}

							}
							//alltime
							if($time == 'all'){
								//ไม่เช็คชื่อ
								if($fun == '1'){
									$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_mon where date = '$date' and grop = '$grop_name')
											UNION
											select * from tb_user where not tb_user.id in(select id from tb_rep_after where date = '$date' and grop = '$grop_name')
											UNION
											select * from tb_user where not tb_user.id in(select id from tb_rep_eve where date = '$date' and grop = '$grop_name')";
								}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep_mon where distance > 5 and comment = '' and date = '$date' and grop = '$grop_name'
											UNION ALL
											select * from tb_rep_after where distance > 5 and comment = '' and date = '$date' and grop = '$grop_name'
											UNION ALL
											select * from tb_rep_after where distance > 5 and comment = '' and date = '$date' and grop = '$grop_name'";
								
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep_mon where distance > 5 and comment <> '' and date = '$date' and grop = '$grop_name'
											UNION ALL
											select * from tb_rep_after where distance > 5 and comment <> '' and date = '$date' and grop = '$grop_name'
											UNION ALL
											select * from tb_rep_eve where distance > 5 and comment <> '' and date = '$date' and grop = '$grop_name'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep_mon where distance < 5 and date = '$date' and grop = '$grop_name'
											UNION ALL
											select * from tb_rep_after where distance < 5 and date = '$date' and grop = '$grop_name'
											UNION ALL
											select * from tb_rep_eve where distance < 5 and date = '$date' and grop = '$grop_name'";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_mon where date = '$date' and grop = '$grop_name')
											UNION ALL
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_mon where distance > 5 AND date = '$date' and grop = '$grop_name'
											UNION ALL
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_after where date = '$date' and grop = '$grop_name')
											UNION ALL
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_after where distance > 5 AND date = '$date' and grop = '$grop_name'
											UNION ALL
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_eve where date = '$date' and grop = '$grop_name')
											UNION ALL
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_eve where distance > 5 AND date = '$date' and grop = '$grop_name'";
								}

							}

						}
	
							$result = mysqli_query($conn,$sql);
							while($row = mysqli_fetch_assoc($result)){
								$id = $row['id'];
								$type = $row['type'];
								$name = $row['name'];
								$lname = $row['lname'];
								$fullname = $type.$name.' '.$lname;
								$tel = $row['tel'];
								if($fun == '1'){
									$comment = '';
									$distance = '';
									$dis_com = '';
									$dis_com_value = '';
									$lat = '';
									$lon = '';
								}else{
									$comment = $row['comment'];
									$distance = $row['distance'];
									$dis_com = $row['dis_com'];
									$lat = $row['lati'];
									$lon = $row['lon'];
									$no = number_format($dis_com);
									if($dis_com <> ''){
										if($dis_com < 1){
											$dis_com_value = 'Vandapac';
										}
										
									}
									else{
										$dis_com_value = '';
									}
								}
								
				
							
					?>
					<tr>
						<td><?php echo $fullname ?></td>
						<td hidden=""></td>
						<td><a href="tel:<?php echo $tel ?>" target="_blank"><?php echo $tel ?></a></td>
						<td><?php echo $distance ?></td>
						<td><?php echo $dis_com_value ?></td>
						<td><?php echo $comment ?></td>
						<td hidden=""></td>
					</tr>
					<?php
							}
						}
					?>
					</tbody>
					
				</table>
				
			</div>
		
		</div>
	</form>
<script>//Check Empty
	function checktime(){
		var date = $('#date').val();
		console.log(date);
	}
	$(document).on('click','a[data-role=showline]',function(){
		var no = $(this).data("id");
		var line = $('#'+no).children('td[data-target=linelink]').text();
		if(line == ''){
			alert('ไม่พบลิ้งไลน์ของพนักงานคนนี้');
		}
		else{
			 window.open(line);
		}
	})
	
	$('#btshow').on('click',function(){
		var date = $('#date').val()
		var seltime =$('#seltime').val()
		var selfun = $('#selfun').val()
		var selgrop = $('#selgrop').val()
		var selloc  = $('#selloc').val()
		var Lloc = selloc.length
		var Ldate = date.length
		var Lseltime = seltime.length
		var Lselfun = selfun.length
		 if(Ldate == '0'){
			alert('เลือกวันที่!!!')
		}
		else if(selgrop == ''){
			alert('เลือกกลุ่ม!!!')
		}
		else if(Lseltime == '0'){
			alert('เลือกช่วงเวลา!!!')
		}
		else if(selfun == '0'){
			alert('เลือกเงื่อนไข!!!')
		}
		else{
			$('#check').submit();
		}
		})
	
	//updatelocation 1 click
	$(document).on('click','.btn',function(){
		var data = $(this).data('role');
		var id = $(this).data('id');
		if(data == 'updateuser'){
			window.open("registeruser.php?id="+id,"_black")
		}
		
	})
</script>
</body>
</html>