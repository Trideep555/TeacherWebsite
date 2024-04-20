<?php 
    include("connection.php");
    session_start();
    if($_FILES['banner-upload']['name']!='')
    {
        $fileName = $_FILES['banner-upload']['name'];
        $teacherId = $_SESSION['teacherId'];
        $extension = pathinfo($fileName,PATHINFO_EXTENSION);
        list($width, $height)=getimagesize($_FILES['banner-upload']['tmp_name']);

        $checkSQL = "SELECT * FROM `teacher-bannerimg-table` WHERE `teacherId` = '$teacherId'";
        $checkRes = mysqli_query($connection,$checkSQL);
        if(mysqli_num_rows($checkRes)>=6)
        {
            echo "Only 6 banner allowed\nPlease remove first.";
        }
        else if($width%32!=0 or $height%9!=0)
        {
            echo "Banner image aspect ratio must be 32:9";
        }
        else if(!in_array($extension,array("jpg","jpeg","png")))
        {
            echo "Banner image extension must be .PNG or .JPG or .JPEG";
        }
        else
        {
            $new_name = rand().".". $extension;
            $path = "./Img/banner/". $new_name;
            if(move_uploaded_file($_FILES['banner-upload']['tmp_name'],$path))
            {
                $query = "INSERT INTO `teacher-bannerimg-table` SET `teacherId` = '$teacherId',`bannerImgPath` = '$path'";    
                $res = mysqli_query($connection,$query);
                echo "Banner uploaded successfully";
            }
            else
            {
                echo "Check your internet :)";
            }
        }
    }
?>