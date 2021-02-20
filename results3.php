<?php 
include('connect.php');
	
	$id = $_POST['id'];
	
	$row_label = mysqli_fetch_assoc($result = mysqli_query($conn,"select * from tb_label where name = 'Result_Company'"));
	$label = $row_label['text'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<title>แจ้งผลการดำเนินการ</title>
</head>

<body>
	<form>
		<div class="container-fluid">
			<div class="col-12" align="center">
				<br>				
				<h3 class="text-primary" >อยู่บ้านหยุดเชื้อช่วยชาติ</h3>
				<br>
				<h3 class="text-primary"><?php echo $label ?></h3>
				<br><br><br>
				<h1 id="res" class="text-info">ขณะนี้ยังไม่ถึงเวลาเช็คชื่อ</h1>
				<br>

				<br><br><br>
				<h4>ข้อมูลพนักงาน</h4>
				<br>
				<table class="table">
					<?php 
						$result_user = mysqli_query($conn,"select * from tb_user where id = '$id'");
							$row = mysqli_fetch_assoc($result_user);
							$name = $row['name'];
							$lname = $row['lname'];
					?>
					<tbody>
						<tr>
						<td>รหัสพนักงาน</td>
						<td><?php echo $id ?></td>
						</tr>
						<tr>
						<td>ชื่อพนักงาน</td>
						<td><?php echo $name ?>&nbsp;&nbsp;<?php echo $lname ?></td>
						</tr>
					</tbody>
					
				</table>
				<a href="https://www.google.co.th" class="btn btn-outline-success">ปิด</a>
			<br><br>
			</div>
		</div>
	</form>
</body>
<script type="text/javascript" >
//disable back button
history.pushState(null, null, '');
window.addEventListener('popstate', function(event) {
  history.pushState(null, null, '');
});
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>