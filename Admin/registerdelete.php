<?php 
date_default_timezone_set("Asia/Bangkok");
include('connect.php');
if(isset($_POST['id'])){
	$id = $_POST['id'];
	$sql = "delete from tb_user where id = '$id'";
	if(mysqli_query($conn,$sql)){
		$sql = "select * from tb_user";
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
		$grop = $row['grop'];
		$gropsql = "select * from tb_grop where no ='$grop'";
		$gropresult = mysqli_query($conn,$gropsql);
		$groprow = mysqli_fetch_assoc($gropresult);
	?>
		<tr id="<?php echo $row['id']?>"</tr>
		<td data-target="loc"><?php echo $locationrow['name'] ?></td>
		<td data-target="com"><?php echo $comrow['name']?></td>
		<td data-target="site"><?php echo $row['site'] ?></td>
		<td data-target="dept"><?php echo $row['dept']?></td>
		<td data-target="grop"><?php echo $groprow['name'] ?></td>
		<td data-target="id"><?php echo $row['id'] ?></td>
		<td data-target="type"><?php echo $row['type'] ?></td>
		<td data-target="name"><?php echo $row['name'] ?></td>
		<td data-target="lname"><?php echo $row['lname'] ?></td>
		<td data-target="tel"><?php echo $row['tel'] ?></td>
		<td data-target="id"><input type="button" class="btn btn-sm btn-outline-warning" data-id="<?php echo $row['id'] ?>" data-role="update" value="Update"></td>
		<td data-target="id"><input type="button" class="btn btn-sm btn-outline-danger" data-id="<?php echo $row['id']?>" data-role="Delete" value="Delete"</td>
		
			
	</tr>
	<?php
		}
		}
}
mysqli_close($conn);
?>