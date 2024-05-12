<?php
    session_start();
    include("connection.php");
    include("adminCheck.php");
    $bannerCount = $_REQUEST['count'];
    if($bannerCount > 0)
    {
        mysqli_query($connection,"UPDATE `carousel-banner-count` SET `count` = '$bannerCount' WHERE '1' = '1'");
    }
    @header('location:adminDashboard.php');
?>