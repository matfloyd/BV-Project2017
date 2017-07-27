<?php

//http://www.tutorialrepublic.com/php-tutorial/php-mysql-insert-query.php

// Create connection
require ('mysqli_connect.php');

//$teacher = 'Mos4561';
$child = 9876541;
$therCheckList = 'Yes';
$medCheckList = 1;
$feedingLOG = 1;

//SQL Insertion

$sql = "INSERT INTO TForm (teacher, child, date, dayQuality, grossMotor, activities, circleTime, fineMotor, timeSlept, qualitySlept,
 enjoyedComm, artComm, specialComm, otherComm, snackAM, breakfast, lunch, snackPM, bottleNotes, feedingLOG, restroomComm, medicine, mood, physThrpTime, occThrpTime, spchThrpTime, therapyNotes, therpName, IEP)
VALUES ('Mos4561', $child, CURDATE(), 'good', 'wrasslin', 'pushups', 'funny stories', 'thumb twiddlin', '10:00am-11:00am', 'poor',
 'nothing', 'conquering Germany', 'special', 'none', 'red bull', 'orange juice', 'carrots', 'beans', 'half bottle', 1, 'needs additional pylons', 1, 'acceptable', '555', '556', '557', 'progressing well', 'Bill Nye', '1');";
 
 
if ($feedingLOG = 1) {
	$sqlFL = "INSERT INTO FeedingLog (child, date, times, foods, amounts, provider)
	VALUES ($child, CURDATE(), '10:00 am', 'NaCl', '1 OZ', 'Provider');";
 }
 
if ($medCheckList = 1) {
	$sqlCL = "INSERT INTO Medicine (student, date, time, description)
	VALUES ($child, CURDATE(), NULL, '250mg advil');";
}

if ($dbConnection->query($sql) === TRUE) {
    echo "Orginal TForm entry created successfully in DB ";
} else {
    echo "DB Error: " . $sql . "<br>" . $dbConnection->error;
}

if ($dbConnection->query($sqlFL) === TRUE) {
    echo "FeedingLog entry created successfully in DB ";
} else {
    echo "DB Error: " . $sql . "<br>" . $dbConnection->error;
}

if ($dbConnection->query($sqlCL) === TRUE) {
    echo "Medicine entry created successfully in DB ";
} else {
    echo "DB Error: " . $sql . "<br>" . $dbConnection->error;
}

$dbConnection->close();
?>