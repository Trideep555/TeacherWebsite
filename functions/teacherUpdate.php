

<?php
//* This comes as updating the teacher and goes to temp teacher table for the admins to approve

include("connection.php");
session_start();
$teacherId = $_SESSION['teacherId'];

$query = "DELETE FROM `teacher-cls-subj` WHERE `teacherId` = '$teacherId'";
$res = mysqli_query($connection,$query);


$subjects = json_decode($_REQUEST['subjectArray'], true);
$classes = json_decode($_REQUEST['classArray'], true);
$subjLength = count($subjects);
$fName = $_REQUEST['fName'];
$phoneNumber = $_REQUEST['phoneNumber'];


//? Query to check if the phone number is already exist
$query = "SELECT * FROM `teacher-table` WHERE `phoneNumber` = '$phoneNumber' AND `id`!='$teacherId'";
$res = mysqli_query($connection, $query);
if (mysqli_num_rows($res) > 0) {
    echo "phoneNumber";
    exit();
}

$email = $_REQUEST['email'];
//? Query to check if email id is already registered.
$query = "SELECT * FROM `teacher-table` WHERE `email` = '$email' AND `id`!='$teacherId'";
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
$query0 ="SELECT * FROM `temp-teachertable` WHERE `teacherId` = '$teacherId'";
$res0 = mysqli_query($connection,$query0);
if(mysqli_num_rows($res0)==0){
    $query = "INSERT INTO `temp-teachertable` SET `firstName` = '$fName',
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
                                         `state` = '$state',
                                         `teacherId` = '$teacherId'";
}
else{
    $query = "UPDATE `temp-teachertable` SET `firstName` = '$fName',
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
                                         `state` = '$state' 
                                         WHERE `teacherId` = '$teacherId'";
} 

$res = mysqli_query($connection, $query);

//? fetching the newly inserted teacher id(primary key);
// $query = "SELECT * FROM `teacher-table` WHERE `firstName` = '$fName' AND `phoneNumber` = '$phoneNumber'";
// $res = mysqli_query($connection, $query);
// $idarr = mysqli_fetch_array($res);
// $teacherId = $idarr['id'];

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
