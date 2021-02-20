<!doctype html>
<?php 

include('Home.php');
?>
<html>

<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-10 col-xl-4">
			<h3 class="text-primary" align="center">รหัสผู้ดูแล</h3>
			<br>
			<label>Username</label>
			<input type="text" class="border-primary form-control" id="user">
			<hr>
			<br>
			<label>Password</label>
			<input type="password" class="border-primary form-control" id="pass">
			<hr>
			<br>
			<label>Level</label>
			<select id="level" class="border-primary form-control">
				<option value="0" >-----</option>
				<option value="1" >Level 1</option>
				<option value="2" >Level 2</option>
			</select>
			<hr>
			<br>
			<label>Grop Admin</label>
			<select id="grop" class="border-primary form-control">
				<option value="0">-----</option>
				<?php 
					$result = mysqli_query($conn,"select * from tb_grop");
					while($row = mysqli_fetch_assoc($result)){
					$id = $row['id'];
					$name = $row['name'];
				?>
				<option value="<?php echo $id ?>"><?php echo $name ?></option>
				<?php 
					}
				?>
			</select>
			<hr>
			<br>
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-5 col-xl-2"></div>
		<div class="col-5 col-xl-2">
		<input type="button" class="btn btn-outline-success form-control" value="บันทึก" onClick="save()">
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	<br><br>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-10 col-xl-4">
			<div id="save_success" class="alert-success form-control">
				<label id="label_save_success"></label>
			</div> 
			<div id="save_warning" class="alert-warning form-control">
				<label id="label_save_warning"></label>
			</div> 
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	<form id="frm" method="post" action="#"></form>
	<br><br>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-10 col-xl-4">
			<table id="table" class="table table-hover">
				<thead>
						<th>Username</th>
						<th>Password</th>
						<th>Level</th>
						<th>Group</th>
						<th>Delete</th>
				</thead>
				<tbody>
					<?php 
						$sql = "select * from tb_login";
						$result = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_assoc($result)){
							$user = $row['user'];
							$pass = $row['pass'];
							$level = $row['level'];
							$id = $row['id'];
							$grop_id = $row['grop_id'];
						$result_grop = mysqli_query($conn,"select * from tb_grop where id = '$grop_id'");
						$row_grop = mysqli_fetch_assoc($result_grop);
						$grop = $row_grop['name'];
					?>
					<tr>
						<td><?php echo $user ?></td>
						<td><?php echo $pass ?></td>
						<td><?php echo $level ?></td>
						<td><?php echo $grop ?></td>
						<td><input type="button" class="btn btn-outline-danger form-control" data-role='delete' data-id="<?php echo $id ?>" value="Delete"></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	
	<!-- Modal -->
	<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered " role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">แจ้งเตือน</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			  <input type="hidden" id="hd_id">
			<label>คุณต้องการลบข้อมูล??</label>
			  <br>
			  <div id="delete_alert_warning" class="alert alert-warning" role="alert">
				<label id="label_delete_alert"></label>
			</div>
			<div id="delete_alert_success" class="alert alert-success" role="alert">
				<label id="label_delete_success"></label>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
			<button type="button" class="btn btn-primary" data-role="con_delete">ยืนยัน</button>
		  </div>
		</div>
	  </div>
	</div>
</div>
<script>
	$(document).on('click','.btn',function(){
		var data = $(this).data('role');
		if(data == 'delete'){
			var id = $(this).data('id');
			$('#hd_id').val(id);
			$('#modal_delete').modal('toggle');
		}
		if(data == 'con_delete'){
			var id = $('#hd_id').val();
			var type = 'delete_login';
			$.ajax({
				url : 'ajax.php',
				method : 'post',
				data : {type:type,
					   id:id},
				success:function(result){
					var data = JSON.parse(result);
					var status = data.statusCode;
					if(status == 200){
						var text = 'ลบข้อมูลสำเร็จ';
						$('#label_delete_success').text(text);
						$('#delete_alert_success').show(500);
						setTimeout(function(){
							$('#frm').submit();
						},3000)
					}else{
						var text = 'ระบบผิดพลาดกรูณาแจ้งผู้ดูแลระบบ';
						$('#label_delete_alert').text(text);
						$('#delete_alert_warning').show(500);
						setTimeout(function(){
							$('delete_alert_warning').hide(500);
						},3000)
					}
				}
			})
		}
		
	})
	
	$(document).ready(function(){
		$('#table').DataTable();
		$('#delete_alert_warning').hide();
		$('#delete_alert_success').hide();
		$('#save_warning').hide();
		$('#save_success').hide();
	})
	
	function save(){
		var user = $('#user').val();
		var pass = $('#pass').val();
		var level = $('#level').val();
		var grop = $('#grop').val();
		if(user == ''){
			var text = 'ใส่ข้อมูล Username';
			$('#label_save_warning').text(text);
			$('#save_warning').show(500);
			setTimeout(function(){
				$('#save_warning').hide(500);
			},3000)
		}
		else if(pass == ''){
			var text = 'ใส่ข้อมูล Password';
			$('#label_save_warning').text(text);
			$('#save_warning').show(500);
			setTimeout(function(){
				$('#save_warning').hide(500);
			},3000)
		}
		else if(level == '0'){
			var text = 'เลือกระดับ Level';
			$('#label_save_warning').text(text);
			$('#save_warning').show(500);
			setTimeout(function(){
				$('#save_warning').hide(500);
			},3000)
		}
		else if(grop == '0'){
			var text = 'เลือกกลุ่มที่รับผิดชอบ';
			$('#label_save_warning').text(text);
			$('#save_warning').show(500);
			setTimeout(function(){
				$('#save_warning').hide(500);
			},3000)
		}
		else{
			var type = 'login_save';
			$.ajax({
				url : 'ajax.php',
				method : 'post',
				data : {type:type,
					   user:user,
					   pass:pass,
					   level:level,
					   grop:grop},
				success:function(result){
					var data = JSON.parse(result);
					var status = data.statusCode;
					if(status == 200){
						var text ='บักทึกข้อมูลสำเร็จ';
						$('#label_save_success').text(text);
						$('#save_success').show(500);
						setTimeout(function(){
							$('#frm').submit();
						},3000)
					}else if(status == 201){
						var text ='ระบบผิดพลาดกรุณาแจ้งผู้ดูแลระบบ';
						$('#label_save_warning').text(text);
						$('#save_warning').show(500);
						setTimeout(function(){
							$('#save_warning').hide(500);
						},3000)
					}
					else if(status == 202){
						var text ='Username ซ้ำ';
						$('#label_save_warning').text(text);
						$('#save_warning').show(500);
						setTimeout(function(){
							$('#save_warning').hide(500);
						},3000)
					}
				}
			})
		}
	}
	function logout(){
		window.location = "logout.php";
	}
</script>
</body>
</html>