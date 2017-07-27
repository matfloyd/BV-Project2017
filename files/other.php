<?php

//This file handles multiple tasks in one tab.
//the portion of the admin html tab "other" will provide tasks such as adding students to classes that are specific
// to the program they are in, simple searching like "id by name", and general reports that the admin may want to access
//to get information about classes, students, rosters, etc.
// the form section currently only displays the the roster report but many other reports can be developed. we are waiting
// to discuss the admin report needs before developing further, now that the template is in place.
//there is a specific submit button for each section and no other areas will be submit except for the one selected.

if (isset($_POST['submitForAddRemove'])) {

	require_once('mysqli_connect.php');
	// Trim all the incoming data:
	//array_map() returns an array containing all the elements of an
	//array, $_POST, after applying the callback function (trim) to each one
	$trimmed = array_map('trim', $_POST);

	$SID = $TID = $Sfname = $Slname = $Tfname = $Tlname = $selectorNotEmpty = FALSE;

	if ($trimmed['add_remove'] == 'Add') {
		// Assume invalid values:
			$selectorNotEmpty = mysqli_real_escape_string($dbConnection, $trimmed['add_remove']);

		if ($trimmed['childNames']) {
			//get ID's
			$Sfname = mysqli_real_escape_string($dbConnection, explode(" ", $trimmed['childNames'])[0]);

			$Slname = mysqli_real_escape_string($dbConnection, explode(" ", $trimmed['childNames'])[1]);

			$SIDquery = $dbConnection->query("Select distinct SID from Student where fname = '$Sfname' and lname = '$Slname';");

			$queryArray = mysqli_fetch_array($SIDquery);

			$SID = $queryArray['SID'];

		}

		if ($trimmed['teacherNames']) {
			$Tfname = mysqli_real_escape_string($dbConnection, explode(" ", $trimmed['teacherNames'])[0]);

			$Tlname = mysqli_real_escape_string($dbConnection, explode(" ", $trimmed['teacherNames'])[1]);

			$TIDquery = $dbConnection->query("Select distinct TID from Teacher where fname = '$Tfname' and lname = '$Tlname';");

			$queryArray = mysqli_fetch_array($TIDquery);

			$TID = $queryArray['TID'];


		}


		if ($SID && $TID && $selectorNotEmpty) { // If everything's OK.


			//check if same program
			$checkTeachProg_query = $dbConnection->query("SELECT Teacher.progID as teacherProg, Student.progID as studentProg FROM Student, Teacher Where TID='$TID' AND SID='$SID';");

			$progIDArray = mysqli_fetch_array($checkTeachProg_query);

			$Tprog = $progIDArray['teacherProg'];
			$Sprog = $progIDArray['studentProg'];

			//if same program the add to class

			if ($Tprog == $Sprog) {

				$addClass = "INSERT INTO Class (teacher, student) VALUES ('$TID','$SID')";


				$bool = true;
				if (!($result = $dbConnection->query($addClass))) {
					trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
					$bool = false;
				}


				if ($bool) { // If it ran OK.
					$successful = 'Student has been added to class Successfully.';
					echo "<script type='text/javascript'>alert('$successful');</script>";

					//$dbConnection->close();
					//session_start();
					require('admin.php');
					//ob_end_clean(); // Delete the buffer.
					exit(); // Quit the script.

				}

			} else { // If it did not run OK.
				$unsuccessfulprog = 'Student and teacher are not in same Program!';
				echo "<script type='text/javascript'>alert('$unsuccessfulprog');</script>";

				//$dbConnection->close();
				//session_start();
				require('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}

		} else { // If it did not run OK.
			$unsuccessful = 'Must choose Child and Teacher to pair';
			echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

			//$dbConnection->close();
			//session_start();
			require('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.
		}


	}elseif ($trimmed['add_remove'] == 'Remove') {

		$selectorNotEmpty = mysqli_real_escape_string($dbConnection, $trimmed['add_remove']);

		if ($trimmed['childNames']) {
			//get ID's
			$Sfname = mysqli_real_escape_string($dbConnection, explode(" ", $trimmed['childNames'])[0]);

			$Slname = mysqli_real_escape_string($dbConnection, explode(" ", $trimmed['childNames'])[1]);

			$SIDquery = $dbConnection->query("Select distinct SID from Student where fname = '$Sfname' and lname = '$Slname';");

			$queryArray = mysqli_fetch_array($SIDquery);

			$SID = $queryArray['SID'];

		}

		if ($trimmed['teacherNames']) {
			$Tfname = mysqli_real_escape_string($dbConnection, explode(" ", $trimmed['teacherNames'])[0]);

			$Tlname = mysqli_real_escape_string($dbConnection, explode(" ", $trimmed['teacherNames'])[1]);

			$TIDquery = $dbConnection->query("Select distinct TID from Teacher where fname = '$Tfname' and lname = '$Tlname';");

			$queryArray = mysqli_fetch_array($TIDquery);

			$TID = $queryArray['TID'];


		}


		if ($SID && $TID && $selectorNotEmpty) { // If everything's OK.


			$deleteClass = "DELETE FROM Class WHERE teacher='$TID' AND student='$SID'";


			$bool = true;
			if (!($result = $dbConnection->query($addClass))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Student has been removed from class Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				//session_start();
				require('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.

			} else {
				$noClass = 'Student was not in this class.';
				echo "<script type='text/javascript'>alert('$noClass');</script>";

				//$dbConnection->close();
				//session_start();
				require('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}

		} else { // If it did not run OK.
			$unsuccessful = 'Must choose Child and Teacher to pair';
			echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

			//$dbConnection->close();
			//session_start();
			require('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.
		}


	}else{
		$unsuccessful = 'Must choose to ADD/REMOVE to perform this action';
		echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

		//$dbConnection->close();
		//session_start();
		require('admin.php');
		//ob_end_clean(); // Delete the buffer.
		exit(); // Quit the script.
	}

}

if (isset($_POST['submitSearch'])) {

	require_once('mysqli_connect.php');
	// Trim all the incoming data:
	//array_map() returns an array containing all the elements of an
	//array, $_POST, after applying the callback function (trim) to each one
	$trimmed = array_map('trim', $_POST);

	$ID = $id = $searchTable = $fname = $lname = FALSE;


	if ($trimmed['nameSearch']) {
		//get ID's
		$fname = mysqli_real_escape_string($dbConnection, explode(" ", $trimmed['nameSearch'])[0]);

		$lname = mysqli_real_escape_string($dbConnection, explode(" ", $trimmed['nameSearch'])[1]);


	}


	if ($trimmed['table']) {

		$searchTable = mysqli_real_escape_string($dbConnection, $trimmed['table']);
	}


	if ($lname && $fname && $searchTable) { // If everything's OK.

		switch ($searchTable) {
			case "Student":
				$id = "SID";
				break;
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


		$IDquery = "SELECT $id as 'thisID' FROM $searchTable where fname = '$fname' and lname = '$lname'";


		//if same program the add to class
		$bool = true;
		if (!($result = $dbConnection->query($IDquery))) {
			trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
			$bool = false;
		}


		if ($bool) { // If it ran OK.

			$row = mysqli_fetch_array($result);
			$ID = $row['thisID'];

			$successfulSearch = "This ID is: $ID";
			echo "<script type='text/javascript'>alert('$successfulSearch');</script>";

			//$dbConnection->close();
			//session_start();
			require('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.

		} else { // If it did not run OK.
			$unsuccessfulSearch = 'This name does not exist in the table!';
			echo "<script type='text/javascript'>alert('$unsuccessfulSearch');</script>";

			//$dbConnection->close();
			//session_start();
			require('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.
		}


	} else { // If it did not run OK.
		$unsuccessful = 'Must select group and provide name';
		echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

		//$dbConnection->close();
		//session_start();
		require('admin.php');
		//ob_end_clean(); // Delete the buffer.
		exit(); // Quit the script.
	}

}

if (isset($_POST['submitReports'])) {

	require_once('mysqli_connect.php');
	// Trim all the incoming data:
	//array_map() returns an array containing all the elements of an
	//array, $_POST, after applying the callback function (trim) to each one
	$trimmed = array_map('trim', $_POST);

	$reportType = false;

	if ($trimmed['reports']) {

		$reportType = mysqli_real_escape_string($dbConnection, $trimmed['reports']);
	}

	if ($reportType) {

		if ($reportType == 'Roster') {

			echo "----------------------------------------Roster Report----------------------------------------"."<br><br>";

			$teacherQuery = "SELECT DISTINCT teacher FROM Class";


			$bool = true;
			if (!($result = $dbConnection->query($teacherQuery))) {

				$bool = false;

			}

			if ($bool) { // If it ran OK.


				while ($row = mysqli_fetch_array($result)) {

					$teacher = $row['teacher'];

					$teacherQuery2 = $dbConnection->query("SELECT CONCAT(fname, ' ', lname) as 'name' FROM Teacher WHERE TID='$teacher';");
					$teacherQueryArray = mysqli_fetch_array($teacherQuery2);
					$Tname = $teacherQueryArray['name'];


					echo "Teacher: " . "$Tname" . "<br><br>" . "Students:" . "<br>";

						$studentQuery = "SELECT student FROM Class WHERE teacher='$teacher'";
						$studentCountQuery = "SELECT COUNT(student) as 'total' FROM Class WHERE teacher='$teacher'";

						$boolINNER = true;

						if (!($resultINNER = $dbConnection->query($studentQuery))) {

							$boolINNER = false;
							echo "No Students";
						}
						if (!($resultINNER2 = $dbConnection->query($studentCountQuery))) {
							$boolINNER = false;

						}
						if ($bool) { // If it ran OK.
							while ($rowINNER = mysqli_fetch_array($resultINNER)) {

								$student = $rowINNER['student'];

								$studentQuery2 = $dbConnection->query("SELECT CONCAT(fname, ' ', lname) as 'Sname' FROM Student WHERE SID='$student';");
								$studentQueryArray = mysqli_fetch_array($studentQuery2);
								$Tname = $studentQueryArray['Sname'];

								echo "$Tname" . "<br>";
							}

						}
						$rowINNER2 = mysqli_fetch_array($resultINNER2);
						$total = $rowINNER2['total'];
						echo "Total Students: "."$total"."<br><br>";
				}


			}


			echo "------------------------------Here is the Report you requested-----------------------------" . "<br><br>";

			echo "<a href=\"admin.php\">Return to Admin</a>";
		} elseif ($reportType == 'Program') {

		} elseif ($reportType == 'Other') {

		} else {
			$unsuccessful = 'Must select some report to complete this action1';
			echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

			//$dbConnection->close();
			//session_start();
			require('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.

		}

	} else {
		$unsuccessful = 'Must select some report to complete this action2';
		echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

		//$dbConnection->close();
		//session_start();
		require('admin.php');
		//ob_end_clean(); // Delete the buffer.
		exit(); // Quit the script.
	}
}
?>