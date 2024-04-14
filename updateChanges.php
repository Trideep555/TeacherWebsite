<?php 
include("connection.php");
session_start();
if(!isset($_SESSION['admin'])){
    @header("location:".$_SERVER['HTTP_REFERER']);
    exit();
}

$teacherId = $_REQUEST['teacherChangeId'];
$query = "SELECT * FROM `temp-teachertable` WHERE  `teacherId` ='$teacherId'";
$res = mysqli_query($connection,$query);
$rowarr = mysqli_fetch_array($res);


 $fName = $rowarr['firstName'];
 $lName = $rowarr['lastName'];
 $phoneNumber = $rowarr['phoneNumber'];
 $email = $rowarr['email'];
 $gender = $rowarr['gender'];
 $age = $rowarr['age'];
 $experience = $rowarr['experience'];
 $qualification = $rowarr['qualification'];
 $locality = $rowarr['locality'];
 $mapLink = $rowarr['mapLink'];
 $address = $rowarr['address'];
 $state = $rowarr['state'];


$newQuery = "UPDATE `teacher-table` SET `firstName` = '$fName',
                                        `lastName` = '$lName',
                                        `phoneNumber` = '$phoneNumber',
                                        `email` = '$email',
                                        `gender` = '$gender',
                                        `age` = '$age',
                                        `experience` = '$experience',
                                        `qualification` = '$qualification',
                                        `locality` = '$locality',
                                        `mapLink` = '$mapLink',
                                        `address` = '$address',
                                        `state` = '$state'
                                    WHERE `id`='$teacherId'";

$res = mysqli_query($connection,$newQuery);
if($res){
    $deleteQuery = "DELETE FROM `temp-teachertable` WHERE `teacherId` = '$teacherId'";
    $res = mysqli_query($connection,$deleteQuery);
    if($res){
        @header('location:dashboard.php');
    }    
}
?>