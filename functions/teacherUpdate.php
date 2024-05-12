<?php

    include("connection.php");
    session_start();
    if(!isset($_SESSION['admin']))
    {
        @header("location:./../index.php");
        exit();
    }
    $id = $_REQUEST['id'];

    $query = "DELETE FROM `teacher-cls-subj` WHERE `teacherId` = '$id'";
    $res = mysqli_query($connection, $query);

    $subjects = json_decode($_POST['subjectArray'], true);
    $classes = json_decode($_POST['classArray'], true);
    $subjLength = count($subjects);

    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $experience = $_POST['experience'];
    $mode = $_POST['mode'];
    $locality = $_POST['locality'];
    $mapLink = $_POST['mapLink'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $about = $_POST['about'];
    $role = $_POST['role'];

    $query = "UPDATE `teacher-table` SET `firstName` = '$fName',
                                         `lastName` = '$lName',
                                         `phoneNumber` = '$phoneNumber',
                                         `email` = '$email',
                                         `gender` = '$gender',
                                         `age` = '$age',
                                         `experience` = '$experience',
                                         `mode` = '$mode',
                                         `locality` = '$locality',
                                         `mapLink` = '$mapLink',
                                         `address` = '$address',
                                         `state` = '$state',
                                         `about` = '$about',
                                         `role` = '$role' 
                                         WHERE `id` = '$id'";
    $res = mysqli_query($connection, $query);

    if(isset($_FILES['profileImage']))
    {
        $query = "SELECT profileImagePath FROM  `profile-image-table` WHERE `id` = '$id'";
        $path = mysqli_fetch_array(mysqli_query($connection, $query))['profileImagePath'];
        if($path != "./Img/user.png")
        {
            unlink("./.".$path);
        }
        $fileName = $_FILES['profileImage']['name'];
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $valid_extensions = array("jpg","jpeg","png");
        if(in_array($extension, $valid_extensions)){
            $new_name = rand().".". $extension;
            $path = "./uploads/". $new_name;
            if(move_uploaded_file($_FILES['profileImage']['tmp_name'],("./.".$path)))
            {
                $query = "UPDATE `profile-image-table` SET `profileImagePath` = '$path' WHERE `id` = '$id';";
            }
        }
    }
    if(isset($_POST['removeProfileImage']))
    {
        $query = "UPDATE `profile-image-table` SET `profileImagePath` = './Img/user.png' WHERE `id` = '$id';";
    }

    $res = mysqli_multi_query($connection, $query);
    echo $res;

    for ($i = 0; $i < $subjLength; $i++)
    {
        $classIndex = $classes[$i];
        $subjIndex = $subjects[$i];
        $query = "INSERT INTO `teacher-cls-subj` SET `teacherId` = '$id',
                                                     `classId`='$classIndex',
                                                     `subjectId`='$subjIndex'";
        $res = mysqli_query($connection, $query);
    }
    echo $res;
?>
