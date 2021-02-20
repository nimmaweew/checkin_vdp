<!doctype html>
<?php 
include('Home.php');

?>
<html>


<body>
	<br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-1 col-md-4 col-xl-4"></div>
			<div class="col-10 col-md-4 col-xl-4" align="center">
				<h3 class="text-primary">API KEY</h3>
				<br>
				<br>
				
			</div>
			<div class="col-1 col-md-4 col-xl-4"></div>
		</div>
		<div class="row">
			<div class="col-1 col-md-2 col-xl-2"></div>
			<div class="col-10 col-md-8 col-xl-8">
				<table id="table" class="table table-hover">
					<thead>

						<th>ชื่อ</th>
						<th>Key</th>
						<th>แก้ไข</th>
					</thead>
					<tbody>
						<?php 
							$result = mysqli_query($conn,"select * from tb_api where id = '1'");
							while($row = mysqli_fetch_assoc($result)){
							$id = $row['id'];
							$name = $row['name'];
							$key = $row['key'];
						?>
						<tr>
							<td><?php echo $name ?></td>
							<td><?php echo $key ?></td>
							<td>
								<input type="button" class="btn btn-outline-warning form-control" value="แก้ไข" data-id="<?php echo $id ?>" data-key="<?php echo $key ?>" onClick="edit()">
							</td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="col-1 col-md-2 col-xl-2"></div>
		</div>
	</div>
	<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered " role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="name_time"></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body" align="center">
			  <div class="row">
			  	<div class="col-12">
				  	<br>
					<label>Key</label>
					<input type="text" class="form-control" id="key">
					<input type="hidden" id="id">
					<br>
					<hr>
				  </div>
			  </div>
			  
			  
			  <div id="save_warning" class="alert alert-warning" role="alert">
				<label id="label_warning"></label>
			</div>
			<div id="save_success" class="alert alert-success" role="alert">
				<label id="label_success"></label>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
			<button type="button" class="btn btn-primary" onClick="save()">ยืนยัน</button>
		  </div>
		</div>
	  </div>
	</div>
	<form id="frm" action="#" method="post"></form>
	<script>
		function edit(){
			var id = $(this).data('id');
			var key = $(this).data('key');
			$('#id').val(id);
			$('#key').val(key);
			$('#modal_edit').modal('toggle');
		}
		function save(){
			var id = $('#id').val();
			var key = $('#key').val();
			var type = 'save_key';
			if(key != ''){
				$.ajax({
					url : 'ajax.php',
					method : 'post',
					data : {type:type,
						   id:id,
						   key:key},
					success:function(result){
						var data = JSON.parse(result);
						var status = data.statusCode;
						if(status == 200){
							$('#label_success').text('บันทึกสำเร็จ');
							$('#save_success').show(500);
							setTimeout(function(){
								$('#frm').submit();
							},3000)
						}else{
							$('#label_warning').text('ระบบผิดพลาดแจ้งผู้ดูแลระบบ');
							$('#save_warning').show(500);
							setTimeout(function(){
								$('#save_warning').hide(500);
							},3000)
						}
					}
				})
			}else{
				$('#label_warning').text('กรุณากรอก Key');
				$('#save_warning').show(500);
				setTimeout(function(){
					$('#save_warning').hide(500);
				},3000)
			}
		}
	</script>
</body>
</html>