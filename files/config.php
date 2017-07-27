<?php
/* This configuration script:
 * - define constants and settings
 * - dictates how errors are handled
 * - defines useful functions
 */
 
// Document who created this site, when, why, etc.

// ********************************** //
// ************ SETTINGS ************ //

//Fefine some important constants:

//Flag for site status:
define('LIVE', FALSE);

// Admin contact address:
define('EMAIL', 'Insert Real Admin Email Address Here');

// Site URL (base for all redirections):
define ('BASE_URL', 'http://ko-turing.ads.iu.edu/~info451-02/');

// Location of the MySQL connection script:
define ('MYSQLI_CONNECT', 'mysqli_connect.php');

// Adjust the time zone for PHP 5.1 and greater:
date_default_timezone_set ('US/Eastern');

// ************ SETTINGS ************ //
// ********************************** //


// ****************************************** //
// ************ ERROR MANAGEMENT ************ //

//Create the error handler - Will generate a very detailed error message
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {

	// Build the error message.
	$message = "<p>An error occurred in script '$e_file' on line $e_line: $e_message\n<br />";
	
	// Add the date and time:
	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n<br />";
	
	// Append $e_vars to the $message:
	$message .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n</p>";
	
	if (!LIVE) { // Development (print the error).
	
		echo '<div class="error">' . $message . '</div><br />';
		
	} else { // The server is live so don't show the error:
	
		// Send an email to the admin:
		//mail(EMAIL, 'Site Error!', $message, 'From: email@example.com');
		
		// Only print an error message if the error isn't a notice:
		if ($e_number != E_NOTICE) {
			echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div><br />';
		}
	} // End of !LIVE IF.

} // End of my_error_handler() definition.

// Use my error handler.
set_error_handler ('my_error_handler');

// ************ ERROR MANAGEMENT ************ //
// ****************************************** //

?>
