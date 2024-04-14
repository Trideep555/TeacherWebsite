<?php 
include("connection.php");
session_start();
if(!isset($_SESSION['admin'])){
    @header("location:".$_SERVER['HTTP_REFERER']);
    exit();
}
$teacherId = $_REQUEST['teacherDeleteId'];
$query = "DELETE FROM `teacher-table` WHERE `id` = '$teacherId'";
$res= mysqli_query($connection,$query);
$query = "DELETE FROM `teacher-cls-subj` WHERE `teacherId` = '$teacherId'";
$res = mysqli_query($connection,$query);
if($res){
    @header("location:adminTeacherTable.php");
}

?>