<?php
//This is the form handling file for the login tab. When the submit button is set the mysqli file is imported first.
//each of the fields are trimmed and put into an array and set to the value of the variables user for the queries and output.
//the variables are initially set to false so that if any field is not filled the queries cannot be reached.
//if all inputs are filled the password is hashed and the user input is checked against the table they indicated. If the user does not exist a
//alert box is triggered and they are redirected to the index. if a match is made, they are directed to their respective domain and their user id is stored in the session array.

//
//----------------------------------Login Form---------------------------------------------
if (isset($_POST['login'])) {
	require_once ('mysqli_connect.php');
	// Trim all the incoming data:
	//array_map() returns an array containing all the elements of an
	//array, $_POST, after applying the callback function (trim) to each one
	$trimmed = array_map('trim', $_POST);

	// Assume invalid values:
	$userID = $password = $login = FALSE;

	if ($trimmed['login']) {
		$login = mysqli_real_escape_string($dbConnection, $trimmed['login']);
	}
	if ($trimmed['userID']) {

		$userID = mysqli_real_escape_string($dbConnection, $trimmed['userID']);
	}
	if ($trimmed['password']) {
		$password = mysqli_real_escape_string($dbConnection, $trimmed['password']);
	}

	if ($userID && $password && $login) { // If everything's OK.

		$salt1 = "qm&h*";
		$salt2 = "pg!@";
		$password_token = hash('ripemd128', "$salt1$password$salt2");
		// Query the database:
		switch ($login) {
			case "Parent":
				$id = "ParID";
				break;
			case "Teacher":
				$id = "TID";
				break;
			case "Admin":
				$id = "AID";
				break;
		}
		$query = "SELECT $id FROM $login WHERE $id = '$userID' AND password = '$password_token'";

		if ( !( $result = $dbConnection->query($query))) {
			trigger_error("Query: $query\n<br />MySQL Error: " . $dbConnection->error);
		}


		if ($result->num_rows == 1) { // A match was made.

			if ($id == "ParID"){
				session_start();
				$_SESSION['user'] = $userID;
				$result->close();
				//$dbConnection->close();

				require ('parent.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}else if($id == "TID"){
				session_start();
				$_SESSION['user'] = $userID;
				$result->close();
				//$dbConnection->close();

				require ('teacherForm.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}else{
				session_start();
				$_SESSION['user'] = $userID;
				$result->close();
				//$dbConnection->close();

				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.

			}

		} else { // No match was made.
			//echo '<p class="error">Either the username address and password entered do not match those on file or you have no account yet.</p>';
			//echo '<p class="error">Either the email address and password entered do not match those on file or you have no account yet.</p>';
			$notFoundMessage = "Either the email address and password entered do not match those on file or you have no account yet.\\nTry again.";
			echo "<script type='text/javascript'>alert('$notFoundMessage');</script>";
			require ('index.php');
			exit();
		}
	} else { // If everything wasn't OK.
		echo '<p class="error">Something went wrong</p>';
	}

	$dbConnection->close();

} // End of SUBMIT conditional.
?>
