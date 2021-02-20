<?php 
include('connect.php');
$id = $_POST['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn,"select * from tb_user where id = '$id'"));
?>
<?php echo $row['namegps1']?>