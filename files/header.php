<?php



// Start output buffering:
ob_start();


// Check for a $page_title value:
if (!isset($page_title)) {
	$page_title = 'Bona Vista';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8">



<link rel="stylesheet" type="text/css" href="css/style.css">
<script language="JavaScript" src="JS/calender.js"></script>
</head>
<body>
<div id="logo">
	<header>
		<h1>&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;<a href = "index.php"><img src = "images/lettering3.PNG" alt = "lettering" width = "600" height = "120"></a>
			
				<a href="logout.php" title="Logout" onclick="return confirm('Are you sure you want to logout?');">Logout</a>

			<!--<a href="logout.php" title="Logout" onclick="return confirm('Are you sure you want to logout?');">Logout</a>
            <img src = "images/logo.jpg" alt = "Logo" width = "200" height = "105">--></h1>
	</header>
</div>
<div id="wrapper">
  <div id="container">
