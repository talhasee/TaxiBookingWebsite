<?php
session_start();
unset($_SESSION ['username']);
session_destroy();
$URL="login.php";  
header ("Location: $URL"); 
exit; 
?>