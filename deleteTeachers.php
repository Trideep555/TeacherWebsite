<?php 
    include("connection.php");
    session_start();
    include("adminCheck.php");
    $id = $_REQUEST['id'];

    $query = "SELECT `banner-image-table`.bannerPath, `profile-image-table`.profileImagePath FROM `banner-image-table`, `profile-image-table` WHERE `banner-image-table`.`id` = '$id' AND `profile-image-table`.`id` = '$id';";
    $path = mysqli_fetch_array(mysqli_query($connection,$query));
    if($path['bannerPath'] != NULL)
    {
        unlink($path['bannerPath']);
    }
    if($path['profileImagePath'] != "./Img/user.png")
    {
        unlink($path['profileImagePath']);
    }

    $query="DELETE FROM `teacher-table` WHERE `id` = '$id';
            DELETE FROM `banner-image-table` WHERE `id` = '$id';
            DELETE FROM `profile-image-table` WHERE `id` = '$id';
            DELETE FROM `teacher-cls-subj` WHERE `teacherId` = '$id';";
    $res = mysqli_multi_query($connection,$query);
    if($res)
    {
        @header("location:adminDashboard.php");
    }
?>