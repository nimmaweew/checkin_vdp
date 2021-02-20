<!doctype html>
<?php 
session_start();
include('connect.php');
if(isset($_POST['level'])){
	$level = $_POST['level'];
	$grop = $_POST['grop'];
	$_SESSION['level'] = $level;
	$_SESSION['grop'] = $grop;

	
		header('Location:admincheck.php');

}
?>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="#" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<style>
	
</style>
<title>HR Admin Login</title>
</head>
<form id="frm_log" method="post">
	

<body>
	
	<input type="hidden" id="level" name="level">
	<input type="hidden" id="grop" name="grop">
	<div class="modal fade bd-example-modal-xl" id="modal_login" xl="modal_login" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title text-center" id="exampleModalLabel" align="center" style="color:darkgoldenrod">Login</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<h5 style="color:darkgoldenrod">Username</h5><input type="text" class="form-control" id="user" name="user">
			  <br>
			<h5 style="color: darkgoldenrod">Password</h5><input type="password" class="form-control" id="pass" name="pass">
			  <br>
			  <div class="alert-danger form-control" id="alert">
			  	<label id="label_alert"></label>
			  </div>
		  </div>
		  <div class="modal-footer" align="left">
			<button type="button" class="btn btn-primary " id="btn_login">Login</button>
		  </div>
		</div>
	  </div>
</div>
<script>
	$(document).ready(function(){
		$('#modal_login').modal('toggle');
		$('#alert').hide();
	})
	
	$('#btn_login').on('click',function(){
		var id = $('#user').val();
		var pass = $('#pass').val();
		if(id == ''){
			var text = 'กรุณาใส่ข้อมูล Username';
			$('#label_alert').text(text);
			$('#alert').show(500);
			setTimeout(function(){
				$('#alert').hide(500);
			},3000)
			document.getElementById('user').focus();
		}
		else if(pass == ''){
			var text = 'กรุณาใส่ข้อมูล Password';
			$('#label_alert').text(text);
			$('#alert').show(500);
			setTimeout(function(){
				$('#alert').hide(500);
			},3000)
			document.getElementById('pass').focus();
		}
		else{
			var type = 'login';
			$.ajax({
				url : 'loginfrm_ajax.php',
				method : 'post',
				data : {type:type,
					   id:id,
					   pass:pass,
					   },
				success:function(result){
					var data = JSON.parse(result);
					var status = data.statusCode;
					if(status == 200){
						var level = data.level;
						var grop = data.grop;
						$('#level').val(level);
						$('#grop').val(grop);
						$('#frm_log').submit();
					}else{
						var text = 'User หรือ Password ไม่ถูกต้อง';
						$('#label_alert').text(text);
						$('#alert').show(500);
						setTimeout(function(){
							$('#alert').hide(500);
						},3000)
					}
				}
			});
		}
	})
</script>
</body>
</form>
</html>
