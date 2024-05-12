<?php 
    include("connection.php");
    session_start();
    include("adminCheck.php");

    $id = $_REQUEST['id'];
    $type = $_REQUEST['type'];
    $query = "SELECT activity, bannerActivity, bannerPath FROM `teacher-table`, `banner-image-table` WHERE `teacher-table`.`id` = '$id' AND `banner-image-table`.`id` = '$id'";
    $res = mysqli_query($connection,$query);
    $rowarr = mysqli_fetch_array($res);
    if($type == 'teacher' || $type == 'institute')
    {
        if($rowarr['activity'] == 0)
        {
            $query="UPDATE `teacher-table` SET `activity` = '1' WHERE `id` = '$id'";
        }
        else
        {
            $query="UPDATE `teacher-table` SET `activity` = '0' WHERE `id` = '$id';
                    UPDATE `banner-image-table` SET `bannerActivity` = '0' WHERE `id` = '$id'";
        }
        
    }
    else if($type == 'banner')
    {
        if($rowarr['bannerActivity'] == 0 and $rowarr['activity'] == 1 and $rowarr['bannerPath'] != NULL)
        {
            $query="UPDATE `banner-image-table` SET `bannerActivity` = '1' WHERE `id` = '$id'";
        }
        else
        {
            $query="UPDATE `banner-image-table` SET `bannerActivity` = '0' WHERE `id` = '$id'";
        }
    }
    else
    {
        @header('location:adminDashboard.php');
    }
    $res = mysqli_multi_query($connection,$query);
    if($res)
    {
        @header('location:adminDashboard.php');
    }
?>