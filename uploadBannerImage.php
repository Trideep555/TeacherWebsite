<?php 
include("connection.php");
session_start();
if($_FILES['banner-upload']['name']!=''){
    $fileName = $_FILES['banner-upload']['name'];
    $teacherId = $_SESSION['teacherId'];
    $extension = pathinfo($fileName,PATHINFO_EXTENSION);
    
    $valid_extensions = array("jpg","jpeg","png","gif");

    $checkSQL = "SELECT * FROM `teacher-bannerimg-table` WHERE `teacherId` = '$teacherId'";
    $checkRes = mysqli_query($connection,$checkSQL);
    if(mysqli_num_rows($checkRes)>=6){
        echo "Only 6 banner allowed\nPlease remove first.";
    }
    else{
        if(in_array($extension,$valid_extensions)){
            $new_name = rand().".". $extension;
            $path = "./uploads/". $new_name;
            if(move_uploaded_file($_FILES['banner-upload']['tmp_name'],$path)){
                $query = "INSERT INTO `teacher-bannerimg-table` SET `teacherId` = '$teacherId',`bannerImgPath` = '$path'";    
                $res = mysqli_query($connection,$query);
                echo "Banner uploaded successfully";
            }
            else{
                echo "Check your internet :)";
            }
        }

    }

    
    
}


?>