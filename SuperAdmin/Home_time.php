<!doctype html>
<?php 
include ('Home.php');

?>
<html>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-1 col-xl-4"></div>
			<div class="col-10 col-xl-4">
				<h3 class="text-primary" align="center">เปลี่ยนเวลาเช็คชื่อ</h3>
				<br><br>
				<table id="table" class="table table-hover">
					<thead>
						<th>ช่วงเวลา</th>
						<th>เวลาเริ่ม</th>
						<th>เวลาสิ้นสุด</th>
						<th>แก้ไข</th>
					</thead>
					<tbody>
						<?php 
							$result = mysqli_query($conn,"select * from tb_time order by id asc");
							while($row = mysqli_fetch_assoc($result)){
								$name = $row['id'];
								$st_time = $row['st_time'];
								$en_time = $row['en_time'];
								if($name == '1'){
									$name_time = 'รอบเช้า';
								}else if($name == '2'){
									$name_time = 'รอบบ่าย';
								}else if($name == '3'){
									$name_time = 'รอบเย็น';
								}
								
						?>
						<tr>
							<td id="name<?php echo $name ?>"><?php echo $name_time ?></td>
							<td id="st_time<?php echo $name ?>"><?php echo $st_time ?></td>
							<td id="en_time<?php echo $name ?>"><?php echo $en_time ?></td>
							<td><input type="button" class="btn btn-outline-warning form-control" value="แก้ไข" data-role='edit' data-id="<?php echo $name ?>"></td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="col-1 col-xl-4"></div>
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
			  		<div class="col-12" align="center">
					 	<label>เวลาเริ่ม</label>
						<input type="hidden" id="hd_id">
				  	</div>
			  </div>
			  <br>
			  <div class="row">
			  	<div class="col-5">
					<input type="text" class="form-control border-primary" id="st_time" maxlength="5" style="text-align-last: center">  
				</div>
				<div class="col-2">
					<label>ถึง</label>  
				</div>
				<div class="col-5">
					<input type="text" class="form-control border-primary" id="en_time" maxlength="5" style="text-align-last: center">   
				</div>
			  </div>
			  <br> 
			  <hr>
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
	<form action="#" method="post" id="frm"></form>
<script>
	$(document).ready(function(){
		$('#save_warning').hide();
		$('#save_success').hide();
	})
	$(document).on('click','.btn',function(){
		var data = $(this).data('role');
		if(data == 'edit'){
			var id = $(this).data('id');
			var name = $('#name'+id).text();
			var st_time = $('#st_time'+id).text();
			var en_time = $('#en_time'+id).text();
			$('#st_time').val(st_time);
			$('#en_time').val(en_time);
			$('#name_time').text(name);
			$('#hd_id').val(id);
			$('#modal_edit').modal('toggle');
		}
	})
	function save(){
		var type = 'update_tb_time';
		var id = $('#hd_id').val();
		var st_time = $('#st_time').val();
		var en_time = $('#en_time').val();
		var n_st_time = st_time.length;
		var n_en_time = en_time.length;
		if(st_time == ''){
			var text = 'กรุณาใส่เวลาเริ่ม';
			$('#label_warning').text(text);
			$('#save_warning').show(500);
			setTimeout(function(){
				$('#save_warning').hide(500);
			},3000)
		}
		else if(en_time == ''){
			var text = 'กรุณาใส่เวลาสิ้นสุด';
			$('#label_warning').text(text);
			$('#save_warning').show(500);
			setTimeout(function(){
				$('#save_warning').hide(500);
			},3000)
		}else if(n_st_time < 3){
			var text = 'รูปแบบเวลาเริ่มไม่ถูกต้อง';
			$('#label_warning').text(text);
			$('#save_warning').show(500);
			setTimeout(function(){
				$('#save_warning').hide(500);
			},3000)
		}else if(n_en_time < 3){
			var text = 'รูปแบบเวลาสิ้นสุดไม่ถูกต้อง';
			$('#label_warning').text(text);
			$('#save_warning').show(500);
			setTimeout(function(){
				$('#save_warning').hide(500);
			},3000)
		}else{
			$.ajax({
				url : 'ajax.php',
				method : 'post',
				data : {type:type,
					   id:id,
					   st_time:st_time,
					   en_time:en_time},
				success:function(result){
					var data = JSON.parse(result);
					var status = data.statusCode;
					if(status == 200){
						var text = 'บันทึกสำเร็จ';
						$('#label_success').text(text);
						$('#save_success').show(500);
						setTimeout(function(){
							$('#frm').submit();
						},3000)
					}else if(status == 201){
						var text = 'ระบบผิดพลาดกรุณาแจ้งผู้ดูแลระบบ';
						$('#label_warning').text(text);
						$('#save_warning').show(500);
						setTimeout(function(){
							$('#save_warning').hide(500);
						},3000)
					}
				}
			})	
		}
	}
</script>
</body>
</html>