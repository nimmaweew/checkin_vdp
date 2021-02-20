<?php 
session_start();  
  
if($_SESSION['status']==""){  
    echo "<script>alert('กรุณาล็อคอินก่อนเข้าใช้งาน')</script>";
	echo "<script>window.location='Login.php'</script>";
 }  
?>