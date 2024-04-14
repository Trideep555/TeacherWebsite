<?php 
include("connection.php");
session_start();
if (isset($_SESSION["teacherId"])) {
    $teacherId = $_SESSION['teacherId'];
    $bannerId = $_REQUEST['bannerId'];
    
    $path = $_REQUEST['path'];
    $query = "SELECT * FROM `teacher-bannerimg-table` WHERE `id` = '$bannerId' AND `teacherId` = '$teacherId' ";
    $res = mysqli_query($connection,$query);
    if (mysqli_num_rows($res) > 0) {
        if(unlink($path)){
            $query = "DELETE FROM `teacher-bannerimg-table` WHERE `id` = $bannerId";
            $res = mysqli_query($connection,$query);
            echo "Banner deleted";
        }
        else{
            echo "Something went wrong!";
        }

    }
}

?>