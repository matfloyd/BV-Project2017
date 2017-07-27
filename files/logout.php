<?php
// This is the logout page for the site.


$page_title = 'Logout';
include ('header.php');

// If no first_name session variable exists, redirect the user:
if (!isset($_SESSION['userdata']['user_name'])) {

    $url = 'http://ko-turing.ads.iu.edu/~info451-02/index.php'; // Define the URL.
    ob_end_clean(); // Delete the buffer.
    header("Location: $url");
    exit(); // Quit the script.

} else { // Log out the user.

    $_SESSION = array(); // Destroy the variables.
    session_destroy(); // Destroy the session itself.
    setcookie (session_name(), '', time()-300); // Destroy the cookie.

}

// Print a customized message:
echo '<h3>You are now logged out.</h3>';

include ('footer.php');
?>
