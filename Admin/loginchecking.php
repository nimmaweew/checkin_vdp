<?php  
session_start();  
  
if($_SESSION['level']=="") {  
    echo "<script>alert('กรุณาล็อคอินก่อนเข้าใช้งาน')</script>";
	echo "<script>window.location='loginfrm.php'</script>";
 }  
?> 