<?php 
session_start();
unset($_SESSION['teacherId']);
session_destroy();
@header("location:index.php");

?>