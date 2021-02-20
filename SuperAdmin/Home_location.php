<!doctype html>
<?php 

include('Home.php');
?>
<html>

<body>
	<div class="container-fluid">
	<br><br>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-10 col-xl-4">
			<h3 class="text-primary" align="center">สถานที่</h3>
			<br>
			<label>รหัสสถานที่</label>
			<input type="text" id="id_loc" class="form-control border-primary">
			<hr>
			<br>
			<label>ชื่อสถานที่</label>
			<input type="text" id="name_loc" class="form-control border-primary">
			<hr>
			<br>
		</div>
		<div class="col-1 col-xl-4">
			
		</div>
	</div>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-5 col-xl-2"></div>
		<div class="col-5 col-xl-2" align="right">
			<input type="button" class="btn form-control btn-outline-success" data-role="save" value="บันทึก">
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-10 col-xl-4">
			<div id="login_alert_warning" class="alert alert-warning" role="alert">
				<label id="label_login_alert"></label>
			</div>
			<div id="login_alert_success" class="alert alert-success" role="alert">
				<label id="label_login_alert2"></label>
			</div>
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	<br><br>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-10 col-xl-4">
			<table id="table" class="table table-hover" style="overflow-x: auto;">
				<thead>
					<th>รหัสสถานที่</th>
					<th>ชื่อสถานที่</th>
					<th>ลบ</th>
				</thead>
				<tbody>
					<?php 
						$sql = "select * from tb_location";
						$result = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_assoc($result)){
						$id = $row['id'];
						$name = $row['name'];
						
					?>
					<tr>
						<td><?php echo $id ?></td>
						<td><?php echo $name ?></td>
						<td><input type="button" class="btn btn-outline-danger form-control" data-role="delete" data-id="<?php echo $id ?>" value="ลบ"</td>
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
	function logout(){
		window.location = "logout.php";
	}
	
	$(document).ready(function(){
		$('#login_alert_warning').hide();
		$('#login_alert_success').hide();
		$('#delete_alert_success').hide();
		$('#delete_alert_warning').hide();
		$('#table').DataTable();
		
	
	});
	
	$(document).on('click','.btn',function(){
		var data = $(this).data('role');
		console.log(data);
		if(data == 'save'){
			var name_loc = $('#name_loc').val();
			var id_loc = $('#id_loc').val();
			if(id_loc == ''){
				var text = 'กรุณาใส่รหัสสถานที่';
				$('#label_login_alert').text(text);
				$('#login_alert_warning').show(500);
				setTimeout(function(){
					$('#login_alert_warning').hide(500);
				},3000)
			}
			else if(name_loc == ''){
				var text = 'กรุณาใส่ชื่อสถานที่';
				$('#label_login_alert').text(text);
				$('#login_alert_warning').show(500);
				setTimeout(function(){
					$('#login_alert_warning').hide(500);
				},3000)
			}else{
				var type = 'insert_location';
				$.ajax({
					url : 'ajax.php',
					method : 'post',
					data : {type:type,
						   id:id_loc,
						   name:name_loc,
						   },
					success:function(result){
						var data = JSON.parse(result);
						if(data.statusCode == 200){
							var text = 'บันทึกข้อมูลสำเร็จ'
							$('#label_login_alert2').text(text);
							$('#login_alert_success').show(500);
							$('#id_loc').val('');
							$('#name_loc').val('');
							setTimeout(function(){
								window.location = "Home_location.php";
							},3000)
						}else{
							var text = 'บันทึกข้อมูลไม่สำเร็จกรุณาตรวจสอบรหัสสถานที่หรือแจ้งผู้ดูแลระบบ';
							$('#label_login_alert').text(text);
							$('#login_alert_warning').show(500);
							setTimeout(function(){
								$('#login_alert_warning').hide(500);
							},3000)
						}
					}
				})
			}
		}
		
		if(data == 'delete'){
			var data_id = $(this).data('id');
			$('#hd_id').val(data_id);
			$('#modal_delete').modal('toggle');
		}
		
		if(data == 'con_delete'){
			var id = $('#hd_id').val();
			var type = 'delete_location';
			$.ajax({
				url : 'ajax.php',
				method : 'post',
				data : {type:type,
					   id:id,
					   },
				success:function(result){
					var data = JSON.parse(result);
						if(data.statusCode == 200){
							var text = 'ลบข้อมูลสำเร็จ';
							$('#label_delete_success').text(text);
							$('#delete_alert_success').show(500);
							$('#id_loc').val('');
							$('#name_loc').val('');
							setTimeout(function(){
								window.location = "Home_location.php";
							},3000)
						}else{
							var text = 'ระบบผิดพลาดกรูณาแจ้งผู้ดูแลระบบ';
							$('#label_delete_alert').text(text);
							$('#delete_alert_warning').show(500);
							setTimeout(function(){
								$('#delete_alert_warning').hide(500);
							},3000)
						}
					}
				
			})
		}
	})
</script>
</body>
</html>