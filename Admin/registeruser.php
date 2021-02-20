<!doctype html>
<?php 
include('connect.php');
include('loginchecking.php');
$selgrop = $_SESSION['grop'];
$level = $_SESSION['level'];
if(isset($_GET['id'])){
	$id = $_GET['id'];
}else{
	$id = '';
}
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover" >
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="shortcut icon" href="#" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<style>
	.dropdown-item:hover{
		color: black;
		background-color: lightblue;
	}
</style>
<script>	
	function loaddata(){
		$.ajax({
					url:"tableregister.php",
					type:"POST",
					cache:false,
					success:function(dataResult){
						$('#tablebody').html(dataResult);
					}
		});
	}
	
	$(document).ready(function(){
		var com1 = $('#M1sel_com');
		var site1 = $('#M1sel_site');
		var dept1 = $('#M1sel_dept');
		
		com1.on('change',function(){
			var comid = $(this).val();
			site1.html('<option value="0">-----</option>');
			dept1.html('<option value="0">-----</option>');
			site1.attr('disabled',false);
			$.get('getsite.php?comid='+comid,function(data){
				var result = JSON.parse(data);
				$.each(result,function(index, item){
					site1.append(
					 $('<option></option>').val(item.id).html(item.name)
					)
				})
			})
		});
		
		//site chang
		site1.on('change',function(){
		var siteid= $(this).val();
		dept1.html('<option value="0">-----</option>');
		dept1.attr('disabled',false);
		$.get('getdept.php?siteid='+siteid,function(data){
			var result = JSON.parse(data);
			$.each(result, function(index, item){
				dept1.append(
					$('<option></option>').val(item.id).html(item.id+'  |  '+item.name)
				);
			});
		});
	});
		
		var com = $('#M2sel_com');
		var site = $('#M2sel_site');
		var dept = $('#M2sel_dept');
		
		com.on('change',function(){
			var comid = $(this).val();
			site.html('<option value="0">-----</option>');
			dept.html('<option value="0">-----</option>');
			$.get('getsite.php?comid='+comid,function(data){
				var result = JSON.parse(data);
				$.each(result,function(index, item){
					site.append(
					 $('<option></option>').val(item.id).html(item.name)
					)
				})
			})
		});
		
		//site chang
		site.on('change',function(){
		var siteid= $(this).val();
			dept.html('<option value="0">-----</option>');
		$.get('getdept.php?siteid='+siteid,function(data){
			var result = JSON.parse(data);
			$.each(result, function(index, item){
				dept.append(
					$('<option></option>').val(item.id).html(item.name)
				);
			});
		});
	});
		
		
		//delete data
		$(document).on('click','a[data-role=Delete]',function(){
			var r = confirm('ยืนยันการลบข้อมูล?');
			if(r == true){
				var id = $(this).data('id');
				var grop = $('#grop').val();
				$.ajax({
				url:"registerdelete.php",
				type:"POST",
				cache:false,
				data:{id:id,
					 grop:grop},
				success:function(dataResult){
					loaddata();
				}
				});
			}
			
		});
		//update data
		$(document).on('click','a[data-role=update]',function(){
			var id = $(this).data('id');
			var type =$('#'+id).children('td[data-target=type]').text();
			var name =$('#'+id).children('td[data-target=name]').text();
			var lname =$('#'+id).children('td[data-target=lname]').text();
			var tel =$('#'+id).children('td[data-target=tel]').text();
			var loc = $('#'+id).children('td[data-target=loc]').text();
			var com = $('#'+id).children('td[data-target=com]').text();
			var site = $('#'+id).children('td[data-target=site]').text();
			var dept = $('#'+id).children('td[data-target=dept]').text();
		
			
			
			$('#M2id').val(id);
			$('#M2type').val(type);
			$('#M2name').val(name);
			$('#M2lname').val(lname);
			$('#M2tel').val(tel);
			$.ajax({
				url:'modal_status_tel.php',
				type:'post',
				data:{id:id},
				success:function(Result){
					console.log(Result);
					if(Result == 'NO'){
						document.getElementById('status_tel_no2').selected = "true";
						console.log('selno');
					}else{
						document.getElementById('status_tel_yes2').selected = "true";
						console.log('selyes');
					}
				}
			});
			$.ajax({
				url:"modalloc.php",
				type:"POST",
				cache:false,
				data:{loc:loc},
				success:function(dataResult){
					document.getElementById('M2sel_loc'+dataResult).selected = "true";
				}
			});
			$.ajax({
				url: "modalcom.php",
				type:"POST",
				cache:false,
				data:{com:com},
				success:function(dataResult){
					document.getElementById('M2sel_com'+dataResult).selected = "true";
					var com = $('#M2sel_com');
					var site = $('#M2sel_site');
					var dept = $('#M2sel_dept');
					var comid = $('#M2sel_com').val();
					site.html('<option value="0">-----</option>');
					dept.html('<option value="0">-----</option>');
					$.get('getsite.php?comid='+comid,function(data){	
							var result = JSON.parse(data);
							$.each(result,function(index, item){
								site.append(
								 $(`<option id="M2sel_site${item.id}"></option>`).val(item.id).html(item.name)
								)
							})
							modalsite();
						})
				}
				
			});
			function modalsite(){
				var com2 = document.getElementById('M2sel_com').value;
				$.ajax({
				url	:"modalsite.php",
				type	:"POST",
				cache	:false,
				data	:{site:site,
						 com:com2,
						 },
				success	:function(dataResult){
					document.getElementById('M2sel_site'+dataResult).selected = "true";
					var siteid= $('#M2sel_site').val();
					var dept = $('#M2sel_dept');
					dept.html('<option value="0">-----</option>');
					$.get('getdept.php?siteid='+siteid,function(data){
						var result = '';
						result = JSON.parse(data);
						$.each(result, function(index, item){
							dept.append(
								$(`<option id="M2sel_dept${item.id}"></option>`).val(item.id).html(item.name)
							);
						});
						modaldept();
					});
				}
				});
			}
			
			function modaldept(){
				var siteid = document.getElementById('M2sel_site').value;
				$.ajax({
					url		:"modaldept.php",
					type	:"POST",
					cache	:false,
					data	:{dept:dept,
							 siteid:siteid},
					success:function(dataResult){
						document.getElementById('M2sel_dept'+dataResult).selected = "true";
					}
				})
			}
			//การแสดงผลกลุ่ม
			$.ajax({
				url : "showloc.php",
				type : "post",
				cache : false,
				data : {loc:loc},
				success:function(dataResult){
						loc = dataResult;
						$.ajax({
						url : "showgrop.php",
						type : "post",
						cache : false,
						data : {loc:loc},
						success:function(dataResult){
							var grop = $('#M2sel_grop');
							var result = JSON.parse(dataResult);
							grop.html('<option value="0">-----</option>');
							$.each(result, function(index, item){
									grop.append(
										$(`<option id="M2sel_grop${item.id}"></option>`).val(item.id).html(item.name)
									);
							});
							callgrop();
						}
					});
				}
			})
			function callgrop(){
			var grop = $('#'+id).children('td[data-target=grop]').text();
			$.ajax({
					url		: "modalgrop.php",
					type	: "POST",
					cache	: false,
					data	:{grop:grop},
					success:function(dataResult){

						document.getElementById('M2sel_grop'+dataResult).selected = "true";
					}
			})
			}	
			$('#modalupdate2').modal('toggle');
				
		})
		
		//updatelocation
		$(document).on('click','a[data-role=updatelocation]',function(){
			var id = $(this).data('id');
			var type =$('#'+id).children('td[data-target=type]').text();
			var name =$('#'+id).children('td[data-target=name]').text();
			var lname =$('#'+id).children('td[data-target=lname]').text();
			var tel =$('#'+id).children('td[data-target=tel]').text();
			
			$('#Mul_id').val(id);
			$('#Mul_name').val(type+name);
			$('#Mul_lname').val(lname);
			$.ajax({
				url : "modal3calllocation.php",
				type : "POST",
				cache : false,
				data : {id:id},
				success:function(dataResult){
					$('#Mul_loca').val(dataResult);
				}
			})
			$.ajax({
				url : "modal3calllocation2.php",
				type : "POST",
				cache : false,
				data : {id:id},
				success:function(dataResult){
					var link = document.getElementById('Mul_localink').href = dataResult;
				}
			})
			$.ajax({
				url : "modal3table.php",
				type : "POST",
				cache : false,
				data : {id:id},
				success:function(dataResult){
					$('#Mul_table').html(dataResult);
				}
			})
			document.getElementById('Mul_sel_time').selectedIndex = "0";
			$('#modalupdatelocation').modal("toggle");
		})
		
		$('#Mul_sel_time').on('change',function(){
			var id = document.getElementById('Mul_id').value;
			var time = document.getElementById('Mul_sel_time').value;
			$.ajax({
				url : 'modal3table.php',
				method : 'post',
				data : {time:time,
					   id:id},
				success:function(dataResult){
					$('#Mul_table').html(dataResult);
				}
			})
		})
	});
	//ค้นหาข้อมูลในตาราง
	function sertdatatable(){
		if(event.keyCode === 13){
			var text = document.getElementById('serttable').value;
			var grop = $('#grop').val();
			$.ajax({
						url:"tableregister.php",
						type:"POST",
						cache:false,
						data : {txt:text,
							   grop:grop},
						success:function(dataResult){
							$('#tablebody').html(dataResult);
							$('#serttable').val('');
						}
			});
		}
		
	}
	
	//เพิ่มข้อมูลพนักงาน
	function adduser(){
		$('#modalupdate').modal('toggle')
	}
	
	function adduser2(){
		var id = document.getElementById('M1id').value;
		var type = document.getElementById('M1type').value;
		var name = document.getElementById('M1name').value;
		var lname = document.getElementById('M1lname').value;
		var loc = document.getElementById('M1sel_loc').value;
		var com = document.getElementById('M1sel_com').value;
		var site = document.getElementById('M1sel_site').value;
		var dept = document.getElementById('M1sel_dept').value;
		var grop = document.getElementById('M1sel_grop').value;
		var tel = document.getElementById('M1tel').value;
		var status_tel = document.getElementById('status_tel').value;
		if(id == '' || type == '' || name == '' || lname == '' ||loc == '' || com == '' || site == '' || dept == '' || grop == '' || tel == '' ){
			alert('กรอกข้อมูลให้ครบทุกช่อง!!!');
		}
		else{
			$.ajax({
				url : "registercheck.php",
				type: "POST",
				cache: false,
				data:{id:id},
				success:function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$.ajax({
							url : "registeradd.php",
							type : "POST",
							cache : false,
							data:{
								loc:loc,
								com:com,
								site:site,
								dept:dept,
								grop:grop,
								id:id,
								type:type,
								name:name,
								lname:lname,
								tel:tel,
								status_tel:status_tel,
							},
							success:function(dataResult){
								var dataResult = JSON.parse(dataResult);
								if(dataResult.statusCode==200){
									alert('บันทึกข้อมูลสำเร็จ')
									document.getElementById('M1id').value = '';
									document.getElementById('M1type').value = '';
									document.getElementById('M1name').value = '';
									document.getElementById('M1lname').value = '';
									document.getElementById('M1sel_loc').value = '';
									document.getElementById('M1sel_com').value = '';
									document.getElementById('M1sel_site').value = '';
									document.getElementById('M1sel_dept').value = '';
									document.getElementById('M1sel_grop').value = '';
									document.getElementById('M1tel').value = '';
									$('#modalupdate').modal('toggle');
									loaddata();
								}
								else{
									alert('บันทึกข้อมูลสำเร็จไม่สำเร็จ')
								}
							}
						})
					}
					else{
						var check = confirm('มีรหัสพนักงานนี้แล้ว คุณต้องการอัพเดทข้อมูล?');
						if(check == true){
							$.ajax({
							url : "registerupdate.php",
							type : "POST",
							cache : false,
							data:{
								loc:loc,
								com:com,
								site:site,
								dept:dept,
								grop:grop,
								id:id,
								type:type,
								name:name,
								lname:lname,
								tel:tel,
							},
							success:function(dataResult){
								var dataResult = JSON.parse(dataResult);
								if(dataResult.statusCode==200){
									alert('บันทึกข้อมูลสำเร็จ')
									document.getElementById('M1id').value = '';
									document.getElementById('M1type').value = '';
									document.getElementById('M1name').value = '';
									document.getElementById('M1lname').value = '';
									document.getElementById('M1sel_loc').value = '';
									document.getElementById('M1sel_com').value = '';
									document.getElementById('M1sel_site').value = '';
									document.getElementById('M1sel_dept').value = '';
									document.getElementById('M1sel_grop').value = '';
									document.getElementById('M1tel').value = '';
									$('#modalupdate').modal('toggle')
									loaddata();
								}
								else{
									alert('บันทึกข้อมูลสำเร็จไม่สำเร็จ')
								}
							}
						})
						}
						else{
							document.getElementById('M1id').value = '';
									document.getElementById('M1type').value = '';
									document.getElementById('M1name').value = '';
									document.getElementById('M1lname').value = '';
									document.getElementById('M1sel_loc').value = '';
									document.getElementById('M1sel_com').value = '';
									document.getElementById('M1sel_site').value = '';
									document.getElementById('M1sel_dept').value = '';
									document.getElementById('M1sel_grop').value = '';
									document.getElementById('M1tel').value = '';
									$('#modalupdate').modal('toggle')
						}
					}
				}
			})
		}
	}

$(document).ready(function(){
	$('#M2sel_loc').on('change',function(){
		var locid = document.getElementById('M2sel_loc').value;
		$.ajax({
			url : "showgrop.php",
			type : "post",
			cache : false,
			data : {loc:locid},
			success:function(dataResult){
				var grop = $('#M2sel_grop');
				var result = JSON.parse(dataResult);
				console.log(result);
				grop.html('<option value="0">-----</option>');
						$.each(result, function(index, item){
							grop.append(
								$(`<option></option>`).val(item.no).html(item.name)
							);
						});
			}
		});
	})
});
	
	
</script>
<script type="text/javascript" >
//disable back button
history.pushState(null, null, '');
window.addEventListener('popstate', function(event) {
  history.pushState(null, null, '');
});
</script>
<title>ข้อมูลพนักงาน</title>
</head>

<body>
	<form>
		<div class="container-fluid">
			<div class="row-cols-12" align="center">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">

  							<a class="navbar-brand" href="#">Admin</a>

  							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">

    							<span class="navbar-toggler-icon"></span>

  							</button>

  							<div class="collapse navbar-collapse" id="navbarNavAltMarkup">

    							<div class="navbar-nav">

      								<a class="nav-item nav-link active" href="admin.php" >นำข้อมูลออกเป็นไฟล์ Excel</a>
									

									<a class="nav-item nav-link active" href="admincheck.php" >ตรวจสอบการเช็คชื่อ</a>
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
			<br><br>
			<div class="row-cols-12" align="center">
			<label class="text-primary">ข้อมูลพนักงาน</label>
			</div>
			<br>
			<div class="row">
			<div class="col-3" align="left">
				<input type="button" name="btninsert" id="btninsert" class="btn btn-sm btn-outline-success form-control" value="เพิ่มข้อมูล" onClick="adduser()">
				<input type="hidden" id="grop" value="<?php echo $selgrop ?>">
			</div>
			<div class="col-6"></div>
			<div class="col-3" align="right">
			<input type="text" name="serttable" id="serttable" placeholder="ป้อนข้อมูลที่ต้องการค้นหา(รหัส/เบอร์โทร/ชื่อ/นามสกุล)" class="form-control" onKeyUp="sertdatatable()">
			
			</div>
			</div>	
			<br>
			<div class="row-cols-12" align="center">
			
			<table id="table" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th></th>
						<th>สถานที่</th>
						<th>โรงงาน</th>
						<th>แผนก</th>
						<th>หน่วยงาน</th>
						<th>กลุ่ม</th>
						<th>รหัสพนักงาน</th>
						<th>คำนำหน้าชื่อ</th>
						<th>ชื่อ</th>
						<th>นามสกุล</th>
						<th>เบอร์โทร</th>
						
					</tr>
				</thead>
				<tbody id="tablebody">
					
				</tbody>
			</table>
			</div>
			<!-- modal update-->
			<div class="modal fade bd-example-modal-xl" id="modalupdate2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body" style="background-color: lightgray">
					<div class="row">
						<div class="col-3">
							<label>สถานที่</label>
						</div>  
						<div class="col-3">
							<label>โรงงาน</label>
						</div>
						<div class="col-3">
							<label>แผนก</label>
						</div>
						<div class="col-3">
							<label>หน่วยงาน</label>
						</div>
					</div>
					<div class="row" >
						<div class="col-3">
							<input type="hidden" id="HM2loc" name="HM2loc">
							<select id="M2sel_loc" name="M2sel_loc" class="form-control">
								<option value="0">------</option>
								<?php 
								$sqllocation = "select * from tb_location";
								$resultloc = mysqli_query($conn,$sqllocation);
								while($rowloc = mysqli_fetch_assoc($resultloc)){
								?>
								<option id="M2sel_loc<?php echo $rowloc['id']?>" value="<?php echo $rowloc['id']?>"><?php echo $rowloc['name']?></option>
								<?php
								}
								?>
							</select>
						</div> 
						<div class="col-3">
							<input type="hidden" id="HM2com" name="HM2com">
							<select id="M2sel_com" name="M2sel_com" class="form-control">
								<option value="0">-----</option>
								<?php 
								$sqlcom = "select *from tb_com";
								$resultcom = mysqli_query($conn,$sqlcom);
								while($rowcom = mysqli_fetch_assoc($resultcom)){
								?>
								<option id="M2sel_com<?php echo $rowcom['id']?>" value="<?php echo $rowcom['id']?>"><?php echo $rowcom['name']?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="col-3">
							<input type="hidden" id="HM2site" name="HM2site">
							<select id="M2sel_site" name="M2sel_site" class="form-control">
							
							</select>
						</div>
						<div class="col-3">
							<input type="hidden" id="HM2dept" name="HM2dept">
							<select id="M2sel_dept" name="M2sel_dept" class="form-control">
							
							</select>
						</div>
					</div>
					 <br>
					  <div class="row">
					  		<div class="col-3">
						  		<label>รหัสพนักงาน</label>
						  	</div>
					  		<div class="col-3">
						  		<label>คำนำหน้าชื่อ</label>
						  	</div>
					  		<div class="col-3">
						  		<label>ชื่อ</label>
						  	</div>
					  		<div class="col-3">
						  		<label>นามสกุล</label>
						  	</div>
					  </div>
					  <div class="row">
					  		<div class="col-3">
						  		<input type="text" name="M2id" id="M2id" class="form-control" readonly>
						  	</div>
						  	<div class="col-3">
						  		<input type="text" name="M2type" id="M2type" class="form-control">
						  	</div>
						  	<div class="col-3">
						  		<input type="text" name="M2name" id="M2name" class="form-control">
						  	</div>
						  	<div class="col-3">
						  		<input type="text" name="M2lname" id="M2lname" class="form-control">
						  	</div>
					  </div>
					 <br>
					  <div class="row">
					  		<div class="col-3">
						  		<label>กลุ่ม</label>
						  	</div>
						  	<div class="col-3">
						  		<label>เบอร์มือถือ</label>
						  	</div>
						  	<div class="col-3">
								<label hidden="">ใช้การโทร</label>
						  	</div>
						  	<div class="col-3">
						  
						  	</div>
					  </div>
					  <div class="row">
					  		<div class="col-3">
								<input type="hidden" id="HM2grop" name="HM2grop">
						  		<select id="M2sel_grop" name="M2sel_grop" class="form-control">
									<option value="0">-----</option>
									<?php 
										$sqlgrop = "select * from tb_grop";
										$resultgrop = mysqli_query($conn,$sqlgrop);
										while($rowgrop = mysqli_fetch_assoc($resultgrop)){
										?>
										<option id="M2sel_grop<?php echo $rowgrop['id']?>" value="<?php echo $rowgrop['id']?>"><?php echo $rowgrop['name']?></option>
									<?php
										}
									?>
								</select>
						  	</div>
						  	<div class="col-3">
						  		<input type="text" id="M2tel" name="M2tel" class="form-control">
						  	</div>
						  	<div class="col-3" hidden="">
						  		<select id="status_tel2" name="status_tel2" class="form-control">
									<option id="status_tel_no2" value="NO">NO</option>
									<option id="status_tel_yes2" value="YES">YES</option>
								</select>
						  	</div>
						  	<div class="col-3">
						  
						  	</div>
					  </div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onClick="updatemodal2()">Save changes</button>
				  </div>
				</div>
			  </div>
			</div>
			
			
			<!-- modal insert -->
			<div class="modal fade bd-example-modal-xl" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body" style="background-color: lightgray">
					<div class="row">
						<div class="col-3">
							<label>สถานที่</label>
						</div>  
						<div class="col-3">
							<label>โรงงาน</label>
						</div>
						<div class="col-3">
							<label>แผนก</label>
						</div>
						<div class="col-3">
							<label>หน่วยงาน</label>
						</div>
					</div>
					<div class="row" >
						<div class="col-3">
							<select id="M1sel_loc" name="M1sel_loc" class="form-control">
								<option value="0">------</option>
								<?php 
								$sqllocation = "select * from tb_location";
								$resultloc = mysqli_query($conn,$sqllocation);
								while($rowloc = mysqli_fetch_assoc($resultloc)){
								?>
								<option value="<?php echo $rowloc['id']?>"><?php echo $rowloc['name']?></option>
								<?php
								}
								?>
							</select>
						</div> 
						<div class="col-3">
							<select id="M1sel_com" name="M1sel_com" class="form-control">
								<option value="0">-----</option>
								<?php 
								$sqlcom = "select *from tb_com";
								$resultcom = mysqli_query($conn,$sqlcom);
								while($rowcom = mysqli_fetch_assoc($resultcom)){
								?>
								<option value="<?php echo $rowcom['id']?>"><?php echo $rowcom['name']?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="col-3">
							<select id="M1sel_site" name="M1sel_site" class="form-control" disabled>
							
							</select>
						</div>
						<div class="col-3">
							<select id="M1sel_dept" name="M1sel_dept" class="form-control" disabled>
							
							</select>
						</div>
					</div>
					 <br>
					  <div class="row">
					  		<div class="col-3">
						  		<label>รหัสพนักงาน</label>
						  	</div>
					  		<div class="col-3">
						  		<label>คำนำหน้าชื่อ</label>
						  	</div>
					  		<div class="col-3">
						  		<label>ชื่อ</label>
						  	</div>
					  		<div class="col-3">
						  		<label>นามสกุล</label>
						  	</div>
					  </div>
					  <div class="row">
					  		<div class="col-3">
						  		<input type="text" name="M1id" id="M1id" class="form-control">
						  	</div>
						  	<div class="col-3">
						  		<input type="text" name="M1type" id="M1type" class="form-control">
						  	</div>
						  	<div class="col-3">
						  		<input type="text" name="M1name" id="M1name" class="form-control">
						  	</div>
						  	<div class="col-3">
						  		<input type="text" name="M1lname" id="M1lname" class="form-control">
						  	</div>
					  </div>
					 <br>
					  <div class="row">
					  		<div class="col-3">
						  		<label>กลุ่ม</label>
						  	</div>
						  	<div class="col-3">
						  		<label>เบอร์มือถือ</label>
						  	</div>
						  	<div class="col-3">
								<label hidden="">ใช้การโทร</label>
						  	</div>
						  	<div class="col-3">
						  
						  	</div>
					  </div>
					  <div class="row">
					  		<div class="col-3">
						  		<select id="M1sel_grop" name="M1sel_grop" class="form-control">
									<option value="0">-----</option>
									<?php 
										$sqlgrop = "select * from tb_grop";
										$resultgrop = mysqli_query($conn,$sqlgrop);
										while($rowgrop = mysqli_fetch_assoc($resultgrop)){
										?>
										<option value="<?php echo $rowgrop['id']?>"><?php echo $rowgrop['name']?></option>
									<?php
										}
									?>
								</select>
						  	</div>
						  	<div class="col-3">
						  		<input type="text" id="M1tel" name="M1tel" class="form-control">
						  	</div>
						  	<div class="col-3" hidden="">
						  		<select id="status_tel" name="status_tel" class="form-control">
									<option id="status_tel_no" value="NO" selected>NO</option>
									<option id="status_tel_yes" value="YES">YES</option>
								</select>
						  	</div>
						  	<div class="col-3">
						  
						  	</div>
					  </div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onClick="adduser2()">Save changes</button>
				  </div>
				</div>
			  </div>
			</div>
			
			<!-- modal update location-->
			<div class="modal fade bd-example-modal-xl" id="modalupdatelocation" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update Location</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
						<div class="col-3">
							<label>รหัสพนักงาน</label>
						</div> 
						<div class="col-3">
							<label>ชื่อ</label>
						</div>  
						<div class="col-3">
							<label>นามสกุล</label>
						</div>  
						<div class="col-3">
						
						</div>  
					</div>
					<div class="row">
						<div class="col-3">
							<input type="text" id="Mul_id" name="Mul_id" class="form-control" readonly>
						</div>  
						<div class="col-3">
							<input type="text" id="Mul_name" name="Mul_name" class="form-control" readonly>
						</div>  
						<div class="col-3">
							<input type="text" id="Mul_lname" name="Mul_lname" class="form-control" readonly>
						</div>  
						<div class="col-3">
						
						</div>  
					</div>
					  <br>
					  <div class="row">
					  	<div class="col-4">
						  <label>ตำแหน่งปัจจุบัน</label>
						</div>
						<div class="col-4">
						  
						</div>
						<div class="col-4">
						  
						</div>
					  </div>
					  <div class="row">
					  	<div class="col-4">
						  <input type="text" id="Mul_loca" name="Mul_loca" class="form-control" readonly>
						</div>
						<div class="col-4">
						  <a id="Mul_localink" target="_blank" href="" class="btn btn-success">Google Map</a>
							&nbsp;&nbsp;&nbsp;
							<input type="button" class="btn btn-info" data-role='locationname1' value="แก้ไขชื่อ">
						</div>
						<div class="col-4" align="left">
						  
						</div>
					  </div>
					  <br>
					  <div class="row-cols-12">
						<label>ประวัติการแชร์ตำแหน่ง</label>
					  </div>
						 <br>
					  <div class="row-cols-4">
						 <select id="Mul_sel_time" class="form-control">
							 <option value="1">เลือกรอบ</option>
						  	<option value="1">รอบเช้า</option>
							 <option value="2">รอบบ่าย</option>
							 <option value="3">รอบพิเศษ</option>
						 </select>
					  </div>
						 <br>
					<div class="row-cols-12">
					  	<table class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>วันที่</th>
									<th>เวลา</th>
									<th>ชื่อตำแหน่ง</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody id="Mul_table" >
								
							</tbody>
						</table>
					  </div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
				  </div>
				</div>
			  </div>
			</div>
			
			<!-- Modal updatelocationname 1 -->
			<div class="modal fade" id="modal_updatelocationname1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">แก้ไขชื่อจุดที่ 1</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
						<div class="row-cols-12">
					  		<label>ชื่อจุดที่ 1</label>
							<br>
							<input type="text" class="form-control" id="txt_namelocation1">
							<hr color="#000000">
					  	</div>
				  </div>
				  <div class="modal-footer">
					<input type="button" class="btn btn-secondary" value="ยกเลิก" data-role="cancleupdatelocationname1">
							&nbsp;&nbsp;&nbsp;
							<input type="button" class="btn btn-success" value="บันทึก" data-role="updatelocationname1">
				  </div>
				</div>
			  </div>
			</div>
			<!-- script updatenamelocation1 -->
			<script>
				$(document).on('click','.btn',function(){
					var data = $(this).data('role');
					if(data == 'locationname1'){
						var id = document.getElementById('Mul_id').value;
						var type = 'updatelocationname1';
						$.ajax({
							url : 'ajax_registeruser.php',
							method : 'post',
							data : {type:type,
								   id,id,
								   },
							success:function(dataResult){
								var data = JSON.parse(dataResult);
								var nameloction = data.namelocation;

								$('#txt_namelocation1').val(nameloction);
								$('#modalupdatelocation').modal('toggle');
								$('#modal_updatelocationname1').modal('toggle');
							}
						});
						
						
					}
					if(data == 'cancleupdatelocationname1'){
						$('#modal_updatelocationname1').modal('toggle');
					}
					if(data == 'updatelocationname1'){
						var namelocation = $('#txt_namelocation1').val();
						if(namelocation == ''){
							alert('ใส่ชื่อจุดที่ 1 !!!');
						}
						else{
							var id = $('#Mul_id').val();
							var type = 'updatelocationname2';
							$.ajax({
								url : 'ajax_registeruser.php',
								method : 'post',
								data : {type:type,
									   id:id,
									   namelocation:namelocation,
									   },
								success:function(dataResult){
									var data = JSON.parse(dataResult);
									if(data.result == '200'){
										alert('บันทึกข้อมูลสำเร็จ!!!');
										$('#modal_updatelocationname1').modal('toggle');
									}else{
										alert('Error:Check Ajax');
									}
										
								}
							});
						}
						
					}
				})
			</script>
			<!-- script updatelocation-->
			<script>
				
			$(document).on('click','a[data-role=updateloc]',function(){
				var dataid = $(this).data('id');
				var round = $(this).data('id2');
				$.ajax({
					url : "updatelocation.php",
					type : "POST",
					cache : false,
					data : {dataid:dataid,
						   round:round},
					success:function(dataResult){
						var dataResult = JSON.parse(dataResult)
						if(dataResult.statusCode==200){
							alert('อัพเดทตำแหน่งสำเร็จ!!')
							$('#modalupdatelocation').modal("toggle");
						}else{
							alert('อัพเดทตำแหน่งไม่สำเร็จ!!')
						}
					}
		
				});
			});
			
			
			</script>
			
			<!-- modal update location2-->
			<div class="modal fade bd-example-modal-xl" id="modalupdatelocation2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">อัพเดทที่ตั้ง 2</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
						<div class="col-3">
							<label>รหัสพนักงาน</label>
						</div> 
						<div class="col-3">
							<label>ชื่อ</label>
						</div>  
						<div class="col-3">
							<label>นามสกุล</label>
						</div>  
						<div class="col-3">
						
						</div>  
					</div>
					<div class="row">
						<div class="col-3">
							<input type="text" id="Mul2_id" name="Mul2_id" class="form-control" readonly>
						</div>  
						<div class="col-3">
							<input type="text" id="Mul2_name" name="Mul2_name" class="form-control" readonly>
						</div>  
						<div class="col-3">
							<input type="text" id="Mul2_lname" name="Mul2_lname" class="form-control" readonly>
						</div>  
						<div class="col-3">
						
						</div>  
					</div>
					  <br>
					  <div class="row">
					  	<div class="col-4">
						  <label>ตำแหน่งปัจจุบัน</label>
						</div>
						<div class="col-4">
						  
						</div>
						<div class="col-4">
						  
						</div>
					  </div>
					  <div class="row">
					  	<div class="col-4">
						  <input type="text" id="Mul2_loca" name="Mul2_loca" class="form-control" readonly>
						</div>
						<div class="col-4">
						  <a id="Mul2_localink" target="_blank" href="" class="btn btn-success">Google Map</a>
							&nbsp;&nbsp;&nbsp;
							<input type="button" class="btn btn-info" data-role='locationname2' value="แก้ไขชื่อ">
							&nbsp;&nbsp;&nbsp;
							<input type="button" class="btn btn-secondary" data-role='updatelatlng' value="แก้ไขที่อยู่">
						</div>
						<div class="col-4">
						  
						</div>
					  </div>
					  <br>
					  <div class="row-cols-12">
						<label>ประวัติการแชร์ตำแหน่ง</label>
						 <br>
						</div>
					  <div class="row-cols-4">
						 <select id="Mul2_sel_time" class="form-control">
						  	<option value="1">รอบเช้า</option>
							 <option value="2">รอบบ่าย</option>
							 <option value="3">รอบพิเศษ</option>
						 </select>
						 <br>
						  <br>
					  </div>
					<div class="row-cols-12">
					  	<table class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>วันที่</th>
									<th>เวลา</th>
									<th>ชื่อตำแหน่ง</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody id="Mul2_table" >
								
							</tbody>
						</table>
					  </div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
				  </div>
				</div>
			  </div>
			</div>
			<!-- Modal updatelocationname 2 -->
			<div class="modal fade" id="modal_updatelocationname2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">แก้ไขชื่อจุดที่ 2</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
						<div class="row-cols-12">
					  		<label>ชื่อจุดที่ 2</label>
							<br>
							<input type="text" class="form-control" id="txt_namelocation2">
							<hr color="#000000">
					  	</div>
				  </div>
				  <div class="modal-footer">
					<input type="button" class="btn btn-secondary" value="ยกเลิก" data-role="cancleupdatelocationname2">
							&nbsp;&nbsp;&nbsp;
							<input type="button" class="btn btn-success" value="บันทึก" data-role="updatelocationname2">
					  		
				  </div>
				</div>
			  </div>
			</div>
			<!-- Modal updateLatLng -->
			<div class="modal fade" id="modal_updatelatlng" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">แก้ไขที่อยู่</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
						<div class="row-cols-12">
					  		<label>ชื่อที่ตั้ง</label>
							<br>
							<input type="text" id="Geo_name" class="form-control">
							<hr>
							<label>ละติจูด</label>
							<br>
							<input type="text" id="Geo_Lat" class="form-control">
							<hr>
							<label>ลองติจูด</label>
							<br>
							<input type="text" id="Geo_Lng" class="form-control">
							<br>
					  	</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
					<button type="button" class="btn btn-primary" data-role='updatelatlng2'>บันทึก</button>
				  </div>
				</div>
			  </div>
			</div>
			<!-- script updatenamelocation2 -->
			<script>
				$(document).on('click','.btn',function(){
					var data = $(this).data('role');
					if(data == 'locationname2'){
						var id = document.getElementById('Mul2_id').value;
						var type = 'updatelocationname3';
						$.ajax({
							url : 'ajax_registeruser.php',
							method : 'post',
							data : {type:type,
								   id,id,
								   },
							success:function(dataResult){
								var data = JSON.parse(dataResult);
								var nameloction = data.namelocation;

								$('#txt_namelocation2').val(nameloction);
								$('#modalupdatelocation2').modal('toggle');
								$('#modal_updatelocationname2').modal('toggle');
							}
						});
						
						
					}
					if(data == 'cancleupdatelocationname2'){
						$('#modal_updatelocationname2').modal('toggle');
					}
					if(data == 'updatelocationname2'){
						var namelocation = $('#txt_namelocation2').val();
						if(namelocation == ''){
							alert('ใส่ชื่อจุดที่ 2 !!!');
						}
						else{
							console.log(namelocation)
							var id = $('#Mul2_id').val();
							var type = 'updatelocationname4';
							$.ajax({
								url : 'ajax_registeruser.php',
								method : 'post',
								data : {type:type,
									   id:id,
									   namelocation:namelocation,
									   },
								success:function(dataResult){
									var data = JSON.parse(dataResult);
									if(data.result == '200'){
										alert('บันทึกข้อมูลสำเร็จ!!!');
										$('#modal_updatelocationname2').modal('toggle');
									}else{
										alert('Error:Check Ajax');
									}
										
								}
							});
						}
						
					}
					//updateLatlng
					if(data == 'updatelatlng'){
						var id = document.getElementById('Mul2_id').value ;
						var type = 'getnameandlatlng';
						console.log(id);
						$.ajax({
							url : 'ajax_registeruser.php',
							method : 'post',
							data : {id:id,
								   type:type,
								   },
							success:function(dataResult){
								var data = JSON.parse(dataResult);
								var name = data.name;
								var lat = data.lat;
								var lng = data.lng;
								$('#Geo_name').val(name);
								$('#Geo_Lat').val(lat);
								$('#Geo_Lng').val(lng);
								$('#modalupdatelocation2').modal('toggle');
								$('#modal_updatelatlng').modal('toggle');
							}
						});
					}
					if(data == 'updatelatlng2'){
						var name = $('#Geo_name').val();
						var Lat = $('#Geo_Lat').val();
						var Lng = $('#Geo_Lng').val();
						var id = $('#Mul2_id').val();
						if(name == ''){
							alert('ใส่ชื่อที่ตั้ง !!!');
						}
						if(Lat == ''){
							alert('ใส่ละติจูด');
						}
						if(Lng == ''){
							alert('ใส่ลองติจูด');
						}
						else{
							type = 'updategeo'
							$.ajax({
								url : 'ajax_registeruser.php',
								method : 'post',
								data : {type:type,
									   name:name,
									   Lat:Lat,
									   Lng:Lng,
									   id:id,
									   },
								success:function(dataResult){
									var data = JSON.parse(dataResult);
									if(data.result == '200'){
										alert('บันทึกสำเร็จ!!!');
										$('#modal_updatelatlng').modal('toggle');
									}
									else{
										alert('Error : Check Ajax');
									}
								}
								
							});
						}
					}
				})
			</script>
			<!-- script location2 -->
			<script>
				$(document).on('click','a[data-role=updatelocation2]',function(){
					//get data
					var id = $(this).data('id');
					var userid = $('#'+id).children('td[data-target=id]').text();
					var type = $('#'+id).children('td[data-target=type]').text();
					var name = $('#'+id).children('td[data-target=name]').text();
					var lname = $('#'+id).children('td[data-target=lname]').text();
					
					//put data
					$('#Mul2_id').val(id);
					$('#Mul2_name').val(type+name);
					$('#Mul2_lname').val(lname);
					document.getElementById('Mul2_sel_time').selectedIndex = "0";
					$('#modalupdatelocation2').modal("toggle");
					//get name gps
					$.ajax({
						url : 'getnamelocation2.php',
						type : "POST",
						cache : false,
						data : {id:id},
						success:function(dataResult){
							$('#Mul2_loca').val(dataResult);
						}
					});
					//get latlng
					$.ajax({
						url : 'getlatlnglocation2.php',
						type : 'post',
						cache : false,
						data : {id:id},
						success:function(dataResult){
							
							document.getElementById('Mul2_localink').href = dataResult;
						}
						
					});
					//get table
					$.ajax({
						url : 'tablelocation2.php',
						type : 'post',
						cache : false,
						data : {id:id},
						success:function(dataResult){
							$('#Mul2_table').html(dataResult);
						}
					});
					
				});
				//update location 2
					$(document).on('click','a[data-role=updateloc2]',function(){
						var dataid = $(this).data('id');
						$.ajax({
							url : 'updatelocation2.php',
							type : 'post',
							cache : false,
							data : {dataid:dataid},
							success:function(dataResult){
								if(dataResult = 'true'){
									alert('อัพเดทสำเร็จ')
									$('#modalupdatelocation2').modal("toggle");
								}else{
									alert('อัพเดทไม่สำเร็จ')
								}
							}
						});
					});
				$(document).on('click','a[data-role=updateloc2-2]',function(){
						var dataid = $(this).data('id');
						$.ajax({
							url : 'updatelocation2-2.php',
							type : 'post',
							cache : false,
							data : {dataid:dataid},
							success:function(dataResult){
								if(dataResult = 'true'){
									alert('อัพเดทสำเร็จ')
									$('#modalupdatelocation2').modal("toggle");
								}else{
									alert('อัพเดทไม่สำเร็จ')
								}
							}
						});
					});
				$(document).on('click','a[data-role=updateloc2-3]',function(){
						var dataid = $(this).data('id');
						$.ajax({
							url : 'updatelocation2-3.php',
							type : 'post',
							cache : false,
							data : {dataid:dataid},
							success:function(dataResult){
								if(dataResult = 'true'){
									alert('อัพเดทสำเร็จ')
									$('#modalupdatelocation2').modal("toggle");
								}else{
									alert('อัพเดทไม่สำเร็จ')
								}
							}
						});
					});
				
				//seltime table
				$('#Mul2_sel_time').on('change',function(){
					var no = $(this).val();
					var id = $('#Mul2_id').val();
					if(no == '1'){
						$.ajax({
						url : 'tablelocation2.php',
						type : 'post',
						cache : false,
						data : {id:id},
						success:function(dataResult){
							$('#Mul2_table').html(dataResult);
						}
					});
					}
					if(no == '2'){
						$.ajax({
						url : 'tablelocation2-2.php',
						type : 'post',
						cache : false,
						data : {id:id},
						success:function(dataResult){
							$('#Mul2_table').html(dataResult);
						}
					});
					}
					if(no == '3'){
						$.ajax({
						url : 'tablelocation2-3.php',
						type : 'post',
						cache : false,
						data : {id:id},
						success:function(dataResult){
							$('#Mul2_table').html(dataResult);
						}
					});
					}
				})
			</script>
			
			
			
			<!-- script mobile -->
			<script>
					$(document).on('click','a[data-role=updatemobile]',function(){
						var id = $(this).data('id');
						
						var userid = $('#'+id).children('td[data-target=id]').text();
						var type = $('#'+id).children('td[data-target=type]').text();
						var name = $('#'+id).children('td[data-target=name]').text();
						var lname = $('#'+id).children('td[data-target=lname]').text();
						
						$('#Mum_id').val(userid);
						$('#Mum_name').val(type+name);
						$('#Mum_lname').val(lname);
						$('#modalupdatemobile').modal("toggle");
						
						$.ajax({
							url : "tablemobile.php",
							type : "post",
							cache : false,
							data : {id:userid},
							success:function(dataResult){
								$('#Mum_mo').val(dataResult);
							}
						});
						$.ajax({
							url : "tablemobiledata.php",
							type : "post",
							cache : false,
							data : {id:userid},
							success:function(dataResult){
								$('#Mum_table').html(dataResult);
							}
						})
					});
				$(document).on('click','a[data-role=updatemobiledata]',function(){
					var id = $(this).data('id');
					$.ajax({
						url : "updatemobile.php",
						type : "post",
						cache : false,
						data : {dataid:id},
						success:function(dataResult){
							if(dataResult == 'Pass'){
								alert('อัพเดทข้อมูลมือถือสำเร็จ!!!');
								$('#modalupdatemobile').modal("toggle");
								
							}else{
								alert('อัพเดทข้อมูลไม่สำเร็จ!!!');
							}
						}
					});
				});
			</script>
			<!-- modal update mobile-->
			<div class="modal fade bd-example-modal-xl" id="modalupdatemobile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update Mobile</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
						<div class="col-4">
							<label>รหัสพนักงาน</label>
						</div> 
						<div class="col-4">
							<label>ชื่อ</label>
						</div> 
						<div class="col-4">
							<label>นามสกุล</label>
						</div> 
					</div>
					<div class="row">
						<div class="col-4">
							<input type="text" id="Mum_id" class="form-control" readonly>
						</div>
						<div class="col-4">
							<input type="text" id="Mum_name" class="form-control" readonly>
						</div> 
						<div class="col-4">
							<input type="text" id="Mum_lname" class="form-control" readonly>
						</div> 
					</div>
					 <br>
					  <div class="row">
					  	  <div class="col-6">
						  	<label>ข้อมูลมือถือปัจจุบัน</label>
						  </div>
						  <div class="col-6">
						  
						  </div>
					  </div>
					  <div class="row">
					  		<div class="col-6">
						  		<input type="text" id="Mum_mo" readonly class="form-control">
						  	</div>
						  	<div class="col-6">
						  
						  	</div>
					  </div>
					  <br>
					  <div class="row-cols-12">
						  <label>ประวัติข้อมูลมือถือ</label>
					  </div>
					  <div class="row-cols-3">
					  	<select id="Mum_sel_time" class="form-control">
							<option value="1">ช่วงเช้า</option>
						</select>
					  </div>
					 	<br>
					  <div class="row-cols-12">
					  		<table class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>วันที่</th>
										<th>เวลา</th>
										<th>ข้อมูลมือถือ</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="Mum_table" >

								</tbody>
							</table>
					  </div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>
		</div>
		<input type="hidden" id="showdata" value="<?php echo $id ?>">
		<script>
		$(document).ready(function(){
			var id = $('#showdata').val();
			if(id == ''){
				
			}else{
				console.log(id);
				$.ajax({
					url:"tableregister.php",
					type:"POST",
					cache:false,
					data:{txt:id},
					success:function(dataResult){
						$('#tablebody').html(dataResult);
					}
				});
			}
		})
			
		//update modal
		function updatemodal2(){
			var id 		= document.getElementById('M2id').value;
			var type 	= document.getElementById('M2type').value;
			var name	= document.getElementById('M2name').value;
			var lname	= document.getElementById('M2lname').value;
			var tel 	= document.getElementById('M2tel').value;
			var loc 	= document.getElementById('M2sel_loc').value;
			var com 	= document.getElementById('M2sel_com').value;
			var site	= document.getElementById('M2sel_site').value;
			var dept 	= document.getElementById('M2sel_dept').value;
			var grop 	= document.getElementById('M2sel_grop').value;
			var status_tel2 = $('#status_tel2').val();
			console.log(status_tel2);
			$.ajax({
				url		: "modal2update.php",
				type	: "POST",
				cache	: false,
				data	:{
						id:id,
						type:type,
				   		name:name,
				   		lname:lname,
				   		tel:tel,
				   		loc:loc,
				   		com:com,
				   		site:site,
				   		dept:dept,
				   		grop:grop,
						status_tel:status_tel2,
						 },
				success:function(dataResult){
				var dataResult = JSON.parse(dataResult)
				if(dataResult.statusCode==200){
					alert('บันทึกข้อมูลสำเร็จ');
					document.getElementById('M1id').value = '';
					document.getElementById('M1type').value = '';
					document.getElementById('M1name').value = '';
					document.getElementById('M1lname').value = '';
					document.getElementById('M1sel_loc').value = '';
					document.getElementById('M1sel_com').value = '';
					document.getElementById('M1sel_site').value = '';
					document.getElementById('M1sel_dept').value = '';
					document.getElementById('M1sel_grop').value = '';
					document.getElementById('M1tel').value = '';
					$('#modalupdate2').modal('toggle')
					$.ajax({
					url:"tableregister.php",
					type:"POST",
					cache:false,
					data:{txt:id},
					success:function(dataResult){
						$('#tablebody').html(dataResult);
					}
		});
				}else{
				   alert('บันทึกข้อมูลไม่สำเร็จ');
				   }
				}
			})
			
		}
		</script>
	</form>
</body>
</html>
