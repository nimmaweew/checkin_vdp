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
			<h3 class="text-primary" align="center">บริษัท</h3>
			<br>
			<label>รหัสบริษัท</label>
			<input type="text" class="form-control border-primary" id="com_id">
			<hr>
			<br>
			<label>ชื่อบริษัท</label>
			<input type="text" class="form-control border-primary" id="com_name">
			<hr>
			<br>
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-5 col-xl-2"></div>
		<div class="col-5 col-xl-2">
			<input type="button" class="btn form-control btn-outline-success" value="บันทึก" data-role="save">
		</div>
		<div class="col-1 col-xl-4">
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-10 col-xl-4">
			<div id="save_alert_warning" class="alert alert-warning" role="alert">
				<label id="label_save_warning"></label>
			</div>
			<div id="save_alert_success" class="alert alert-success" role="alert">
				<label id="label_save_success"></label>
			</div>
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	<br><br>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-10 col-xl-4">
			<table id="table" class="table table-hover">
				<thead>
					<th>รหัสบริษัท</th>
					<th>ชื่อบริษัท</th>
					<th>ลบ</th>
				</thead>
				<tbody>
					<?php 
						$sql = "select * from tb_com";
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
			  <div id="delete_alert_warning" class="alert alert-warning" role="alert">
				<label id="label_delete_warning"></label>
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
	<form id="frm" action="#" method="post"></form>
	</div>
<script>
	function logout(){
		window.location = "logout.php";
	}
	$(document).ready(function(){
		$('#save_alert_warning').hide();
		$('#save_alert_success').hide();
		$('#delete_alert_success').hide();
		$('#delete_alert_warning').hide();
		$('#table').DataTable();
	})
	
	$(document).on('click','.btn',function(){
		var data = $(this).data('role');
		if(data == 'save'){
			var com_id = $('#com_id').val();
			var com_name = $('#com_name').val();
			if(com_id == ''){
				var text = 'กรุณาใส่รหัสบริษัท';
				$('#label_save_warning').text(text);
				$('#save_alert_warning').show(500);
				setTimeout(function(){
					$('#save_alert_warning').hide(500);
				},3000)
			}
			else if(com_name == ''){
				var text = 'กรุณาใส่ชื่อบริษัท';
				$('#label_save_warning').text(text);
				$('#save_alert_warning').show(500);
				setTimeout(function(){
					$('#save_alert_warning').hide(500);
				},3000)
			}
			else{
				var type = 'save_company';
				$.ajax({
					url : 'ajax.php',
					method : 'post',
					data : {type:type,
						   com_id:com_id,
						   com_name:com_name,
						   },
					success:function(result){
						var data = JSON.parse(result)
						if(data.statusCode == 200){
							var text = 'บันทึกข้อมูลสำเร็จ'
							$('#label_save_success').text(text);
							$('#save_alert_success').show(500);
							setTimeout(function(){
								$('#frm').submit();
							},3000)
						}else{
							var text = 'บันทึกข้อมูลไม่สำเร็จกรุณาตรวจสอบรหัสบริษัทหรือแจ้งผู้ดูแลระบบ';
							$('#label_save_warning0').text(text);
							$('#save_alert_warning').show(500);
							setTimeout(function(){
								$('#save_alert_warning').hide(500);
							},3000)
						}
					}
				})
			}
		}
		
		if(data == 'delete'){
			var id = $(this).data('id');
			$('#hd_id').val(id);
			$('#modal_delete').modal('toggle');
		}
		
		if(data == 'con_delete'){
			var type = 'delete_compamy';
			var id = $('#hd_id').val();
			$.ajax({
				url : 'ajax.php',
				method : 'post',
				data : {type:type,
					   id:id,
					   },
				success:function(result){
					var data = JSON.parse(result)
					if(data.statusCode == 200){
						var text = 'ลบข้อมูลสำเร็จ';
						$('#label_delete_success').text(text);
						$('#delete_alert_success').show(500);
						setTimeout(function(){
							$('#frm').submit();
						},3000)
					}else{
						var text = 'ลบข้อมูลไม่สำเร็จกรุณาแจ้งผู้ดูแลระบบ';
						$('#label_delete_warning').text(text);
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