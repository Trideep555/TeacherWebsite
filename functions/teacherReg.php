<?php
    include("connection.php");
    session_start();
    if(!isset($_SESSION['admin']))
    {
        @header("location:./../index.php");
        exit();
    }
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

    // Inserting data of teacher
    $query = "INSERT INTO `teacher-table` SET `firstName` = '$fName',
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
                                              `role` = '$role'";
    $res = mysqli_query($connection, $query);
    echo($res);



    // Fetching the newly inserted teacher id(primary key);
    $query = "SELECT id FROM `teacher-table` WHERE `firstName` = '$fName' AND `lastName` = '$lName' AND `phoneNumber` = '$phoneNumber'";
    $id = mysqli_fetch_array(mysqli_query($connection, $query))['id'];

    $query = "INSERT INTO `teacher-cls-subj` SET `teacherId` = '$id',`classId`='',`subjectId`=''";
    $res = mysqli_query($connection, $query);
    echo $res;  

    $query = "INSERT INTO `banner-image-table` SET `id` = '$id';";
    
    if(isset($_FILES['profileImage']))
    {
        $fileName = $_FILES['profileImage']['name'];
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $valid_extensions = array("jpg","jpeg","png");
        if(in_array($extension, $valid_extensions)){
            $new_name = rand().".". $extension;
            $path = "./uploads/". $new_name;
            if(move_uploaded_file($_FILES['profileImage']['tmp_name'],("./.".$path)))
            {
                $query = $query."INSERT INTO `profile-image-table` SET `profileImagePath` = '$path', `id` = '$id';";
            }
        }
    }
    else
    {
        $query = $query."INSERT INTO `profile-image-table` SET `id` = '$id', `profileImagePath` = './Img/user.png';";
    }
    
    $res = mysqli_multi_query($connection, $query);

    // For loop to insert data in teaher-cls-subj table
    /*for ($i = 0; $i < $subjLength; $i++)
    {
        $classIndex = $classes[$i];
        $subjIndex = $subjects[$i];
        $query = "INSERT INTO `teacher-cls-subj` SET `teacherId` = '$id',
                                                     `classId`='$classIndex',
                                                     `subjectId`='$subjIndex'";
        $res = mysqli_query($connection, $query);
    }
    */
?>