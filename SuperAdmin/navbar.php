<!doctype html>
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

</head>

<body>
		<div class="row">
			<div class="col-12">
				<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
							<a class="nav-link" href="Home_site.php">หน่วยงาน</a>
						  </li>
						<li class="nav-item">
							<a class="nav-link" href="Home_dept.php">แผนก</a>
						  </li>
						<li class="nav-item">
							<a class="nav-link" href="Home_grop.php">กลุ่ม</a>
						  </li>
						<li class="nav-item">
							<a class="nav-link" href="Home_login.php">รหัสคนดูแล</a>
						  </li>
						<li class="nav-item">
							<a class="nav-link" href="Home_changpassword.php">เปลี่ยนรหัสแอดมิน</a>
						  </li>
					  </ul>
					<form class="form-inline my-2 my-lg-0">						
					  <button class="btn btn-outline-success my-2 my-sm-0" type="button" onClick="logout()" data-role='login'>Logout</button>
					</form>
				  </div>
				</nav>
			</div>
		</div>
	<br><br>		
</body>
</html>