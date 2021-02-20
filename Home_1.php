<!doctype html>
<?php 

include('connect.php');

$result = mysqli_query($conn,"select * from tb_label where name = 'Home1_Detail'");
$row1 = mysqli_fetch_assoc($result);
$Home1_detail = $row1['text'];
$result = mysqli_query($conn,"select * from tb_label where name = 'Home1_company'");
$row2 = mysqli_fetch_assoc($result);
$Home1_company = $row2['text'];

?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<style>
	.checkbox{
		width: 33px;
		height: 33px;
	}	
</style>
<title>Home</title>
</head>

<body>
	<div aria-live="polite" aria-atomic="true" class="position-relative">
	  <!-- Position it: -->
	  <!-- - `.toast-container` for spacing between toasts -->
	  <!-- - `.position-absolute`, `top-0` & `end-0` to position the toasts in the upper right corner -->
	  <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
	  <div class="toast-container position-absolute top-0 end-0 p-3">

		<!-- Then put toasts within -->
		<div class="toast alert-danger" role="alert" aria-live="assertive" aria-atomic="true">
		  <div class="toast-header" style="background-color: #FF6868">
			<strong class="me-auto">แจ้งเตือน</strong>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		  </div>
		  <div class="toast-body">
				<label id="label_alert"></label>
		  </div>
		</div>
	  </div>
	</div>
	<br>
		<div class="row">
			<div class="col-1 col-sm-1 col-md-4 col-xl-4"></div>
			<div class="col-10 col-sm-10 col-md-4 col-xl-4" align="center">
				<h3 class="text-primary"><?php echo $Home1_company ?></h3>
			</div>
			<div class="col-1 col-sm-1 col-md-4 col-xl-4 "></div>
		</div>
		<br>
		<div class="row">
			<div class="col-1 col-sm-2 col-md-4 col-xl-4"></div>
			<div class="col-10 col-sm-8 col-md-4 col-xl-4 border-dark" align="center">
					<textarea class="form-control" readonly style="text-align: -webkit-center;overflow-x: hidden" rows=10><?php echo $Home1_detail ?></textarea>
			</div>
			<div class="col-1 col-sm-2 col-md-4 col-xl-4"></div>
		</div>
	<br>
		<div class="row">
			<div class="col-1 col-md-4 col-xl-4 col-sm-1"></div>
			<div class="col-10 col-sm-10 col-md-4 col-xl-4" align="center">
				<input name="accept" id="check" type="checkbox" class="checkbox btn-outline-primary" onChange="myfunction()">
				<input type="hidden" id="accept" value="0">
				<br>
				<h5>ยอมรับ</h5>
					
			</div>
			<div class="col-1 col-sm-1 col-md-4 col-xl-4 "></div>
		</div>
	<br>
		<div class="row">
			<div class="col-1 col-md-4 col-xl-4 col-sm-1"></div>
			<div class="col-10 col-sm-10 col-md-4 col-xl-4" align="center">
				<input type="text" id="tel" class="border-primary form-control" maxlength="10" placeholder="เบอร์โทรศัพท์">
				<br>
				<div class="alert-danger form-control" id="alert_warning">
					<label id="label-warning"></label>
				</div>
				<br>
				<input type="button" class="btn btn-outline-success" value="ดำเนินการต่อ" onClick="go()">
					<br>
				<br>
			</div>
			<div class="col-1 col-sm-1 col-md-4 col-xl-4 "></div>
		</div>
	<div class="modal fade" id="modal_select" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">เลือกช่วงเวลาทำงาน</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			  <input type="hidden" id="hd_site_id">
			  <input type="hidden" id="hd_dept_id">
				<select id="sel_time" class="form-control btn-outline-primary">
			  		<option value="0">-----</option>
					<option value="1">กะเช้า</option>
					<option value="2">กะดึก</option>
			  	</select>
			  <br>
			  <br>
			  <div id="warning" class="alert alert-warning form-control" role="alert">
				<label id="label_warning"></label>
			</div>
			<div id="success" class="alert alert-success form-control" role="alert">
				<label id="label_success"></label>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" onclick="goto()">ดำเนินการต่อ</button>
		  </div>
		</div>
	  </div>
	</div>
		<form id="frm" action="Home_2.php" method="post">
			<input type="hidden" name="tel" id="hd_tel">
			<input type="hidden" name="time" id="time">
		</form>
	
		
	
<script>
	function goto(){
		var time = $('#sel_time').val();
		if(time == '0'){
			var text = 'กรุณาเลือกช่วงเวลาทำงาน';
			$('#label_warning').text(text);
			$('#warning').show(500);
			setTimeout(function(){
				$('#warning').hide(500);
			},3000)
		}else{
			$('#time').val(time);
			var tel = $('#tel').val();
			$('#hd_tel').val(tel);
			var type = 'chk_time';
			$.ajax({
				url : 'ajax.php',
				method : 'post',
				data : {type:type,
					   time:time},
				success:function(result){
					var data = JSON.parse(result);
					var status = data.statusCode;
					if(status == 200){
						$('#frm').submit();
					}else{
						var text = 'ขณะนี้ยังไม่ถึงเวลาเช็คชื่อ';
						$('#label_warning').text(text);
						$('#warning').show(500);
						setTimeout(function(){
							$('#warning').hide(500);
						},3000)
					}
				}
			})
		}
	}
	function myfunction(){
		if(document.getElementById('check').checked == true){
			console.log('true')
			$('#accept').val('1');
		}
		else if(document.getElementById('check').checked == false){
			console.log('false')
			$('#accept').val('0');
		}
	}
	$(document).ready(function(){
		$('#alert_warning').hide();
		$('#success').hide();
		$('#warning').hide();
	})
	function go(){
		var check = $('#accept').val();
		var tel = $('#tel').val();
		var ntel = tel.length;
		if(check == '0'){
			var text = 'กรุณายอมรับข้อตกลง';
			$('#label-warning').text(text);
			$('#alert_warning').show(500);
			setTimeout(function(){
				$('#alert_warning').hide(500);
			},3000)
		}
		else if(check == '1'){
			if(ntel < 10){
						var text = 'เบอร์มือถือไม่ถูกต้อง';
						$('#label-warning').text(text);
						$('#alert_warning').show(500);
						setTimeout(function(){
							$('#alert_warning').hide(500);
						},3000)
				}else{
				
				var type = 'tel_check';
				$.ajax({
					url : 'ajax.php',
					method : 'post',
					data : {type:type,
						   tel:tel},
					success:function(result){
						var data = JSON.parse(result);
						var status = data.statusCode;
						if(status == 200){
							$('#modal_select').modal('toggle');
						}else{
							var text = 'ไม่มีข้อมูลมือถือในระบบกรุณาติดต่อแอดมินของท่าน';
							$('#label-warning').text(text);
							$('#alert_warning').show(500);
							setTimeout(function(){
								$('#alert_warning').hide(500);
							},3000);
						}
					}
				})
			}
		}
	}
</script>
</body>
</html>