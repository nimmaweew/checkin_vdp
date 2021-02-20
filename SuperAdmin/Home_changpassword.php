<!doctype html>
<?php 

include('Home.php');
?>
<html>

<body>
	<br><br>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-10 col-xl-4">
			<h3 class="text-primary" align="center">เปลี่ยนรหัสแอดมิน</h3>
			<br>
			
			<label for="pass1" >รหัสผ่านใหม่</label>
			<input type="password" class="form-control border-primary" id="pass1" name="pass1">
			<hr>
			<br>
			<label for="pass2" >ยืนยันรหัสผ่านใหม่</label>
			<input type="password" class="form-control border-primary" id="pass2" name="pass2">
			<hr>
			<br>
		</div>
		<div class="col-1 col-xl-4"></div>
	</div>
	<div class="row">
		<div class="col-1 col-xl-4"></div>
		<div class="col-5 col-xl-2"></div>
		<div class="col-5 col-xl-2" align="right">
			<input type="button" class="btn btn-outline-success form-control" value="บันทึก" data-role='save'> 
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
	
<script>
	function logout(){
		window.location = "logout.php";
	}
	$(document).ready(function(){
		$('#login_alert_warning').hide();
		$('#login_alert_success').hide();
		
	})
	
	$(document).on('click','.btn',function(){
		var data = $(this).data('role');
		if(data == 'save'){
			var pass1 = $('#pass1').val();
			var pass2 = $('#pass2').val();
			if(pass1 == ''){
				var text = 'กรุณาใส่ข้อมูลรหัสผ่านใหม่';
				$('#label_login_alert').text(text);
				$('#login_alert_warning').show(500);
				setTimeout(function(){
					$('#login_alert_warning').hide(500);
				},3000)
			}
			else if(pass2 == ''){
				var text = 'กรุณาใส่ข้อมูลยืนยันรหัสผ่านใหม่';
				$('#label_login_alert').text(text);
				$('#login_alert_warning').show(500);
				setTimeout(function(){
					$('#login_alert_warning').hide(500);
				},3000)
			}
			else if(pass1 != pass2){
				var text = 'รหัสผ่านไม่ตรงกันลองใหม่อีกครั้ง';
				$('#label_login_alert').text(text);
				$('#login_alert_warning').show(500);
				setTimeout(function(){
					$('#login_alert_warning').hide(500);
				},3000)
			}else{
				var type = 'changpass';
				$.ajax({
					url : 'ajax.php',
					method : 'post',
					data : {type:type,
						   pass:pass1,
						   },
					success:function(result){
						var data = JSON.parse(result);
						if(data.statusCode == 200){
							var text = 'เปลี่ยนรหัสผ่านสำเร็จ';
							$('#label_login_alert2').text(text);
							$('#login_alert_success').show(500);
							$('#pass1').val('');
							$('#pass2').val('');
							setTimeout(function(){
								$('#login_alert_success').hide(500);
							},3000)
						}else{
							var text = 'ระบบผิดพลาดกรูณาแจ้งผู้ดูแลระบบ';
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
	})
</script>
</body>
</html>