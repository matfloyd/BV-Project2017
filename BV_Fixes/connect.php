<?php
//This is a test SQL connection file, replace with appropriate file
$connection = mysqli_connect('localhost', 'phpmyadmin', 'Foxglove');
if (!$connection) {
    die("Database Connection failed" . mysqli_error($connection));
}

$select_db = mysqli_select_db($connection, 'BV_CSRS');
if (!$select_db) {
    die("Database selection failed" . mysqli_error($connection));
}
/*
else {
    echo "Connection Successful";
}

*/
