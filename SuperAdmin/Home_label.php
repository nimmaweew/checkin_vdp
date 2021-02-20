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
			<h3 class="text-primary" align="center">เปลี่ยนข้อความ</h3>
			<br>
			<table id="table" class="table table-hover">
				<thead>
					<th>Location</th>
					<th>Edit</th>
				</thead>
				<tbody>
					<?php 
						$sql = "select * from tb_label order by id asc";
						$result = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_assoc($result)){
							$name = $row['name'];
							$id = $row['id'];
					?>
					<tr>
						<td><?php echo $name ?></td>
						<td>
							<input type="button" class="btn btn-outline-warning form-control" data-role="edit" data-id="<?php echo $id ?>" value="Edit">
						</td>
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
			<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					  <input type="hidden" id="hd_id">
					<label id="label_name"></label>
					  <br>
					 <textarea id="text" class="form-control" rows="10"></textarea>
					  <br>
					  <div class="alert-danger form-control" id="save_warning">
					  	<label id="label_warning"></label>
					  </div>
					  <div class="alert-success form-control" id="save_success">
					  	<label id="label_success"></label>
					  </div>
					  <br>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onClick="save()">Save changes</button>
				  </div>
				</div>
			  </div>
			</div>
</div>
	<script>
		function save(){
			var id = $('#hd_id').val();
			var type = 'label_save';
			var text = $('#text').val();
			$.ajax({
				url : 'ajax.php',
				method : 'post',
				data : {type:type,
					   id:id,
					   text:text},
				success:function(result){
					var data = JSON.parse(result);
					var status = data.statusCode;
					if(status == 200){
						var text = 'บันทึกสำเร็จ';
						$('#label_success').text(text);
						$('#save_success').show(500);
						setTimeout(function(){
							$('#save_success').hide();
							$('#modal_edit').modal('toggle');
						},3000)
					}
					else if(status == 201){
						var text = 'ระบบผิดพลาดกรุณาแจ้งผู้ดูแลลระบบ';
						$('#label_warning').text(text);
						$('#save_warning').show(500);
						setTimeout(function(){
							$('#save_warning').hide(500);
						},3000)
					}
				}
			})
		}
		$(document).ready(function(){
			$('#save_warning').hide();
			$('#save_success').hide();
		})
		
		$(document).on('click','.btn',function(){
			var data = $(this).data('role');
			if(data == 'edit'){
				var id = $(this).data('id');
				var type = 'get_label';
				$.ajax({
					url : 'ajax.php',
					method : 'post',
					data : {type:type,
						   id:id},
					success:function(result){
						var data = JSON.parse(result);
						var status = data.statusCode;
						if(status == 200){
							var text = data.text;
							var name = data.name;
							$('#hd_id').val(id);
							$('#label_name').text(name);
							$('#text').val(text);
							$('#modal_edit').modal('toggle');
						}else if(status == 201){
							var text = 'ระบบผิดพลาดกรุณาแจ้งผู้ดูแลระบบ';
						}
					}
				})
			}
		})
	</script>
</body>
</html>