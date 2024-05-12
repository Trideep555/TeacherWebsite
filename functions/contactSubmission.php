<?php
    include("connection.php");
    
    $firstName = $_REQUEST['FName'];
    $lastName = $_REQUEST['LName'];
    $email = $_REQUEST['email'];
    $phoneNumber = $_REQUEST['phoneNumber'];
    $subject = $_REQUEST['subject'];
    $message = $_REQUEST['message'];

    $query = "INSERT INTO `contact-table` SET `firstName` = '$firstName',
                                            `lastName` = '$lastName',
                                            `email` = '$email',
                                            `phoneNumber` = '$phoneNumber',
                                            `subject` = '$subject',
                                            `message` = '$message'";
    $res = mysqli_query($connection, $query);
    echo "Thank you for Contacting,</br>We will reach you as soon as possible";
?>