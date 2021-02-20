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
			<h3 class="text-primary" align="center">กลุ่ม</h3>
			<br>
			<label>รหัสกลุ่ม</label>
			<input type="text" class="form-control border-primary" id="grop_id">
			<hr>
			<br>
			<label>ชื่อกลุ่ม</label>
			<input type="text" class="form-control border-primary" id="grop_name">
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-5 col-xl-2"></div>
		<div class="col-5 col-xl-2">
			<input type="button" class="btn form-control btn-outline-success" value="บันทึก" data-role="save">
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-10 col-xl-4">
			<div id="save_success" class="form-control alert-success">
				<label id="label_save_success"></label>
			</div>
			<div id="save_warning" class="form-control alert-warning">
				<label id="label_save_warning"></label>
			</div>
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	<form id="frm" action="#" method="post"></form>
	<br>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-10 col-xl-4">
			<table id="table" class="table table-hover">
				<thead>
					<th>รหัสกลุ่ม</th>
					<th>ชื่อกลุ่ม</th>
					<th>ลบ</th>
				</thead>
				<tbody>
					<?php 
					$sql = "select * from tb_grop";
					$result = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_assoc($result)){
						$id = $row['id'];
						$name = $row['name'];
					?>
					<tr>
						<td><?php echo $id ?></td>
						<td><?php echo $name ?></td>
						<td><input type="button" class="btn btn-outline-danger form-control" data-role="delete" data-id="<?php echo $id ?>" value="ลบ"> </td>
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
	  <div class="modal-dialog modal-dialog-centered" role="document">
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
			  <br>
			  <div id="delete_warning" class="alert alert-warning form-control" role="alert">
				<label id="label_delete_warning"></label>
			</div>
			<div id="delete_success" class="alert alert-success form-control" role="alert">
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
	$(document).ready(function(){
		$('#save_success').hide();
		$('#save_warning').hide();
		$('#delete_success').hide();
		$('#delete_warning').hide();
		$('#table').DataTable();
	});
	
	$(document).on('click','.btn',function(){
		var data = $(this).data('role');
		if(data == 'save'){
			var id = $('#grop_id').val();
			var name = $('#grop_name').val();
			if(id == ''){
				var txt = 'กรุณาใส่ข้อมูลรหัสกลุ่ม';
				$('#label_save_warning').text(txt);
				$('#save_warning').show(500);
				setTimeout(function(){
					$('#save_warning').hide(500);
				},3000)
			}
			else if(name == ''){
				var txt = 'กรุณาใส่ข้อมูลชื่อลุ่ม';
				$('#label_save_warning').text(txt);
				$('#save_warning').show(500);
				setTimeout(function(){
					$('#save_warning').hide(500);
				},3000)
			}else{
				var type = 'insert_grop';
				$.ajax({
					url : 'ajax.php',
					method : 'post',
					data : {type:type,
						   id:id,
						   name:name,
						   },
					success:function(result){
						var data = JSON.parse(result);
						var statusCode = data.statusCode;
						if(statusCode == 200){
							var txt = 'บันทึกสำเร็จ';
							$('#label_save_success').text(txt);
							$('#save_success').show(500);
							setTimeout(function(){
								$('#frm').submit();
							},3000)
						}
						else if(statusCode == 201){
							var txt = 'บันทึกข้อมูลไม่สำเร็จ รหัสกลุ่มซ้ำ';
							$('#label_save_warning').text(txt);
							$('#save_warning').show(500);
							setTimeout(function(){
								$('#save_warning').hide(500)
							},3000)
						}
						else if(statusCode == 202){
							var txt = 'ระบบผิดพลาดกรุณาแจ้งผู้ดูแลระบบ';
							$('#label_save_warning');
							$('#save_warning').show(500);
							setTimeout(function(){
								$('#save_warning').hide(500);
							},3000)
							
						}
					}
				})
			}
		}
		
		else if(data == 'delete'){
			var id = $(this).data('id');
			$('#hd_id').val(id);
			$('#modal_delete').modal('toggle');
		}
		
		else if(data == 'con_delete'){
			var id = $('#hd_id').val()
			var type = "delete_grop";
			$.ajax({
				url : 'ajax.php',
				method : 'post',
				data : {type:type,
					   id:id},
				success:function(result){
					var data = JSON.parse(result);
					var statusCode = data.statusCode;
					if(statusCode == 200){
						var txt = 'ลบข้อมูลสำเร็จ';
						$('#label_delete_success').text(txt);
						$('#delete_success').show(500);
						setTimeout(function(){
							$('#frm').submit();
						},3000)
					}
					else if(statusCode == 201){
						var txt = 'ระบบผิดพลาดกรุณาแจ้งผู้ดูแลระบบ';
						$('#label_delete_warning').text(txt);
						$('#delete_warning').show(500);
						setTimeout(function(){
							$('#delete_warning').hide(500)
						},3000)
					}
				}
				
			})
		}
	});
	function logout(){
		window.location = "logout.php";
	}
</script>
</body>
</html>