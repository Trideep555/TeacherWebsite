<?php 
    include("connection.php");
    session_start();
    include("adminCheck.php");
    if($_FILES['banner-upload']['name']!='')
    {
        $fileName = $_FILES['banner-upload']['name'];
        $id = $_REQUEST['id'];
        $extension = pathinfo($fileName,PATHINFO_EXTENSION);
        list($width, $height)=getimagesize($_FILES['banner-upload']['tmp_name']);
        if($width%32!=0 or $height%9!=0)
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
                $query = "UPDATE `banner-image-table` SET `bannerPath` = '$path' WHERE `id` = '$id'";    
                $res = mysqli_query($connection,$query);
                echo "Banner Uploaded Successfully";
            }
            else
            {
                echo "Check your internet :)";
            }
        }
    }
?>