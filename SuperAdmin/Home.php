<!doctype html>
<?php 

include('connect.php');
include('logincheck.php');
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" href="#" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>


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
						 <li class="nav-item">
							<a class="nav-link" href="Home_location.php">สถานที่</a>
						  </li>
						<li class="nav-item">
							<a class="nav-link" href="Home_company.php">บริษัท</a>
						  </li>
						<li class="nav-item">
							<a class="nav-link" href="Home_site.php">แผนก</a>
						  </li>
						<li class="nav-item">
							<a class="nav-link" href="Home_dept.php">หน่วยงาน</a>
						  </li>
						<li class="nav-item">
							<a class="nav-link" href="Home_grop.php">กลุ่ม</a>
						  </li>
						<li class="nav-item">
							<a class="nav-link" href="Home_login.php">รหัสผู้ดูแล</a>
						  </li>
						<li class="nav-item">
							<a class="nav-link" href="Home_label.php">เปลี่ยนข้อความ</a>
						  </li>
						<li class="nav-item">
							<a class="nav-link" href="Home_time.php">เปลี่ยนเวลาเช็คชื่อ</a>
						  </li>
						<li class="nav-item">
							<a class="nav-link" href="Home_api.php">Api Key</a>
						  </li>
						<li class="nav-item">
							<a class="nav-link" href="Home_distance.php">ระยะห่าง</a>
						  </li>
						<li class="nav-item">
							<a class="nav-link" href="Home_changpassword.php">เปลี่ยนรหัสแอดมิน</a>
						  </li>
					  </ul>
					  <form class="d-flex">
						<button class="btn btn-outline-success" type="button" onClick="logout()">Logout</button>
					  </form>
				  </div>
						</div>
				</nav>
						<br><br>		
	
<script>
	function logout(){
		window.location = "logout.php";
	}
</script>
</body>
</html>