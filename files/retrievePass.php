<?php
// If the forgot pass a tag is triggered, the user is directed to this form with only one tab displaying.
//They must choose their entity type and provide thier ID in order to complete their password reset request.
//successful entry will execute the forgot pass file

require_once ('config.php');
$page_title = 'Forgot Main';
include ('header.php');

?>
 

	<section class="tabs" xmlns="http://www.w3.org/1999/html">

		<input id="tabOne" type="radio" name="radio" class="tabOneSelector" checked="checked"/>
		<?php if (isset($radio) && $radio=="forgotPass") require ('forgotPass.php')?>
		<span for="forgotPassTab">Forgot Password</span>
	
		<div class="overlap"></div>

		<div id="content">
			<div class="tabOneForm">
				<form  action="forgotPass.php" method="post">
					<p>
						<label for="login" class="login">Log in as:<br></label>

						<select class='field' id='entity' list="login" name="login" required="required"/>
						<option value="Parent">Parent</option>
						<option value="Teacher">Teacher</option>
						<option value="Admin">Admin</option>
						</select>
					</p>
					<p>
						<label for="email" class="uname"> Your username </label> <br>
						<input class="field" name="userID"  type="text" placeholder="User ID"/>
					</p>


					<p class="keeplogin">
						<input type="submit" value="Submit" name="submit"/>

					</p>
				</form>
			</div>





		</div>
	</section>
<?php

include ('footer.php');

?>