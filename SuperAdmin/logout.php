<?php 
session_start();
unset($_SESSION['status']);
unset($_SESSION[['grop']]);
unset($_SESSION['level']);
session_destroy();
header('Location:Login.php');
?>