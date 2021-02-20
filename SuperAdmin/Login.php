<!doctype html>
<?php 
session_start();  
include('connect.php');
if(isset($_POST['per'])){
	$_SESSION['status'] = '3';
	header('Location:Home.php');
}
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<title>Super Admin</title>
</head>

<body>
	
				<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
					<div class="container-fluid">
				  <a class="navbar-brand" href="#">Home</a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
					</ul>
					<form class="form-inline my-2 my-lg-0">
					  <button class="btn btn-outline-success my-2 my-sm-0" type="button" data-role='login'>Login</button>
					</form>
				  </div>
						</div>
				</nav>
	<br><br>		
	<!-- Modal Login -->
	<div class="row">
		<div class="col-1"></div>
		<div class="col-10">
			<div class="modal fade" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
			  <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Login</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
						<label class="text-black-50">Username</label>
					  	<input type="text" id="login_user" class="form-control">
					  	<hr>
					  	<label class="text-black-50">Password</label>
					  	<input type="password" id="login_pass" class="form-control">
					  	<br>
					  
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-primary" data-role="login_modal">Login</button>
				  </div>
					<div id="login_alert_info" class="alert alert-warning" role="alert">
							  <label id="label_login_alert"></label>
						</div>
					<div id="login_alert_success" class="alert alert-success" role="alert">
							  <label id="label_login_alert2"></label>
						</div>
				</div>
			  </div>
			</div>
		</div>
		<div class="col-1"></div>
	</div>
			
	<form action="#" method="post" id="frm_login" hidden="hidden">
		<input type="text" name="per" value="1">
	</form>

<script>
$(document).on('click','.btn',function(){
	var data = $(this).data('role');
	console.log(data);
	if(data == 'login'){
		$('#modal_login').modal('toggle');
	}
	
	if(data == 'login_modal'){
		var user = $('#login_user').val();
		var pass = $('#login_pass').val();
		if(user == ''){
			var text = 'กรุณากรอกชื่อผู้ใช้';
			$('#label_login_alert').text(text);
			$('#login_alert_info').show(500);
			setTimeout(function(){ $('#login_alert_info').hide(500); },5000);
		}
		else if(pass == ''){
			var text = 'กรุณากรอกรหัสผ่าน';
			$('#label_login_alert').text(text);
			$('#login_alert_info').show(500);
			setTimeout(function(){ $('#login_alert_info').hide(500); },5000);
		}
		else{
			var type = 'login';
			console.log(user);
			console.log(pass);
			$.ajax({
				url : 'ajax.php',
				method : 'post',
				data : {type:type,
					   user:user,
					   pass:pass,
					   },
				success:function(result){
					var result = JSON.parse(result);
					console.log(result.statusCode);
					if(result.statusCode == 200){
						var text = 'เข้าสู่ระบบสำเร็จ';
						$('#label_login_alert2').text(text);
						$('#login_alert_success').show(500);
						setTimeout(function login(){
							$('#login_alert_success').hide(500);
							$('#modal_login').modal('toggle');
							setTimeout(function (){
								$('#frm_login').submit();
							},1000);
						},3000);
						
					}else{
						var text = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง ลองใหม่อีกครั้งหรือติดต่อผู้ดูแลระบบ';
						$('#label_login_alert').text(text);
						$('#login_alert_info').show(500);
						setTimeout(function(){ $('#login_alert_info').hide(500); },5000);
					}
					
				}
			})
		}
	}
	
})


$(document).ready(function(){
	$('#modal_login').modal('toggle');
	$('#login_alert_success').hide();
	$('#login_alert_info').hide();
})
</script>
</body>
</html>