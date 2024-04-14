<?php 
include("connection.php");
$userName = $_REQUEST['userName'];
$password = md5($_REQUEST['password']);
$query = "SELECT * FROM `user` WHERE `username`='$userName'";
$res = mysqli_query($connection,$query);
if(mysqli_num_rows($res)==0){
    echo "-1";
}
else{
    $arr = mysqli_fetch_array($res);
    //Password match checking
    if($password==$arr['password']/*password matched*/){
        session_start();
        if($arr['role']=="Admin"){
            $_SESSION['admin'] = $arr['teacherId'];
            echo "0";
            // header("location:dashboard.php");
        }
        else{
            $_SESSION['teacherId'] = $arr['teacherId']; 
            echo $arr['teacherId'];
            // header("location:);
        }
    }
    else{
        echo "-2";
    }
}


?>