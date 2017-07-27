<?php
//This is the main landing page for the entire system. from here there are 4 tabs displayed with the login tab having focus.
//the user must have an account to access the system. if the user has forgotten the password it can be reset with temp password
//and emailed to them so they can make a new password. Second tab gives a brief description of the system. Third tab allows a potential user
// to contact the admin to get more info on setting up an account. The fourth tab allows the user to create a new password if they know their current password
//this is also where the user goes to reset password when they receive their temp from th e forgot pass action.
//In the even that user does exist in the system and logs in with valid information the user will be logged in to their account and a session will be started.

require_once ('config.php');
$page_title = 'Login Home';
include ('header.php');


?>


	<section class="tabs" xmlns="http://www.w3.org/1999/html">
		<input id="tabOne" type="radio" name="radio" class="tabOneSelector" checked="checked" />
		<?php if (isset($radio) && $radio=="login") require ('login.php')?>
		<span for="tabOne">Login Form</span>

		<input id="tabTwo" type="radio" name="radio" class="tabTwoSelector"  />
		<span for="tabTwo">About CSRS</span>

		<input id="tabThree" type="radio" name="radio" class="tabThreeSelector" />
		<?php if (isset($radio) && $radio=="contact") require ('contact.php')?>
		<span for="tabThree">Contact</span>

		<input id="tabFour" type="radio" name="radio" class="tabFourSelector" />
		<?php if (isset($radio) && $radio=="resetPass") require ('changePass.php')?>
		<span for="tabFour">Reset Pass</span>

		<div class="overlap"></div>
		
		<div id="content">
			<div class="tabOneForm">
				<form  action="login.php" method="post">
					<p>
						<label for="login" class="login">Log in as:<br></label>

						<select class='field' id='entity' list="login" name="login" required="required"/>
							<option value="Parent">Parent</option>
							<option value="Teacher">Teacher</option>
							<option value="Admin">Admin</option>
						</select>
					</p>
					<p>
						<label for="email" class="uname"> Your username </label><br>
						<input class="field" name="userID" required="required" type="text" placeholder="User ID"/>
					</p>

					<p>
						<label for="password" class="youpasswd"> Your password </label><br>
						<input class="field" name="password" required="required" type="password" placeholder="Your password" />
					</p>
					<p>
					<a href="retrievePass.php" title="retrievePass">Forgot Password?</a>
					</p>
					<p class="keeplogin">
						<input type="submit" value="Submit" name="submit"/>
						<input type="reset" value="Reset Form"/>
					</p>
				</form>
			</div>
			<div class="tabTwoForm">
				<form>

				  <p>
					<label>What is CSRS?</label><br><br>

					  The Bona Vista Child Services Reporting System, CSRS, is a web based application
					  created for the purpose of efficient and effective communication and reporting.<br><br>
					  Only Parents and Staff who are appropriately register may access the system.<br><br>
					  If you require access to this system please contact Bona Vista for assistance.
				  </p>

				</form>
			</div>

			<div class="tabThreeForm">
				<form  action="bulletin.php" method="post">
				  <p>
					<label> Please leave us a brief message:</label>
					  <textarea rows="4" cols="50" ></textarea>
				  </p>
					<p>
						<label>Or feel free to call or visit: </label>
						<br>
						<br>
						(765) 457-8273
						<br>
						<br>
						1220 E Laguna St, Kokomo, IN 46902

					</p>
				  <p class="signin button">

					<input type="reset" value="Send"/>
				  </p>
				</form>
			</div>

			<div class="tabFourForm">

					<form  action="changePass.php" method="post">
						<p>
							<label for="changeP" class="login">I am a:<br></label>

							<select class='field' id='changeP' list="changeP" name="changeP" required="required"/>
							<option value="Parent">Parent</option>
							<option value="Teacher">Teacher</option>
							<option value="Admin">Admin</option>
							</select>
						</p>

						<p>
							<label for="uID" class="uID"> Your user ID:</label> <br>
							<input class="field" name="uID" required="required" type="text" placeholder="User ID"
						</p>
						<p>
							<label for="uPass" class="uPass"> Current Password:</label> <br>
							<input class="field" name="uPass" required="required" type="password" placeholder="Current Password"
						</p>
						<p>
							<label for="newPass" class="newPass"> New Password:</label> <br>
							<input class="field" name="newPass" required="required" type="password" placeholder="New Password"
						</p>
						<p>
							<label for="confirmPass" class="confirmPass"> Confirm Password:</label> <br>
							<input class="field" name="confirmPass" required="required" type="password" placeholder="Confirm Password"

						</p>
						<p class="signin button">
							<input type="submit" value="Reset Password" name="submit"/>

						</p>
					</form>
            </div>

            </form>





		</div>
	</section>
<?php

include ('footer.php');

?>