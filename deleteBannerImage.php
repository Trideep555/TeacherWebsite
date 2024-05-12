<?php 
    include("connection.php");
    session_start();
    include("adminCheck.php");
    $id = $_REQUEST['id'];
    $query = "SELECT bannerPath FROM `banner-image-table` WHERE `id` = '$id'";
    $path = mysqli_fetch_array(mysqli_query($connection,$query))[0];
    if($path != NULL)
    {
        unlink($path);
        $query="UPDATE `banner-image-table` SET `bannerPath` = NULL WHERE `id` = $id;
                UPDATE `banner-image-table` SET `bannerActivity` = 0 WHERE `id` = $id";
        $res = mysqli_multi_query($connection,$query);
    }
    @header("location:adminDashboard.php");
?>