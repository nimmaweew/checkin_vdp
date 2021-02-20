<?php 
include('connect.php');
$id = $_POST['id'];
$sql = "select * from tb_locat where id = '$id' order by date DESC";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
?>
<tr id=<?php echo $row['data_id']?>>
	<td><?php echo $row['date'] ?></td>
	<td><?php echo $row['time1'] ?></td>
	<td><?php echo $row['phone1']?></td>
	<td><a href="#" class="btn btn-xs btn-success" data-id="<?php echo $row['data_id'] ?>" data-role="updatemobiledata">Update</a></td>
</tr>

<?php
	
}
?>