<?php 
include("connection.php");
session_start();
if($_FILES['upload-dp']['name']!=''){
    $fileName = $_FILES['upload-dp']['name'];
    $teacherId = $_SESSION['teacherId'];
    $extension = pathinfo($fileName,PATHINFO_EXTENSION);
    
    $valid_extensions = array("jpg","jpeg","png","gif");

    if(in_array($extension,$valid_extensions)){
        $new_name = rand().".". $extension;
        $path = "./uploads/". $new_name;
        if(move_uploaded_file($_FILES['upload-dp']['tmp_name'],$path)){

            $query = "SELECT * FROM `teacher-profileimage-table` WHERE `teacherId` = '$teacherId'";
            $res = mysqli_query($connection,$query);
            if(mysqli_num_rows($res)==0){

                $query = "INSERT INTO `teacher-profileimage-table` SET `teacherId` = '$teacherId',
                                                                       `profileImgPath` = '$path'";    
            }
            else{
                $arr = mysqli_fetch_array($res);
                $oldpath = $arr['profileImgPath'];
                unlink($oldpath);
                $query = "UPDATE `teacher-profileimage-table` SET `profileImgPath` = '$path' WHERE `teacherId` = '$teacherId' ";
            }
            $res = mysqli_query($connection,$query);
            echo "Image uploaded successfully";
        }
        else{
            echo "Image crashed!";
        }
    }
    
}


?>