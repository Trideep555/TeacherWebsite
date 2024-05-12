<?php
    include("connection.php");
    $userName = $_REQUEST['userName'];
    $password = md5($_REQUEST['password']);
    $query = "SELECT * FROM `user` WHERE `username`='$userName'";
    $res = mysqli_query($connection,$query);
    if(mysqli_num_rows($res)==0)
    {
        echo "-1";
    }
    else
    {
        $arr = mysqli_fetch_array($res);
        //Password match checking
        if($password==$arr['password'])
        {
            session_start();
            if($arr['role'] == "Admin")
            {
                $_SESSION['admin'] = $arr['id'];
                echo "0";
            }
        }
        else
        {
            echo "-2";
        }
    }
?>