<?php

require_once('connect.php');

if (isset($_POST) & !empty($_POST)) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $res = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($res);
    //If there is only one result for the return query
    if ($count == 1) {
        echo "User found";
    }

    else {
        echo "User name does not exist in database";
    }
    
}

//Above works locally but unable to definitively test code below

$r = mysqli_fetch_assoc($res);
$password = $r['password'];
$to = $r['email'];
$subject = "BonaVista Password";

$message = "Please use this password to login " . $password;
$headers = "From : someone@Bvista.com";
if (mail($to, $subject, $message, $headers)) {
    echo "Your Password has been sent to your email";
}

else {
    echo "<br>Password recovery failed, Please try again";
}