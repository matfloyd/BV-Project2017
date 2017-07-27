<!-- End of Content -->

<?php 
// If the user is logged-in, show logout in the menu and change password links
if (isset($_SESSION['userdata']['user_name'])) {

	echo '<a href="admin.php" title="Return">Return</a>
';

	//If user access level = 1 as it is stored in the session then it is administrator:

	
} else { //  Not logged in.

	echo '<a href="admin.php" title="Password Retrieval">Return</a><br />
';

}
?>



  </div>
</div>
</body>
</html>

<?php // Flush the buffered output.
ob_end_flush();
?>
