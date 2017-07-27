<?php

//This is the form handling file for the Create/Enter tab of the admin page
//if the submit button is set the filed info is trimmed and stored to the array
//In anycase the ids are created with the first 3 letters of the last name and a random 4 digit pin
// before proceeding to the creation an id is created and the table is searched to be sure that the id doesnt not already exist.
//if the id is already in use the it will enter the loop and try again until a unique id is created.
//A random generator will also be used for the creation of a temporary password that will need to be reset by the user upon creation.
// for testing purposes it is set to something generic so all password will be the same upon creation.
//If the entity is not added successfully the admin is alerted and they are to check the input and be sure that they are correct
//If the insertion is successful the admin will be redirected to the admin page and given a success message. thier userid is stored
//and the session restarted so they remain logged in.

if (isset($_POST['submit'])) {

	require_once('mysqli_connect.php');
	// Trim all the incoming data:
	//array_map() returns an array containing all the elements of an
	//array, $_POST, after applying the callback function (trim) to each one
	$trimmed = array_map('trim', $_POST);

	if($trimmed['entity']=='Student'){
		// Assume invalid values:
		$table = $SID = $PID = $bdate = $program = $fname = $lname = FALSE;

		if ($trimmed['lname']) {

			$lname = mysqli_real_escape_string($dbConnection, $trimmed['lname']);
		}

		if ($trimmed['entity']) {
			$table = mysqli_real_escape_string($dbConnection, $trimmed['entity']);
			$digits = 4;
			$SID = substr($lname, 0, 3) . str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT); //create random id


			$SIDquery = $dbConnection->query("Select SID from Student Where SID ='$SID';"); // test to see if id already exists

			while ($SIDquery->num_rows == 1) {//if there is a result, id exists, so we generate new id and run query and do so until result is 0
				$SID = substr($lname,0,3) . str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);//when result is 0 this SID should be the SID that gets stored later
				$SIDquery = $dbConnection->query("Select SID from Student Where SID ='$SID';"); // Run your query
			}


		}

		if ($trimmed['PID']) {

			$PID = mysqli_real_escape_string($dbConnection, $trimmed['PID']);
		}
		if ($trimmed['bdate']) {
			$bdate = mysqli_real_escape_string($dbConnection, $trimmed['bdate']);
		}
		if ($trimmed['program']) {

			$program = mysqli_real_escape_string($dbConnection, $trimmed['program']);


		}

		if ($trimmed['fname']) {
			$fname = mysqli_real_escape_string($dbConnection, $trimmed['fname']);
		}

		if ($table && $SID && $PID && $bdate && $program && $fname && $lname) { // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";

			$StudentInsertquery = "INSERT INTO $table VALUES('$SID','$fname','$lname','$bdate', $program, '$PID')";


			$bool = true;
			if (!($result = $dbConnection->query($StudentInsertquery))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Student Created Successfully!';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}
		else { // If everything wasn't OK.
			echo "<script type='text/javascript'>alert('All fields are required!');</script>";
			session_start();
			require ('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.
		}
	}

	if($trimmed['entity']== 'Parent'){
		// Assume invalid values:
		$table = $PID = $password = $fname = $lname = $phone = $email = FALSE;

		if ($trimmed['lname']) {

			$lname = mysqli_real_escape_string($dbConnection, $trimmed['lname']);
		}

		if ($trimmed['entity']) {
			$table = mysqli_real_escape_string($dbConnection, $trimmed['entity']);
			$digits = 4;
			$PID = substr($lname, 0, 3) . str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT); //create random id


			$PIDquery = $dbConnection->query("Select ParID from Parent Where ParID ='$PID';"); // test to see if id already exists

			while ($PIDquery->num_rows == 1) {//if there is a result, id exists, so we generate new id and run query and do so until result is 0
				$PID = substr($lname,0,3) . str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);//when result is 0 this SID should be the SID that gets stored later
				$PIDquery = $dbConnection->query("Select ParID from Parent Where ParID ='$PID';"); // Run your query
			}


		}

		if ($trimmed['PID']) {

			$PID = mysqli_real_escape_string($dbConnection, $trimmed['PID']);
		}
		if ($trimmed['phone']) {
			$phone = mysqli_real_escape_string($dbConnection, $trimmed['phone']);
		}
		if ($trimmed['email']) {

			$email = mysqli_real_escape_string($dbConnection, $trimmed['email']);


		}

		if ($trimmed['fname']) {
			$fname = mysqli_real_escape_string($dbConnection, $trimmed['fname']);
		}

		$password = 'password';//set temp password

		if ($table && $password && $PID && $phone && $email && $fname && $lname) { // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";

			$salt1 = "qm&h*";
			$salt2 = "pg!@";
			$password_token = hash('ripemd128', "$salt1$password$salt2");

			$ParentInsertquery = "INSERT INTO $table VALUES('$PID','$password_token','$fname', '$lname','$phone','$email')";


			$bool = true;
			if (!($result = $dbConnection->query($ParentInsertquery))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Parent Created Successfully!\n'.'\n'.'\nEmail sent'.'\nAID: '.$PID.'\n Temporary Password: '.'password';
				echo "<script type='text/javascript'>alert('$successful');</script>";
				//
				//Need to insert email code here. should send same message to parent email
				//
				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}
		else { // If everything wasn't OK.
			echo "<script type='text/javascript'>alert('All fields are required!');</script>";
			session_start();
			require ('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.
		}
	}

	if($trimmed['entity']== 'Teacher'){
		// Assume invalid values:
		$table = $TID = $password = $fname = $lname = $program = FALSE;

		if ($trimmed['lname']) {

			$lname = mysqli_real_escape_string($dbConnection, $trimmed['lname']);
		}

		if ($trimmed['entity']) {
			$table = mysqli_real_escape_string($dbConnection, $trimmed['entity']);
			$digits = 4;
			$TID = substr($lname, 0, 3) . str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT); //create random id


			$TIDquery = $dbConnection->query("Select TID from Teacher Where TID ='$TID';"); // test to see if id already exists

			while ($TIDquery->num_rows == 1) {//if there is a result, id exists, so we generate new id and run query and do so until result is 0
				$TID = substr($lname,0,3) . str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);//when result is 0 this SID should be the SID that gets stored later
				$TIDquery = $dbConnection->query("Select TID from Teacher Where TID ='$TID';"); // Run your query
			}


		}


		if ($trimmed['program']) {

			$program = mysqli_real_escape_string($dbConnection, $trimmed['program']);


		}


		if ($trimmed['fname']) {
			$fname = mysqli_real_escape_string($dbConnection, $trimmed['fname']);
		}

		$password = 'password';//set temp password

		if ($table && $password && $TID && $program && $fname && $lname) { // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";

			$salt1 = "qm&h*";
			$salt2 = "pg!@";
			$password_token = hash('ripemd128', "$salt1$password$salt2");

			$TeacherInsertquery = "INSERT INTO $table VALUES('$TID','$password_token','$fname', '$lname',$program)";


			$bool = true;
			if (!($result = $dbConnection->query($TeacherInsertquery))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Teacher Created Successfully!\n'.'\n'.'\nEmail sent'.'\nTID: '.$TID.'\n Temporary Password: '.'password';
				echo "<script type='text/javascript'>alert('$successful');</script>";
				//
				//Need to insert email code here. should send same message to teacher email
				//
				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}
		else { // If everything wasn't OK.
			echo "<script type='text/javascript'>alert('All fields are required!');</script>";
			session_start();
			require ('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.
		}
	}

	if($trimmed['entity']== 'Admin'){
		// Assume invalid values:
		$table = $AID = $password = $fname = $lname = FALSE;

		if ($trimmed['lname']) {

			$lname = mysqli_real_escape_string($dbConnection, $trimmed['lname']);
		}

		if ($trimmed['entity']) {
			$table = mysqli_real_escape_string($dbConnection, $trimmed['entity']);
			$digits = 4;
			$AID = substr($lname, 0, 3) . str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT); //create random id


			$AIDquery = $dbConnection->query("Select AID from Admin Where AID ='$AID';"); // test to see if id already exists

			while ($AIDquery->num_rows == 1) {//if there is a result, id exists, so we generate new id and run query and do so until result is 0
				$AID = substr($lname,0,3) . str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);//when result is 0 this SID should be the SID that gets stored later
				$AIDquery = $dbConnection->query("Select AID from Admin Where AID ='$AID';"); // Run your query
			}


		}





		if ($trimmed['fname']) {
			$fname = mysqli_real_escape_string($dbConnection, $trimmed['fname']);
		}

		$password = 'password';//set temp password

		if ($table && $password && $AID && $fname && $lname) { // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";

			$salt1 = "qm&h*";
			$salt2 = "pg!@";
			$password_token = hash('ripemd128', "$salt1$password$salt2");

			$AdminInsertquery = "INSERT INTO $table VALUES('$AID','$password_token','$fname', '$lname')";


			$bool = true;
			if (!($result = $dbConnection->query($AdminInsertquery))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Admin Created Successfully!\n'.'\n'.'\nPlease record the following values and change update password!'.'\nAID: '.$AID.'\n Temporary Password: '.'password';
				echo "<script type='text/javascript'>alert('$successful');</script>";
				//
				//No email associated with Admin. need to record this to change password
				//
				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}
		else { // If everything wasn't OK.
			echo "<script type='text/javascript'>alert('All fields are required!');</script>";
			session_start();
			require ('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.
		}
	}
	$dbConnection->close();

} // End of SUBMIT conditional.
?>

