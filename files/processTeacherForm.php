<?php

// Create connection


require ('mysqli_connect.php');
session_start();
$userID = $_SESSION['user'];
date_default_timezone_set('UTC');

//transform child form control input from string into an array
//Create seperate strings from exploded array input
$childExp = mysqli_real_escape_string($dbConnection, $_POST['child']);

list($fname, $lname) = explode(" ", $childExp);
trim($fname);
trim($lname);

//create variable to store SQL query in
$childQuery = "SELECT distinct SID FROM Student WHERE Student.fname = '$fname' AND Student.lname = '$lname'"; 

//execute query and set equal to $child
//$child = 9876541; /* 
$childObj = $dbConnection->query($childQuery);
$childArr = mysqli_fetch_array($childObj);
$child = implode(" ", $childArr);

$date = date("Y-m-d"); /* $dbConnection->real_escape_string($_POST['date']); */
$dayQuality = $dbConnection->real_escape_string($_POST['dayQuality']);

//check to see if form control exists and then grab values from control input and loop to store in array 
//who thought this was an acceptable way to process multiple checkbox values? WHO!?!?
//use implode() to add seperating character between values and convert array to string
if (!empty($_POST['grossMotor'])) {
	$grossMotor = $_POST['grossMotor'];  
	$cGrossMotor = count($grossMotor);
	for($i=0; $i < $cGrossMotor; $i++)
	{
	echo($grossMotor[$i] . " ");
	}
	$grossMotor = $dbConnection->real_escape_string(implode(",",$grossMotor));
} else {
	$grossMotor = NULL;
}


//activities array loop
if (!empty($_POST['activities'])) {
	$activities = $_POST['activities'];  
	$cActivities = count($activities);
	for($i=0; $i < $cActivities; $i++)
	{
	echo($activities[$i] . " ");
	}
	$activities = $dbConnection->real_escape_string(implode(",",$activities));
} else {
	$activities = NULL;
}


//circleTime array loop
if (!empty($_POST['circleTime'])) {
	$circleTime = $_POST['circleTime'];  
	$cCircleTime = count($circleTime);
	for($i=0; $i < $cCircleTime; $i++)
	{
	echo($circleTime[$i] . " ");
	}
	$circleTime = $dbConnection->real_escape_string(implode(",",$circleTime));
} else {
	$circleTime = NULL;
}


//fineMotor array loop
if (!empty($_POST['fineMotor'])) {
	$fineMotor = $_POST['fineMotor'];  
	$cFineMotor = count($fineMotor);
	for($i=0; $i < $cFineMotor; $i++)
	{
	echo($fineMotor[$i] . " ");
	}
	$fineMotor = $dbConnection->real_escape_string(implode(",",$fineMotor));
} else {
	$fineMotor = NULL;
}


//timeSlept array loop
if (!empty($_POST['timeSlept'])) {
	$timeSlept = $_POST['timeSlept'];  
	$cTimeSlept = count($timeSlept);
	for($i=0; $i < $cTimeSlept; $i++)
	{
	echo($timeSlept[$i] . " ");
	}
	$timeSlept = $dbConnection->real_escape_string(implode("-",$timeSlept));
} else {
	$timeSlept = NULL;
}


//pleb-style requests for things that aren't multi-value checkboxes
if (!empty($_POST['qualitySlept'])) {
$qualitySlept = $dbConnection->real_escape_string($_POST['qualitySlept']);
} else {
	$qualitySlept = NULL;
}

if (!empty($_POST['enjoyedComm'])) {
$enjoyedComm = $dbConnection->real_escape_string($_POST['enjoyedComm']);
} else {
	$enjoyedComm = NULL;
}

if (!empty($_POST['artComm'])) {
$artComm = $dbConnection->real_escape_string($_POST['artComm']);
} else {
	$artComm = NULL;
}

if (!empty($_POST['specialComm'])) {
$specialComm = $dbConnection->real_escape_string($_POST['specialComm']);
} else {
	$specialComm = NULL;
}

if (!empty($_POST['otherComm'])) {
$otherComm = $dbConnection->real_escape_string($_POST['otherComm']);
} else {
	$otherComm = NULL;
}

if (!empty($_POST['snackAM'])) {
$snackAM = $dbConnection->real_escape_string($_POST['snackAM']);
} else {
	$snackAM = NULL;
}

if (!empty($_POST['breakfast'])) {
$breakfast = $dbConnection->real_escape_string($_POST['breakfast']);
} else {
	$breakfast = NULL;
}

if (!empty($_POST['lunch'])) {
$lunch = $dbConnection->real_escape_string($_POST['lunch']);
} else {
	$lunch = NULL;
}

if (!empty($_POST['snackPM'])) {
$snackPM = $dbConnection->real_escape_string($_POST['snackPM']);
} else {
	$snackPM = NULL;
}

if (!empty($_POST['bottleNotes'])) {
$bottleNotes = $dbConnection->real_escape_string($_POST['bottleNotes']);
} else {
	$bottleNotes = NULL;
}

if (!empty($_POST['restroomComm'])) {
$restroomComm = $dbConnection->real_escape_string($_POST['restroomComm']);
} else {
	$restroomComm = NULL;
}

$mood = $dbConnection->real_escape_string($_POST['mood']);

//Therapy Var
if (!empty($_POST['physThrpTime'])) {
$physThrpTime = $dbConnection->real_escape_string($_POST['physThrpTime']);
} else {
	$physThrpTime = NULL;
}

if (!empty($_POST['occThrpTime'])) {
$occThrpTime = $dbConnection->real_escape_string($_POST['occThrpTime']);
} else {
	$occThrpTime = NULL;
}

if (!empty($_POST['spchThrpTime'])) {
$spchThrpTime = $dbConnection->real_escape_string($_POST['spchThrpTime']);
} else {
	$spchThrpTime = NULL;
}

if (!empty($_POST['therapyNotes'])) {
$therapyNotes = $dbConnection->real_escape_string($_POST['therapyNotes']);
} else {
	$therapyNotes = NULL;
}

if (!empty($_POST['therapistname'])) {
$therapistName = $dbConnection->real_escape_string($_POST['therapistname']);
} else {
	$therapistName = NULL;
}

//IEP Toggle
$IEP = $dbConnection->real_escape_string($_POST['iepGoal']);

//Therapy Toggle
$therCheckList = $dbConnection->real_escape_string($_POST['therCheckList']);

//FeedingLOG toggle
$feedingLOG = $dbConnection->real_escape_string($_POST['dailyFeedingToggle']);

//FeedingLog Table Var
if (!empty($_POST['times'])) {
$times = $dbConnection->real_escape_string($_POST['times']);
} else {
	$times = NULL;
}

if (!empty($_POST['foods'])) {
$foods = $dbConnection->real_escape_string($_POST['foods']);
} else {
	$foods = NULL;
}

if (!empty($_POST['amounts'])) {
$amounts = $dbConnection->real_escape_string($_POST['amounts']);
} else {
	$amounts = NULL;
}

if (!empty($_POST['provider'])) {
$provider = $dbConnection->real_escape_string($_POST['provider']);
} else {
	$provider = NULL;
}

//Medicine Table Var
if (!empty($_POST['eMed'])) {
$description = $dbConnection->real_escape_string($_POST['eMed']);
} else {
	$description = NULL;
}

//Medicine Toggle
$medicine = $dbConnection->real_escape_string($_POST['medCheckList']);

//SQL Insertion

$sql = "INSERT INTO TForm (teacher, child, date, dayQuality, grossMotor, activities, circleTime, fineMotor, timeSlept, qualitySlept,
 enjoyedComm, artComm, specialComm, otherComm, snackAM, breakfast, lunch, snackPM, bottleNotes, feedingLOG, restroomComm, medicine, mood, physThrpTime, occThrpTime, spchThrpTime, therapyNotes, therpName, IEP)
VALUES ('$userID', '$child', '$date', '$dayQuality', '$grossMotor', '$activities', '$circleTime', '$fineMotor', '$timeSlept', '$qualitySlept',
 '$enjoyedComm', '$artComm', '$specialComm', '$otherComm', '$snackAM', '$breakfast', '$lunch', '$snackPM', '$bottleNotes', $feedingLOG, '$restroomComm', $medicine, '$mood', '$physThrpTime', '$occThrpTime', '$spchThrpTime', '$therapyNotes', '$therapistName', $IEP);";
 
 
if (strcmp($feedingLOG,'1') == 0) {
	$sqlFL = "INSERT INTO FeedingLog (child, date, times, foods, amounts, provider)
	VALUES ('$child', '$date', '$times', '$foods', '$amounts', '$provider');";
	
	if ($dbConnection->query($sqlFL) === TRUE) {
		echo "FeedingLog entry created successfully in DB ";
	} else {
		echo "DB Error: " . $sql . "<br>" . $dbConnection->error;
	}	
}
 
if (strcmp($medicine,'1') == 0) {
	$sqlCL = "INSERT INTO Medicine (student, date, description)
	VALUES ('$child', '$date', '$description');";
	
	if ($dbConnection->query($sqlCL) === TRUE) {
		echo "Medicine entry created successfully in DB ";
	} else {
		echo "DB Error: " . $sql . "<br>" . $dbConnection->error;
	}
}

if ($dbConnection->query($sql) === TRUE) {
    echo "Orginal TForm entry created successfully in DB ";
	require ('teacherForm.php');
} else {
    echo "DB Error: " . $sql . "<br>" . $dbConnection->error;
}


$dbConnection->close();
exit();
?>