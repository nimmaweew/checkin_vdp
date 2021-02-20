<?php 
	include('connect.php');
	if(isset($_POST['txt'])){
		$text = $_POST['txt'];
		$grop = $_POST['grop'];
		if($text <>''){
			$sql = "SELECT * FROM `tb_user` where chk <> '0' and tel like '%$text%' OR chk <> '0' and id like '%$text%' or chk <> '0' and name  like '%$text%' or chk <> '0' and lname like '%$text%'";
		}else{
			$sql = "select * from tb_user where chk <> '0'";
		}
		
	}else{
		$sql = "select * from tb_user where chk <> '0'";
	}
	
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($result)){
	$loc = $row['loc'];
	$location = "select * from tb_location where id='$loc'";
	$locationresult = mysqli_query($conn,$location);
	$locationrow = mysqli_fetch_assoc($locationresult);
	$com = $row['com'];
	$company = "select * from tb_com where id = '$com'";
	$comresult = mysqli_query($conn,$company);
	$comrow = mysqli_fetch_assoc($comresult);
	$site = $row['site'];
	$rowsite = mysqli_fetch_assoc(mysqli_query($conn,"select * from tb_site where id = '$site'"));
	$dept = $row['dept'];
	$rowdept = mysqli_fetch_assoc(mysqli_query($conn,"select * from tb_dept where id = '$dept' and site_id = '$site' "));
	$grop = $row['grop'];
	$gropsql = "select * from tb_grop where id ='$grop'";
	$gropresult = mysqli_query($conn,$gropsql);
	$groprow = mysqli_fetch_assoc($gropresult);
?>
	<tr id="<?php echo $row['id']?>">
		<td>
		<div class="dropdown">
		  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa fa-cog" aria-hidden="true"></i>
		  </button>
		  <div class="dropdown-menu dropdown-secondary" aria-labelledby="dropdownMenuButton">
			<a href="#" class="dropdown-item item1" data-id="<?php echo $row['id'] ?>" data-role="update" >แก้ไข</a>
			<a href="#" class="dropdown-item item2" data-id="<?php echo $row['id']?>" data-role="Delete" >ลบข้อมูล</a>
			<a href="#" class="dropdown-item item3" data-id="<?php echo $row['id']?>" data-role="updatelocation" >อัพเดทที่ตั้ง 1</a>
			<a href="#" hidden="" class="dropdown-item item3" data-id="<?php echo $row['id']?>" data-role="updatelocation2" >อัพเดทที่ตั้ง 2</a>
			<a href="#" hidden="" class="dropdown-item item3" data-id="<?php echo $row['id']?>" data-role="updatemobile" >อัพเดทข้อมูลมือถือ</a>
		  </div>
		</div>
		</td>
		<td data-target="loc"><?php echo $locationrow['name'] ?></td>
		<td data-target="com"><?php echo $comrow['name']?></td>
		<td data-target="site"><?php echo $rowsite['name'] ?></td>
		<td data-target="dept"><?php echo $rowdept['name']?></td>
		<td data-target="grop"><?php echo $groprow['name'] ?></td>
		<td data-target="id"><?php echo $row['id'] ?></td>
		<td data-target="type"><?php echo $row['type'] ?></td>
		<td data-target="name"><?php echo $row['name'] ?></td>
		<td data-target="lname"><?php echo $row['lname'] ?></td>
		<td data-target="tel"><?php echo $row['tel'] ?></td>
		
		
			
	</tr>

<?php
		}
		mysqli_close($conn);
?>