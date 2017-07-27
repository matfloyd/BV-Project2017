<?php
// This is the registration page for the site, which uses a sticky form


$page_title = 'Registeration Main';
include ('header.php');



?>

<option selected disabled hidden style='display: none' value=''></option>

    <section class="tabs" xmlns="http://www.w3.org/1999/html">

        <input id="tabOne" type="radio" name="radio" class="tabOneSelector" checked="checked" />
        <?php if (isset($radio) && $radio=="Submit" ) require ('parentFormAdd.php')?>
        <span for="tabOne">Submit</span>

        <input id="tabTwo" type="radio" name="radio" class="tabTwoSelector" />
        <?php if (isset($radio) && $radio=="RequestReport") require ('report.php')?>
        <span for="tabTwo">Report</span>

        <input id="tabThree" type="radio" name="radio" class="tabThreeSelector" />
        <?php if (isset($radio) && $radio=="forgotPass") require ('.php')?>
        <span for="tabThree">Gallery</span>

        <input id="tabFour" type="radio" name="radio" class="tabFourSelector" />
        <?php if (isset($radio) && $radio=="Check Value") require ('Pmessages.php')?>
        <span for="tabFour">Bulletin</span>
		
	


        <div class="overlap"></div>

        <div id="content">
            <div class="tabOneForm">
				<fieldset>
					<form action="parentFormAdd.php" id="tabOneForm" method="post">
						<fieldset>               
							<h1> Family update form</h1>
							<script language="javascript">
							function checkInput(ob) {
							var invalidChars = /[^0-9]/gi
							if(invalidChars.test(ob.value)) {
								ob.value = ob.value.replace(invalidChars,"");
								}
							}
							</script>
							<fieldset>
								<label> Child Name: </label>					
								<br>					
								<select id = "name" class = "field" name="name">
								<option value="">Please Select a Student</option>
								<?php 
								$query = $dbConnection->query("Select Concat(fname, ' ', lname) as 'name' from Student
								Where Student.ParID='$userID';"); // Run your query
								while ($row = mysqli_fetch_array($query)) {
									echo "<option value='" . $row['name'] ."'>" . $row['name'] ."</option>";
								}
								?>
								</select>
							</fieldset>						
							<br>					
							<fieldset>
								<label for="phone" class="phone">Where can you be reached today?</label>			
								<br>					
								<input type="text" onkeyup="checkInput(this)" placeholder="xxx-xxx-xxxx" name="phoneNum"/>
							</fieldset>						
							<br>
							<fieldset>
								<label for="food" class="food">When/What did your child last eat?:</label>					
								<input class="field" id = "food" name="food" required="required" type="text" placeholder="7:30 AM, Cereal"/>
							</fieldset>						
							<br>						
							<fieldset>
								<label class="medicine">Has any medication been given today</label>						
								<br>                        
								<script>
								function medFunction() {
									if (document.getElementById('meds').value == 'YesMeds') {
										document.getElementById('medNotes').style.display = "block";
										document.getElementById('meds').style.display = "block";
									}
									if (document.getElementById('meds').value == 'NoMeds') {
										document.getElementById('medNotes').style.display = "none";
										}
								}
								</script>
								<select id="meds" name="meds" required="required" onchange = "medFunction();">
									<option value="NoMeds"> No</option>
									<option value="YesMeds"> Yes</option>
								</select>		
								<br>
								<label for="medicine" name = "medLabel" id = "medLabel" class="medicine" style = "display: none">What medicine? How much? What time?</label>
									<textarea rows="4" cols="50" class="field"  id = "medNotes" name="medicine" type="text" placeholder="Ex. Ibuprofen 10mg 7:30AM" style = "display: none"></textarea>
							</fieldset>					
							<br>					
							<fieldset>
								<label for="comments" class="comments">Other important teacher notes(any new bruises or bumps, symptoms, sleeping concerns,medication needed,challenges or changes since last day at EHS): </label>
								<textarea name = "notes" id = "notes" rows="4" cols="50" ></textarea>
							</fieldset>					
							<p>
							<a href="logout.php" title="Logout">Logout</a>
							</p>
						</fieldset>
						<input type="submit" value="Submit" name = "submit" id="submit" class="button"/>
						<input type="reset" value="Reset Form"/>								
					</form>
				</fieldset>
			</div>
			
			<div class="tabTwoForm">
				<form action="report.php" method="post" target="_blank">
				
					<label> Child Name: </label>					
						<br>					
						<select id = "name" class = "field" name="name">
						<option value="">Please Select a Student</option>
						<?php 
						$query = $dbConnection->query("Select Concat(fname, ' ', lname) as 'name' from Student
						Where Student.ParID='$userID';"); // Run your query
						while ($row = mysqli_fetch_array($query)) {
							echo "<option value='" . $row['name'] ."'>" . $row['name'] ."</option>";
						}
						?>
						</select>
					<br><br><br>
					<label for="date" class="date">Select a start date:</label>
					
					<input type="button" value = "start" name="date" id="date1" />
					
					<script type="text/javascript">
						$date=calendar.set("date1");
					</script>
					
					
					
					<br>
					
					<label for="date" class="date">Select a end date:   </label>
					<input type="button" value = "end" name="date" id="date2" />
					
					<script type="text/javascript">
						calendar.set("date2");
					</script>
					
                    <p>Select the report/s you would like to view: <br>
                        <input type = "checkbox" name = "chkLeather" value = "Today's Report" />
                        <label for = "chkLeather">Today's Report</label> <br>
                        <input type = "checkbox" name = "chkBluetooth" value = "Weekly Report" />
                        <label for = "chkBluetooth">Weekly Report</label> <br>
                        <input type = "checkbox" name = "chk4X4" value = "Monthly Report" />
                        <label for = "chk4X4">Monthly Report</label>
                    </p>
					
                    <!--<p>
					<label for="email" class="youmail"> Your email</label>
					<input class="field" name="email" required="required" type="email" placeholder="myemail@gmail.com" value="<?php// if (isset($trimmed['email'])) echo $trimmed['email']; ?>"/>
				  </p>
				  <p>
					<label class="labelCol" for="newpass">New Password</label>
					<input class="field" input type="password" name="password1" size="20" maxlength="20" required="required" placeholder="mypassword"/>
				  </p>
				  <p>
					<label class="labelCol" for="newpassc">Confirm New Password</label>
					<input class="field" input type="password" name="password2" size="20" maxlength="20" required="required" placeholder="mypassword"/>
				  </p>-->
                    <p>
                        <input type="submit" value="Request Report" name="RequestReport"/>
                        <!--<input type="reset" value="Reset Form"/>-->
                    </p>
                </form>
            </div>
			
            <div class="tabThreeForm">
                <form action="registration.php" method="post">
		<fieldset>

                 <p>
                    <img src="images/kids.jpeg" alt="" width="400" height="200"/>
                </p>

                      
							
                        <a href="logout.php" title="Logout">Logout</a>
    
		</fieldset>
                </form>
            </div>
            <div class="tabFourForm">
                <form action="Pmessages.php" method="post">

					Today's Announcement: <br><br>
					<?php
					require_once('mysqli_connect.php');

					$currentMessage = "Null";
					$query = "Select announcement from Announcements Where Announcements.date = CURRENT_DATE "; // Run your query

					$bool = true;
					if (!($result = $dbConnection->query($query))) {
						echo "No Announcements today";
						$bool = false;

					}
					if ($bool) { // If it ran OK.
						while ($row = mysqli_fetch_array($result)) {
							echo "<option value='" . $row['announcement'] ."'>" . $row['announcement'] ."</option>";
						}

					}


					?>
					<br><br>

					Message Board: <br><br>
					<?php
					require_once('mysqli_connect.php');

					$currentMessage = "Null";
					$query = "Select message, TID, Messages.timestamp from Messages Where DATE(Messages.timestamp)= CURRENT_DATE AND ParID = '$userID' ORDER BY Messages.timestamp ASC"; // Run your query

					$bool = true;
					if (!($result = $dbConnection->query($query))) {
						echo "No Messages";
						$bool = false;

					}
					if ($bool) { // If it ran OK.
						while ($row = mysqli_fetch_array($result)) {
							$msg = $row['message'];
							$TS = $row['timestamp'];
							echo "$msg" . "<br>". "$TS" . "<br><br>";
						}

					}


					?>
					<br>

					<fieldset>
						<label> Which Child's Teacher are you messaging?: </label>
						<br>
						<select id = "TID" class = "field" name="TID">
							<option value="">Please Select a child</option>
							<?php
							$query = $dbConnection->query("Select Concat(fname, ' ', lname) as 'name' from Student
								Where Student.ParID='$userID';"); // Run your query
							while ($row = mysqli_fetch_array($query)) {
								echo "<option value='" . $row['name'] ."'>" . $row['name'] ."</option>";
							}
							?>
						</select>
					</fieldset>

					<p>

                        <label for="bulletin" class="bulletin"> Enter Brief Message:</label>
                        <textarea name="messageArea" rows="4" cols="50" ></textarea>
                    </p>

					<p>
						<input type="submit" value="Send Message" name="submit"/>
						<!--<input type="reset" value="Reset Form"/>-->
					</p>

                </form>
            </div>

        </div>
    </section>
<?php

include ('footer.php');

?>