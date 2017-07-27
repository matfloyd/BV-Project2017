<?php
// this is the form handling page for the announce tab
//the goal is to create announncements that will be displayed accross the system in the message tabs.
//in addition to creation the announcement may be removed if it was made in error or if it is invalid
//if there are updates to the daily announcement or types etc. the distinct fields can be updated to correct such issues
//There is also a flag to determine which announcments are display to which groups. currently there are public messages
//and there are teacher specific messages.


if (isset($_POST['submit'])) {
	require_once ('mysqli_connect.php');
	// Trim all the incoming data:
	//array_map() returns an array containing all the elements of an
	//array, $_POST, after applying the callback function (trim) to each one
	$trimmed = array_map('trim', $_POST);

	// Assume invalid values:
	$adminID = $choice = $audience = $title = $date = $message = FALSE;
	session_start();
	$adminID = $_SESSION['user'];

	if($trimmed['anything']=='Post'){

		if ($trimmed['audience']) {
		$audience = mysqli_real_escape_string($dbConnection, $trimmed['audience']);

		}

		if ($trimmed['title']) {

			$title = mysqli_real_escape_string($dbConnection, $trimmed['title']);
		}
		if ($trimmed['message']) {
			$message = mysqli_real_escape_string($dbConnection, $trimmed['message']);
		}
		if ($trimmed['messageDate']) {
			$date = mysqli_real_escape_string($dbConnection, $trimmed['messageDate']);
		}




		if ($adminID && $audience && $title && $date && $message) { // If everything's OK.
			switch($audience){
				case "Public":
					$audience = 0;
					break;
				case "Teachers only":
					$audience = 1;
					break;

			}



			$query = "INSERT INTO Announcements VALUES('$adminID',$audience, '$date', '$title', '$message') ";

			$bool = true;
			if (!($result = $dbConnection->query($query))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if ($bool) { // If it ran OK.
				$successful = 'Your announcement was posted Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}




		} else { // If everything wasn't OK.
			echo "<script type='text/javascript'>alert('All fields are required!');</script>";
			//session_start();
			require ('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.
		}
	}
	if($trimmed['anything']=='Delete') {




		if ($trimmed['messageDate']) {
			$date = mysqli_real_escape_string($dbConnection, $trimmed['messageDate']);
		}

		if ($adminID && $date) { // If everything's OK.


			$deleteP1 = "DELETE FROM Announcements WHERE creator = '$adminID' AND Announcements.date = '$date'";


			$bool = true;
			if (!($result = $dbConnection->query($deleteP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}

			if ($bool) { // If it ran OK.
				$successful = 'Post Removed Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				//session_start();
				require('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.


			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				//session_start();
				require('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}

		}
	}

	if($trimmed['anything']=='EDIT'){
		if ($trimmed['audience']) {
			$audience = mysqli_real_escape_string($dbConnection, $trimmed['audience']);

		}

		if ($trimmed['title']) {

			$title = mysqli_real_escape_string($dbConnection, $trimmed['title']);
		}
		if ($trimmed['message']) {
			$message = mysqli_real_escape_string($dbConnection, $trimmed['message']);
		}
		if ($trimmed['messageDate']) {
			$date = mysqli_real_escape_string($dbConnection, $trimmed['messageDate']);
		}

		if ($adminID && $audience && $title && $date && $message) { // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";
			switch($audience){
				case "Public":
					$audience = 0;
					break;
				case "Teachers only":
					$audience = 1;
					break;

			}

			$updateP1 = "UPDATE Announcements SET flag = $audience WHERE creator = '$adminID' AND Announcements.date = '$date'";
			$updateP2 = "UPDATE Announcements SET title = '$title' WHERE creator = '$adminID'AND Announcements.date = '$date'";
			$updateP3 =  "UPDATE Announcements SET announcement = '$message' WHERE creator = '$adminID'AND Announcements.date = '$date'";


			$bool = true;
			if (!($result = $dbConnection->query($updateP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($updateP2))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($updateP3))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}

			if ($bool) { // If it ran OK.
				$successful = 'Audience, title, and message fields Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}elseif($adminID && $audience && $title && $date){
			switch($audience){
				case "Public":
					$audience = 0;
					break;
				case "Teachers only":
					$audience = 1;
					break;

			}

			$updateP1 = "UPDATE Announcements SET flag = $audience WHERE creator = '$adminID'AND Announcements.date = '$date'";
			$updateP2 = "UPDATE Announcements SET title = '$title' WHERE creator = '$adminID'AND Announcements.date = '$date'";



			$bool = true;
			if (!($result = $dbConnection->query($updateP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($updateP2))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Audience and title fields Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}
		}elseif($adminID && $title && $date && $message){



			$updateP1 = "UPDATE Announcements SET title = '$title' WHERE creator = '$adminID'AND Announcements.date = '$date'";
			$updateP2 = "UPDATE Announcements SET announcement = '$message' WHERE creator = '$adminID'AND Announcements.date = '$date'";


			$bool = true;
			if (!($result = $dbConnection->query($updateP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($updateP2))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Title and message fields Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}
		}elseif($adminID && $audience && $date && $message){
			switch($audience){
				case "Public":
					$audience = 0;
					break;
				case "Teachers only":
					$audience = 1;
					break;

			}

			$updateP1 = "UPDATE Announcements SET flag = $audience WHERE creator = '$adminID'AND Announcements.date = '$date'";

			$updateP2 = "UPDATE Announcements SET announcement = '$message' WHERE creator = '$adminID'AND Announcements.date = '$date'";


			$bool = true;
			if (!($result = $dbConnection->query($updateP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($updateP2))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Audience and message fields Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}
		}elseif($adminID && $audience && $date){
			switch($audience){
				case "Public":
					$audience = 0;
					break;
				case "Teachers only":
					$audience = 1;
					break;

			}

			$updateP1 = "UPDATE Announcements SET flag = $audience WHERE creator = '$adminID'AND Announcements.date = '$date'";



			$bool = true;
			if (!($result = $dbConnection->query($updateP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Audience Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}
		}elseif($adminID && $title && $date){


			$updateP1 = "UPDATE Announcements SET title = '$title' WHERE creator = '$adminID'AND Announcements.date = '$date'";


			$bool = true;
			if (!($result = $dbConnection->query($updateP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Title Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}
		}elseif($adminID && $date && $message){




			$updateP1 = "UPDATE Announcements SET announcement = '$message' WHERE creator = '$adminID'AND Announcements.date = '$date'";

			$bool = true;
			if (!($result = $dbConnection->query($updateP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Message Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}
		}elseif($adminID && $date){

			echo "<script type='text/javascript'>alert('Some field must be chosen to update!');</script>";
			//session_start();
			require ('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.

		}else{//update message only

				$noDate = 'Must enter the date of the Post to be edited.';
				echo "<script type='text/javascript'>alert('$noDate');</script>";

				//$dbConnection->close();
				//session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			}
		}



	$dbConnection->close();

} // End of SUBMIT conditional.
?>
