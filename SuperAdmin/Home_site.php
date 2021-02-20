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
			<h3 class="text-primary" align="center">หน่วยงาน</h3>
			<br>
			<label>ชื่อบริษัท</label>
			<select id="com" class="form-control border-primary">
				<option value="0">-----</option>
				<?php 
				$sql = "select * from tb_com";
				$res = mysqli_query($conn,$sql);
				while($rs = mysqli_fetch_assoc($res)){
					$id = $rs['id'];
					$name = $rs['name'];
				
				?>
				<option value="<?php echo $id ?>"><?php echo $name ?></option>
				<?php 
				}
				?>
			</select>
			<hr>
			<br>
			<label>รหัสหน่วยงาน</label>
			<input type="text" class="form-control border-primary" id="site_id">
			<hr>
			<br>
			<label>ชื่อหน่วยงาน</label>
			<input type="text" class="form-control border-primary" id="site_name">
			<hr>
			<br>
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-5 col-xl-2"></div>
		<div class="col-5 col-xl-2">
			<input type="button" class="btn btn-outline-success form-control" data-role="save" value="บันทึก">
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-10 col-xl-4">
			<div id="save_warning" class="form-control alert-warning">
				<label id="label_save_warning"></label>
			</div>
			<div id="save_success" class="form-control alert-success">
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
					<th>ชื่อบริษัท</th>
					<th>รหัสหน่วยงาน</th>
					<th>ชื่อหน่วยงาน</th>
					<th>ลบ</th>
				</thead>
				<tbody>
					<?php  
						$sql = "select * from tb_site";
						$rs = mysqli_query($conn,$sql);
						while($rw = mysqli_fetch_assoc($rs)){
							$id = $rw['id'];
							$name = $rw['name'];
							$com = $rw['com_id'];
							$sqlcom = "select * from tb_com where id = '$com'";
							$rscom = mysqli_query($conn,$sqlcom);
							$rwcom = mysqli_fetch_assoc($rscom);
							$comname = $rwcom['name'];
						
					?>
					<tr>
						<td><?php echo $comname ?></td>
						<td><?php echo $id ?></td>
						<td><?php echo $name ?></td>
						<td><input type="button" class="btn btn-outline-danger form-control" data-role="delete" data-site_id="<?php echo $id ?>" data-com_id="<?php echo $com ?>" value="ลบ"></td>
					</tr>
					<?php 
					}
					?>
				</tbody>
			</table> 
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	<form id="frm" method="post" action="#"></form>
	
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
			  <input type="hidden" id="hd_com_id">
			  <input type="hidden" id="hd_site_id">
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
	$(document).on('click','.btn',function(){
		var data = $(this).data('role');
		if(data == 'save'){
			var com_id = $('#com').val();
			var site_id = $('#site_id').val();
			var site_name = $('#site_name').val();
			if(com_id == '0'){
				var text = 'กรุณาเลือกบริษัท';
				$('#label_save_warning').text(text);
				$('#save_warning').show(500);
				setTimeout(function(){
					$('#save_warning').hide(500);
				},3000)
			}
			else if(site_id == ''){
				var text = 'กรุณาใส่ข้อมูลรหัสหน่วยงาน';
				$('#label_save_warning').text(text);
				$('#save_warning').show(500);
				setTimeout(function(){
					$('#save_warning').hide();
				},3000)
			}
			else if(site_name == ''){
				var text = 'กรุณาใส่ข้อมูลชื่อหน่วยงาน';
				$('#label_save_warning').text(text);
				$('#save_warning').show(500);
				setTimeout(function(){
					$('#save_warning').hide(500);
				},3000)
			}
			else{
				var type = "insert_site";
				$.ajax({
					url : 'ajax.php',
					method : 'post',
					data : {type:type,
						   comid:com_id,
						   siteid:site_id,
						   sitename:site_name,
						   },
					success:function(result){
						var data = JSON.parse(result);
						if(data.statusCode == 200){
							var text = 'บันทึกสำเร็จ';
							$('#label_save_success').text(text);
							$('#save_success').show(500);
							setTimeout(function(){
								$('#frm').submit();
							},3000)
						}
						else if(data.statusCode == 201){
							var text = 'บันทึกไม่สำเร็จ รหัสหน่วยงานซ้ำ';
							$('#label_save_warning').text(text);
							$('#save_warning').show(500);
							setTimeout(function(){
								$('#save_warning').hide(500);
							},3000)
						}
						else if(data.statusCode == 202){
							var text = 'ระบบผิดพลาดกรุณาแจ้งผู้ดูแลระบบ';
							$('#label_save_warning').text(text);
							$('#save_warning').show(500);
							setTimeout(function(){
								$('#save_warning').hide();
							},3000)
						}
					}
				})
			}
		}
		
		if(data == 'delete'){
			var site_id = $(this).data('site_id');
			var com_id = $(this).data('com_id');
			$('#hd_site_id').val(site_id);
			$('#hd_com_id').val(com_id);
			$('#modal_delete').modal('toggle');
		}
		
		if(data == 'con_delete'){
			var com_id = $('#hd_com_id').val();
			var site_id = $('#hd_site_id').val();
			var type = 'site_delete';
			$.ajax({
				url : 'ajax.php',
				method : 'post',
				data : {type:type,
					   com_id:com_id,
					   site_id:site_id,
					   },
				success:function(result){
					var data = JSON.parse(result);
					if(data.statusCode == 200){
						var text = 'ลบข้อมูลสำเร็จ';
						$('#label_delete_success').text(text);
						$('#delete_success').show(500);
						setTimeout(function(){
							$('#frm').submit();
						},3000)
					}
					if(data.statusCode == 201){
						var text = 'ระบบผิดพลาดกรุณาแจ้งผู้ดูแล';
						$('#label_delete_warning').text(text);
						$('#delete_warning').show(500);
						setTimeout(function(){
							$('#delete_warning').hide(500);
							
						},3000)
					}
				}
			})
		}
		
	})
	$(document).ready(function(){
		$('#save_warning').hide();
		$('#save_success').hide();
		$('#delete_warning').hide();
		$('#delete_success').hide();
		$('#table').DataTable({
			scrollX: true
		});
	})
	function logout(){
		window.location = "logout.php";
	}
</script>
</body>
</html>