<?php 
include('connect.php');
$id = $_POST['id'];
$sql = "select * from tb_locat where id = '$id' order by date DESC";
$result = mysqli_query($conn,$sql);
if($numrow = mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
?>
<tr id=<?php echo $row['data_id'] ?>>
	<td data-target="date"><?php echo $row['date']?></td>
	<td data-target="time"><?php echo $row['time3']?></td>
	<td data-target="nameloc"><?php echo $row['nameloc3']?></td>
	<td><a target="_blank" href="https://www.google.co.th/maps/place/<?php echo $row['lati3']?> <?php echo $row['lon3']?>" class="btn btn-success btn-sm">Google Map</a></td>
	<td><a href="#" class="btn btn-info" data-id="<?php echo $row['data_id'] ?>" data-role="updateloc2-3" data-id="<?php echo $row['data_id'] ?>" >อัพเดท</a></td>
</tr>

<?php
	}
}
?>