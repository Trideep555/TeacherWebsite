<?php
$connection = mysqli_connect("localhost", "root", "", "teacher_project_website");
if (mysqli_connect_errno()) {
    echo "Failed to connect to database" . mysqli_connect_error();
}
