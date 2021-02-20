<?php 
include('connect.php');
$id = $_POST['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn,"select * from tb_user where id = '$id'"));
?>
https://www.google.co.th/maps/place/<?php echo $row['lati1']?> <?php echo $row['lon1']?>