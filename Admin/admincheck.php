<!doctype html>
<?php 
include('loginchecking.php');
	include('connect.php');

		$timey = date('Y');

        $timem = date('m');

        //$timed = date('d');
		$timed = date('d');

        $slad = "-";

       $date = $timey.$slad.$timem.$slad.$timed;

	if(isset($_POST['selloc'])){
		$selloc = $_POST['selloc'];
	}else{
		$selloc = '';
	}
	if(isset($_POST['seltime'])){
		if($_SESSION['level'] == '3'){
			$selgrop = $_POST['selgrop'];
		}else{
			$selgrop = $_SESSION['grop'];
		}
		$seldate = $_POST['date'];
		$seltime = $_POST['seltime'];
		$selfun = $_POST['selfun'];
		$seljob = $_POST['seljob'];
		$selround = $_POST['selround'];
	}
	else{
		$seldate = $date;
		$selfun = '';
		$seltime = '';
		$selgrop = '';
		$seljob = '';
		$selround = '';
		
	}
 $result = mysqli_query($conn,"select * from tb_api where id = '1'");
$row = mysqli_fetch_assoc($result);
$api = $row['key_code'];
$level = $_SESSION['level'];
$id_grop = $_SESSION['grop'];
$result_dis = mysqli_query($conn,"select * from tb_distance where id = '1'");
$row_dis = mysqli_fetch_assoc($result_dis);
$dis = $row_dis['km'];
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
	<link rel="shortcut icon" href="#" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://api.longdo.com/map/?key=<?php echo $api ?>"></script>
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
	
	/*var Hselloc = $('#Hselloc').val();
	if(Hselloc == ''){
		document.getElementById('selloc0').selected = "true";
	}
	else{
		document.getElementById('selloc'+Hselloc).selected = "true";
	}
	*/
	var Hseljob = $('#Hseljob').val();
	if(Hseljob == ''){
		document.getElementById('seljob0').selected = "true";
		document.getElementById('seltime').disabled = "true";
	}else if(Hseljob == '1'){
		document.getElementById('seljob1').selected = "true";
		document.getElementById('seltime').disabled = false;
		$('#seltime2').show();
	}else if(Hseljob == '2'){
		document.getElementById('seljob2').selected = "true";
		document.getElementById('seltime').disabled = false;
		$('#seltime2').hide();
	}
	
	var Hseltime = $('#Hseltime').val();
	if(Hseltime == ''){
		document.getElementById('seltime0').selected = "true";
		document.getElementById('selround').disabled = "true";
	}
	else if(Hseltime == 'all'){
		document.getElementById('seltimeall').selected = "true";
		document.getElementById('selround').disabled = false;
	}
	else{
		document.getElementById('seltime'+Hseltime).selected = "true";
		document.getElementById('selround').disabled = false;
	}
	
	var Hselfun = $('#Hselfun').val();
	if(Hselfun == ''){
		document.getElementById('selfun0').selected = "true";
	}else{
		document.getElementById('selfun'+Hselfun).selected = "true";
	}
	
	var level = $('#level').val();
	if(level == '3'){
		var Hselgrop = $('#Hselgrop').val();
	}else{
		var Hselgrop = $('#grop_login').val();
	}
	if(Hselgrop == ''){
		document.getElementById('grop0').selected = "true";
	}else{
		document.getElementById('grop'+Hselgrop).selected = "true";
	}
	
	var Hselround = $('#Hselround').val();
	if(Hselround != 0){
		var type = 'get_round';
		var date = $('#date').val();
		$.ajax({
			url : 'admincheck_ajax.php',
			method : 'post',
			data : {type:type,
				   date:date,
				   seltime:Hseltime,
				   seljob:Hseljob},
			success:function(result){
				var data = JSON.parse(result);
				var selround = $('#selround');
				var n = data.length;
				if(n == 0){
					selround.html('<option id="selround0" value="0">เลือกรอบ</option> <option id="selround1" value="1">1</option>');
				}else{
					selround.html('<option id="selround0" value="0">เลือกรอบ</option>');
				}
				$.each(data,function(index,item){
					selround.append(
						$(`<option id="selround${item.round}"></option>`).val(item.round).html(item.round)
					)
				});
				document.getElementById('selround'+Hselround).selected = "true";
			}
		})
	}
	
	
	$('#map').hide();
	//Map Maker
	var date = $('#date').val();
	var level = $('#level').val();
	var dis = $('#dis').val();
	var job = $('#job').val();
	
	if(Hseltime != ''){
		if(Hselfun != ''){
			if(level != '1'){
				var type = 'Map_Maker';
				$.ajax({
					url : 'admincheck_ajax.php',
					method : 'post',
					data : {type:type,
						   selfun:Hselfun,
						   selgrop:Hselgrop,
						   seltime:Hseltime,
						   selround:Hselround,
						   date:date,
						   dis:dis,
						   job:job},
					success:function(result){
						var data = JSON.parse(result);
						if(Hselfun != '1'){
							var map = new longdo.Map({
								placeholder: document.getElementById('map')
							  });
								map.Ui.DPad.visible(false);
								map.Ui.Zoombar.visible(false);
								map.Ui.Geolocation.visible(false);
								map.Ui.Toolbar.visible(false);
								map.Ui.LayerSelector.visible(false);
								map.Ui.Fullscreen.visible(false);
								map.Ui.Crosshair.visible(false);
								map.Ui.Scale.visible(false);
								map.Ui.Keyboard.enable(false);
								map.Ui.Keyboard.enableInertia(false);
								map.location({ lon:101.01296412333775, lat:13.431797419813535 }, true);
								map.zoom(8,true)
								//13.431797419813535, 101.01296412333775
								$(document).on('click','.btn',function(){
								var data = $(this).data('role');
									if(data == 'Mapgo'){
										var lat = $(this).data('lat');
										var lon = $(this).data('lon');
										if(lat != ''){
											if(lon != ''){
												map.location({ lon:lon, lat:lat }, true);
												map.zoom(15,true);
											}
										}
									}
									
							})
							$('#map').show();
							var i = 0;
							var count = data.length;
							
								while(i < count){
								var lat = data[i].lati;
								var lon = data[i].lon;
								var id = data[i].id;
								var type = data[i].type;
								var name = data[i].name;
								var lname = data[i].lname;
								var comment = data[i].comment;
								var fullname = type+''+name+' '+lname;
								map.Overlays.add(
									new longdo.Marker(
									{ lon: lon, lat:lat},
										{
											title:'<label style=text-align-last:start>ข้อมูลพนักงาน</label>',
											detail: '<label style=text-align-last:start>'+id+'<br>'+fullname+'<br>'+comment+'</label>'
										}
									)
								)
								i++;
							}
							
						}
						
					}
				})
			}
		}
	}

	if(level == '3'){
		
	}else{
		$('#export').hide();
		$('#edit_user2').hide();
		document.getElementById('selgrop').disabled = 'true';
	}
	/*$('#seltime').on('change',function(){
		if(document.getElementById('seltime3').selected){
			//document.getElementById('selfun4').selected = true;
			//document.getElementById('selfun').disabled = true;
			//document.getElementById('Hselfun').value = '4';

		}
		else{
			document.getElementById('selfun0').selected = true;
			document.getElementById('selfun').disabled = false;
		}
	});
	
	$('#selfun').on('change',function(){
		if(document.getElementById('selfun0').selected){
			document.getElementById('Hselfun').value = '0';
		}
		else if(document.getElementById('selfun1').selected){
			document.getElementById('Hselfun').value = '1';
		}
		else if(document.getElementById('selfun2').selected){
			document.getElementById('Hselfun').value = '2';
		}
		else if(document.getElementById('selfun3').selected){
			document.getElementById('Hselfun').value = '3';
		}
		else if(document.getElementById('selfun4').selected){
			document.getElementById('Hselfun').value = '4';
		}
		else if(document.getElementById('selfun5').selected){
			document.getElementById('Hselfun').value = '5';
		}
		
	})*/
	
	$('#selloc').on('change',function(){
		$('#check').submit();
	})
});
	
	function function_seljob(){
		var seljob = $('#seljob').val();
		document.getElementById('selround0').selected = true;
		if(seljob == '1'){
			$('#seltime2').show();
			document.getElementById('seltime').disabled = false;
		}else if(seljob == '2'){
			$('#seltime2').hide();
			document.getElementById('seltime0').selected = 'true';
			document.getElementById('seltime').disabled = false;
		}else{
			document.getElementById('seltime').disabled = true;
		}
	}
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

      								<a class="nav-item nav-link active" href="admin.php" id="export">นำข้อมูลออกเป็นไฟล์ Excel</a>
									

									<a class="nav-item nav-link active" href="admincheck.php">ตรวจสอบการเช็คชื่อ</a>
									 <li class="nav-item dropdown" id="edit_user2">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="edit_user">
										  ข้อมูลพนักงาน
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdown">
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
				<select id="selgrop" name="selgrop" class="form-control">
					<option id="grop0" value="0">เลือกกลุ่ม</option>
					<?php 
						$grop = "select * from tb_grop order by id asc";
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
				<input type="hidden" name="Hseljob" id="Hseljob" value="<?php echo $seljob ?>" >
				<select id="seljob" name="seljob" class="form-control" onChange="function_seljob()">
					<option id="seljob0" value="0">เลือกกะการทำงาน</option>
					<option id="seljob1" value="1">กะเช้า</option>
					<option id="seljob2" value="2">กะดึก</option>
				</select>	
			<br>
				
			<input type="hidden" name="Hseltime" id="Hseltime" value="<?php echo $seltime ?>">
				<select id="seltime" name="seltime" class="form-control" onChange="fn_selround()">
					<option id="seltime0" value="0">เลือกช่วงเวลา</option>
					<option id="seltime1" value="1">ช่วงเช้า</option>
					<option id="seltime2" value="2">ช่วงบ่าย</option>
					<option id="seltime3" value="3">ช่วงเย็น</option>
					<option id="seltimeall" value="all">ทุกช่วง</option>
				</select>
			<br>
				<input type="hidden" id="Hselround" value="<?php echo $selround ?>">
				<select id="selround" name="selround" class="form-control">
					<option id="selround0" value="0">เลือกรอบ</option>
					<option id="selround1" value="1">1</option>
				</select>
				<br>
				
			<input type="hidden" name="Hselfun" id="Hselfun" value="<?php echo $selfun ?>">
				<select id="selfun" name="selfun" class="form-control">
					<option name="selfun0" id="selfun0" value="0">เลือกเงื่อนไข</option>
					<option name="selfun1" id="selfun1" value="1">คนที่ยังไม่ได้เช็คชื่อ</option>
					<option name="selfun2" id="selfun2" value="2" hidden="">คนที่ระยะห่างเกิน <?php echo $dis ?> กม. ไม่ระบุหมายเหตุ</option>
					<option name="selfun3" id="selfun3" value="3" hidden="">คนที่ระยะห่างเกิน <?php echo $dis ?> กม. ระบุหมายเหตุ</option>
					<option name="selfun4" id="selfun4" value="4">คนที่เช็คชื่อผ่านปกติ</option>
					<option name="selfun5" id="selfun5" value="5" hidden="">คนที่ไม่ได้เช็คชื่อ หรือ คนที่ระยะห่างเกิน <?php echo $dis ?> กม.</option>
					<option hidden="" name="selfun7" id="selfun7" value="7">คนที่เช็คจุดที่ 2 </option>
				</select>
			<br>
				<input type="button" id="btshow" class="btn btn-sm btn-outline-success form-control" value="แสดงข้อมูล">
				<input type="hidden" name="level" id="level" value="<?php echo $level ?>">
				<input type="hidden" name="grop_login" id="grop_login" value="<?php echo $id_grop ?>">
				<input type="hidden" id="dis" value="<?php echo $dis ?>">
				<input type="hidden" id="job" name="job" value="<?php echo $seljob ?>">
					<br><br><br>
				<div id="map" name="map" style="height: 300px"></div>
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
							<th hidden=""></th>
							<th hidden="hidden"></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if(isset($_POST['date'])){
							if($_SESSION['level'] == '3'){
								$grop = $_POST['selgrop'];
							}else{
								$grop = $_SESSION['grop'];
							}
							$round = $_POST['selround'];
							$date = $_POST['date'];
							$time = $_POST['seltime'];
							$fun = $_POST['selfun'];
							$seljob = $_POST['seljob'];
							if($grop <> 'all'){
								$result_grop = mysqli_query($conn,"select * from tb_grop where id = '$grop'");
								$row_grop = mysqli_fetch_assoc($result_grop);
								$grop_name = $row_grop['name'];
							}else{
								;
							}
							
						
						//Select Group
							if($grop == 'all'){
								if($seljob == '1'){
								if($time == '1'){
								//ไม่เช็คชื่อ
								if($fun == '1'){
									$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_mon where date = '$date' and round = '$round')";
								}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep_mon where distance > $dis and comment = '' and date = '$date' ";
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep_mon where distance > $dis and comment <> '' and date = '$date'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep_mon where date = '$date' and round = '$round'";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_mon where date = '$date')
											UNION
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_mon where distance > $dis AND date = '$date' ";
								}

								}
								//after
								if($time == '2'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_after where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep_after where distance > $dis and comment = '' and date = '$date' ";
									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep_after where distance > $dis and comment <> '' and date = '$date' ";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep_after where date = '$date' and round = '$round' ";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_after where date = '$date')
												UNION
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_after where distance > $dis AND date = '$date' ";
									}

								}
								//eve
								if($time == '3'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_eve where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep_eve where distance > $dis and comment = '' and date = '$date' ";
									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep_eve where distance > $dis and comment <> '' and date = '$date'";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep_eve where date = '$date' and round = '$round' ";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_eve where date = '$date')
												UNION
												SELECT id,type,name,lname,tel,distance,comment FROM tb_rep_eve where distance > $dis AND date = '$date' ";
									}

								}
								//alltime
								if($time == 'all'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_mon where date = '$date' and round = '$round')
												UNION
												select * from tb_user where not tb_user.id in(select id from tb_rep_after where date = '$date' and round = '$round')
												UNION
												select * from tb_user where not tb_user.id in(select id from tb_rep_eve where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep_mon where distance > $dis and comment = '' and date = '$date' 
												UNION ALL
												select * from tb_rep_after where distance > $dis and comment = '' and date = '$date' 
												UNION ALL
												select * from tb_rep_after where distance > $dis and comment = '' and date = '$date' ";

									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep_mon where distance > $dis and comment <> '' and date = '$date' 
												UNION ALL
												select * from tb_rep_after where distance > $dis and comment <> '' and date = '$date' 
												UNION ALL
												select * from tb_rep_eve where distance > $dis and comment <> '' and date = '$date' ";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep_mon where date = '$date' and round = '$round' 
												UNION ALL
												select * from tb_rep_after where date = '$date' and round = '$round'
												UNION ALL
												select * from tb_rep_eve where date = '$date' and round = '$round' ";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_mon where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_mon where distance > $dis AND date = '$date' 
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_after where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_after where distance > $dis AND date = '$date' 
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_eve where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_eve where distance > $dis AND date = '$date'";
									}

								}
								
							}else if($seljob == '2'){
								if($time == '1'){
								//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep2_mon where date = '$date' and round = '$round')";
									}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep2_mon where distance > $dis and comment = '' and date = '$date'  ";
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep2_mon where distance > $dis and comment <> '' and date = '$date'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep2_mon where date = '$date' and round = '$round' ";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep2_mon where date = '$date')
											UNION
											SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_mon where distance > $dis AND date = '$date' ";
								}

								}
								//after
								if($time == '3'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep2_after where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep2_after where distance > $dis and comment = '' and date = '$date' ";
									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep2_after where distance > $dis and comment <> '' and date = '$date' ";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep2_after where date = '$date' and round = '$round'";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep2_after where date = '$date')
												UNION
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_after where distance > $dis AND date = '$date' ";
									}

								}

								//alltime
								if($time == 'all'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep2_mon where date = '$date' and round = '$round')
												UNION
												select * from tb_user where not tb_user.id in(select id from tb_rep2_after where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep2_mon where distance > $dis and comment = '' and date = '$date' 
												UNION ALL
												select * from tb_rep2_after where distance > $dis and comment = '' and date = '$date' ";

									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep2_mon where distance > $dis and comment <> '' and date = '$date' 
												UNION ALL
												select * from tb_rep2_after where distance > $dis and comment <> '' and date = '$date'";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep2_mon where date = '$date' and round = '$round'
												UNION ALL
												select * from tb_rep2_after where date = '$date' and round = '$round'";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep2_mon where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_mon where distance > $dis AND date = '$date' 
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep2_after where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_after where distance > $dis AND date = '$date' ";
									}

								}
							}
							}
							//morning
							else{
								if($seljob == '1'){
								if($time == '1'){
								//ไม่เช็คชื่อ
								if($fun == '1'){
									$sql = "select * from tb_user where grop = '$grop' and not tb_user.id in(select id from tb_rep_mon where date = '$date' and round = '$round')";
								}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep_mon where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'";
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep_mon where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep_mon where date = '$date' and grop = '$grop_name' and round = '$round'";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep_mon where date = '$date')
											UNION
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_mon where distance > $dis AND date = '$date' and grop = '$grop_name'";
								}

								}
								//after
								if($time == '2'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep_after where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep_after where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'";
									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep_after where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep_after where date = '$date' and grop = '$grop_name' and round = '$round'";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep_after where date = '$date')
												UNION
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_after where distance > $dis AND date = '$date' and grop = '$grop_name'";
									}

								}
								//eve
								if($time == '3'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep_eve where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep_eve where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'";
									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep_eve where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep_eve where date = '$date' and grop = '$grop_name' and round = '$round'";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_eve where date = '$date' and grop = '$grop_name')
												UNION
												SELECT id,type,name,lname,tel,distance,comment FROM tb_rep_eve where distance > $dis AND date = '$date' and grop = '$grop_name'";
									}

								}
								//alltime
								if($time == 'all'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep_mon where date = '$date' and round = '$round')
												UNION
												select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep_after where date = '$date' and round = '$round')
												UNION
												select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep_eve where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep_mon where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'
												UNION ALL
												select * from tb_rep_after where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'
												UNION ALL
												select * from tb_rep_after where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'";

									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep_mon where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'
												UNION ALL
												select * from tb_rep_after where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'
												UNION ALL
												select * from tb_rep_eve where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep_mon where date = '$date' and grop = '$grop_name' and round = '$round'
												UNION ALL
												select * from tb_rep_after where date = '$date' and grop = '$grop_name' and round = '$round'
												UNION ALL
												select * from tb_rep_eve where date = '$date' and grop = '$grop_name' and round = '$round'";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep_mon where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_mon where distance > $dis AND date = '$date' and grop = '$grop_name'
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep_after where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_after where distance > $dis AND date = '$date' and grop = '$grop_name'
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep_eve where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_eve where distance > $dis AND date = '$date' and grop = '$grop_name'";
									}

								}
								
							}else if($seljob == '2'){
								if($time == '1'){
								//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where grop = '$grop' and not tb_user.id in(select id from tb_rep2_mon where date = '$date' and round = '$round')";
									}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep2_mon where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'";
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep2_mon where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep2_mon where date = '$date' and grop = '$grop_name' and round = '$round'";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep2_mon where date = '$date')
											UNION
											SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_mon where distance > $dis AND date = '$date' and grop = '$grop_name'";
								}

								}
								//after
								if($time == '3'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep2_after where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep2_after where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'";
									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep2_after where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep2_after where date = '$date' and grop = '$grop_name' and round = '$round'";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep2_after where date = '$date')
												UNION
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_after where distance > $dis AND date = '$date' and grop = '$grop_name'";
									}

								}

								//alltime
								if($time == 'all'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep2_mon where date = '$date' and round = '$round')
												UNION
												select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep2_after where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep2_mon where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'
												UNION ALL
												select * from tb_rep2_after where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'";

									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep2_mon where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'
												UNION ALL
												select * from tb_rep2_after where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep2_mon where date = '$date' and grop = '$grop_name' and round = '$round'
												UNION ALL
												select * from tb_rep2_after where  date = '$date' and grop = '$grop_name' and round = '$round'";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep2_mon where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_mon where distance > $dis AND date = '$date' and grop = '$grop_name'
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep2_after where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_after where distance > $dis AND date = '$date' and grop = '$grop_name'";
									}

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
									if($dis_com <> ''){
										$no = number_format($dis_com);
										if($dis_com < 1){
											$dis_com_value = 'Vandapac';
										}else{
											$dis_com_value = '';
										}	
										
									}
									else{
										$dis_com_value = '';
									}
								}
								
				
							
					?>
					<tr>
						<td><?php echo $id ?> <?php echo $fullname ?></td>
						<td hidden=""></td>
						<td><a href="tel:<?php echo $tel ?>" target="_blank"><?php echo $tel ?></a></td>
						<td><a class="btn" href="#map" data-role="Mapgo" data-lat="<?php echo $lat ?>" data-lon="<?php echo $lon ?>"><?php echo $distance ?></a></td>
						<td><?php echo $dis_com_value ?></td>
						<td><?php echo $comment ?></td>
						<td hidden="">
							<div class="btn-group dropleft">
								  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="far fa-address-card"></i>
								  </button>
								  <div class="dropdown-menu">
									<input type="button" class="dropdown-item btn"  data-role='updateuser' data-id="<?php echo $id ?>"  value="แก้ไขข้อมูลพนักงาน">
								  </div>
								</div>
						</td>
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
	function fn_selround(){
		var seltime = $('#seltime').val();
		var seljob = $('#seljob').val();
		var date = $('#date').val();
		var type = 'get_round';
		document.getElementById('selround0').selected = true;

		if(seltime == '0'){
			document.getElementById('selround').disabled = true;
		}
		else{
			document.getElementById('selround').disabled = false;
			$.ajax({
			url : 'admincheck_ajax.php',
			method : 'post',
			data : {type:type,
				   seltime:seltime,
				   seljob:seljob,
				   date:date},
			success:function(result){
				var data = JSON.parse(result);
				var selround = $('#selround');
				var n = data.length;
				if(n == 0){
					selround.html('<option id="selround0" value="0">เลือกรอบ</option> <option id="selround1" value="1">1</option>');
				}else{
					selround.html('<option id="selround0" value="0">เลือกรอบ</option>');
				}
				
				$.each(data,function(index, item){
					selround.append(
					 $('<option></option>').val(item.round).html(item.round)
					)
				})
			}
		})
		}
		
	}
	
	function checktime(){
		var date = $('#date').val();
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
		var date = $('#date').val();
		var seltime =$('#seltime').val();
		var selfun = $('#selfun').val();
		var selgrop = $('#selgrop').val();
		var seljob = $('#seljob').val();
		var selround = $('#selround').val();
		var Ldate = date.length;
		var Lseltime = seltime.length;
		var Lselfun = selfun.length;
		 if(Ldate == '0'){
			alert('เลือกวันที่!!!');
		}
		else if(selgrop == '0'){
			alert('เลือกกลุ่ม!!!');
		}else if (seljob == '0'){
			alert('เลือกกะการทำงาน');
		}
		else if(seltime == '0'){
			alert('เลือกช่วงเวลา!!!');
		}
		else if(selround == '0'){
			alert('เลือกรอบ');
		}
		else if(selfun == '0'){
			alert('เลือกเงื่อนไข!!!');
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