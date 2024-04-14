<?php
include("connection.php");
$subjects = json_decode($_REQUEST['subjectArray'], true);
$classes = json_decode($_REQUEST['classArray'], true);
$subjLength = count($subjects);
$fName = $_REQUEST['fName'];
$phoneNumber = $_REQUEST['phoneNumber'];


//? Query to check if the phone number is already exist
$query = "SELECT * FROM `teacher-table` WHERE `phoneNumber` = '$phoneNumber'";
$res = mysqli_query($connection, $query);
if (mysqli_num_rows($res) > 0) {
    echo "phoneNumber";
    exit();
}

$email = $_REQUEST['email'];
//? Query to check if email id is already registered.
$query = "SELECT * FROM `teacher-table` WHERE `email` = '$email'";
$res = mysqli_query($connection, $query);
if (mysqli_num_rows($res) > 0) {
    echo "email";
    exit();
}

$lName = $_REQUEST['lName'];

$gender = $_REQUEST['gender'];
$age = $_REQUEST['age'];
$experience = $_REQUEST['experience'];
$qualification = $_REQUEST['qualification'];
$locality = $_REQUEST['locality'];
$mapLink = $_REQUEST['mapLink'];
$address = $_REQUEST['address'];
$state = $_REQUEST['state'];

//? Inserting data of teacher
$query = "INSERT INTO `teacher-table` SET `firstName` = '$fName',
                                         `lastName` = '$lName',
                                         `phoneNumber` = '$phoneNumber',
                                         `email` = '$email',
                                         `gender` = '$gender',
                                         `age` = '$age',
                                         `experience` = '$experience',
                                         `qualification` = '$qualification',
                                         `locality` = '$locality',
                                         `mapLink` = '$mapLink',
                                         `address` = '$address',
                                         `state` = '$state'";
$res = mysqli_query($connection, $query);

//? fetching the newly inserted teacher id(primary key);
$query = "SELECT * FROM `teacher-table` WHERE `firstName` = '$fName' AND `phoneNumber` = '$phoneNumber'";
$res = mysqli_query($connection, $query);
$idarr = mysqli_fetch_array($res);
$teacherId = $idarr['id'];

//?for loop to insert data in teaher-cls-subj table
for ($i = 0; $i < $subjLength; $i++) {
    $classIndex = $classes[$i];
    $subjIndex = $subjects[$i];
    $query = "INSERT INTO `teacher-cls-subj` SET `teacherId` = '$teacherId',
                                                 `classId`='$classIndex',
                                                 `subjectId`='$subjIndex'";
    $res = mysqli_query($connection, $query);
    // echo "hehe";
}
echo $teacherId;
