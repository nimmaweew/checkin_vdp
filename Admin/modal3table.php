<?php 
include('connect.php');
$id = $_POST['id'];
$time = $_POST['time'];
if($time == '1'){
	$sql = "select * from tb_rep_mon where id='$id' ORDER BY date DESC LIMIT 10";
}else if($time == '2'){
	$sql = "select * from tb_rep_after where id='$id' ORDER BY date DESC LIMIT 10";
}else if($time == '3'){
	$sql = "select * from tb_rep_even where id='$id' ORDER BY date DESC LIMIT 10";
}

$result = mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
	$detail = $row['detail'];
	$subdis = $row['subdistrict'];
	$district = $row['district'];
	$province = $row['province'];
	$nameloc = $detail.' '.$subdis.' '.$district.' '.$province;
?>
<tr id=<?php echo $row['tb_id'] ?>>
	<td data-target="date"><?php echo $row['date']?></td>
	<td data-target="time"><?php echo $row['time']?></td>
	<td data-target="nameloc"><?php echo $nameloc ?></td>
	<td><a target="_blank" href="https://www.google.co.th/maps/place/<?php echo $row['lati']?> <?php echo $row['lon']?>" class="btn btn-success ">Google Map</a></td>
	<td><a href="#" class="btn btn-info" data-id="<?php echo $row['tb_id'] ?>" data-role="updateloc" data-id="<?php echo $row['tb_id'] ?> " data-id2="<?php echo $time ?>" >Update</a></td>
</tr>
<?php
									   }
?>