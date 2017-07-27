<?php
// This is the registration page for the site, which uses a sticky form
//group 1

$page_title = 'Registeration Main';
include ("header.php");


?>

    <section class="tabs" xmlns="http://www.w3.org/1999/xhtml">

        <input id="tabOne" type="radio" name="radio" class="tabOneSelector" checked="checked" />
        <?php if (isset($radio) && $radio=="changePass") require ('changePass.php')?>
        <span for="tabOne">Teacher</span>

        <input id="tabTwo" type="radio" name="radio" class="tabTwoSelector" />
        <?php if (isset($radio) && $radio=="Check Value") require ('calculateValue.php')?>
        <span for="tabTwo">Report</span>

        <input id="tabThree" type="radio" name="radio" class="tabThreeSelector" />
        <?php if (isset($radio) && $radio=="forgotPass") require ('calculateValue.php')?>
        <span for="tabThree">Gallery</span>

        <input id="tabFour" type="radio" name="radio" class="tabFourSelector" />
        <?php if (isset($radio) && $radio=="Check Value") require ('Tmessages.php')?>
        <span for="tabFour">Bulletin</span>


        <div class="overlap"></div>

        <div id="content">
            <div class="tabOneForm">
				<fieldset>
					<form action="processTeacherForm.php" method="post">
						<fieldset>
							<legend>Child Form</legend>
							<fieldset>
								<legend> Child Name: </legend>
								<script>
								function showParData(str) {
									if (str == "") {
										document.getElementById("child").value = "";
										document.getElementById("altPhone").value = "";
										document.getElementById("foodTimeType").value = "";
										document.getElementById("medicineDescription").value = "";
										document.getElementById("parMedCheck").value = "";
										document.getElementById("parComments").innerHTML = "";
										return;
									} else { 
										if (window.XMLHttpRequest) {
											//IE7+, Firefox, Chrome, Opera, Safari
											xmlhttp = new XMLHttpRequest();
										} else {
											//IE6, IE5
											xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
										}
										xmlhttp.onreadystatechange = function() {
											if (this.readyState == 4 && this.status == 200) {
												var chunk = xmlhttp.responseText.split('|')
												document.getElementById("altPhone").value = chunk[0];
												document.getElementById("foodTimeType").value = chunk[1];
												document.getElementById("medicineDescription").value = chunk[2];
												document.getElementById("parMedCheck").value = chunk[3];
												document.getElementById("parComments").innerHTML = chunk[4];
											}
										};
										xmlhttp.open("GET","fetchPFormInfo.php?q="+str,true);
										xmlhttp.send();
									}
								}
								</script>
								<!-- <select  class = "field" name="studentList">
								<option value = "Johhnny Appleseed"> Johhny Appleseed
								</option> -->
								<select class = "field" name="child" id="child" onchange="showParData(this.value)">
								<option value = ""></option>
								<?php 
								require ("mysqli_connect.php");
								$query = $dbConnection->query("Select Concat(Student.fname, ' ', Student.lname) as 'name' from Student, Teacher, Class
								Where Teacher.TID='$userID' AND Class.teacher=Teacher.TID AND Student.SID=Class.student;"); // Run your query
								while ($row = mysqli_fetch_array($query)) {
									echo "<option value='" . $row['name'] ."'>" . $row['name'] ."</option>";
								}
								echo "</select>";
								?>
								</select>
							</fieldset>
							<fieldset>
								<label for="date" class="date">Select a date:   </label>
								<input type="button" value = "YYYY-MM-DD" name="date" id="teachDate" />
								<script type="text/javascript">
								calendar.set("teachDate");
								</script>
							</fieldset>	
							<fieldset>	
								<legend>Quality of Day: </legend>
								<select id="dayQuality" name="dayQuality" required="required" class = "field" style="float:left"/>
									<option value="Good"> Good </option>
									<option value="Ok"> Ok </option>
									<option value="Some Difficulty"> Some Difficulty </option>
								</select>
								<br>
								<br>
								<label style="float:left">My mood is:<br></label>
								<br>
								<select id="entity" name="mood" required="required" style="float:left" onchange = "moodFunction();"/>
									<option value="Good"> Good </option>
									<option value="Ok"> Ok </option>
									<option value="Sad"> Sad </option>
									<option value="Upset"> Upset </option>
									<option value="Other"> Other </option>
								</select>
								<br>
								<br>
							</fieldset>
							<fieldset>
								<legend>Gross Motor Time: <br></legend>
								<input id="checkbox-4" type="checkbox" name="grossMotor[]" class="grossMotor" value="gym" />
								<label>Gym</label>
								<input id="checkbox-5" type="checkbox" name="grossMotor[]" class="grossMotor" value="playground"/>
								<label>Playground</label>
							</fieldset>
							<fieldset>
								<legend>Today's Centers: <br></legend>
								<input type = "checkbox" name = "activities[]" value = "literacy" />
								<label>Literacy-Writing Center</label>
								<br>
								<input type = "checkbox" name = "activities[]" value = "books" />
								<label>Books</label>
								<br>
								<input type = "checkbox" name = "activities[]" value = "toys" />
								<label>Table Toys</label>
								<br>
								<input type = "checkbox" name = "activities[]" value = "blocks" />
								<label>Blocks</label>
								<br>
								<input type = "checkbox" name = "activities[]" value = "art" />
								<label>Art</label>
								<br>
								<input type = "checkbox" name = "activities[]" value = "sciences" />
								<label>Sciences / Sensory</label>
								<br>
								<input type = "checkbox" name = "activities[]" value = "housekeeping" />
								<label>Housekeeping</label>
								
							</fieldset>
							<fieldset>
								<legend>Circle Time: <br></legend>
								<input type = "checkbox" name = "circleTime[]" value = "story" />
								<label>Listened to a story</label>
								<br>
								<input type = "checkbox" name = "circleTime[]" value = "songs" />
								<label>Sang circle time songs</label>
								<br>
								<input type = "checkbox" name = "circleTime[]" value = "songs2" />
								<label>Sang a song or did finger play</label>
								<br>
								<input type = "checkbox" name = "circleTime[]" value = "vocab" />
								<label>Worked on vocabulary or another concept</label>
							</fieldset>
							<fieldset>
								<legend>Fine Motor Activities: <br></legend>
								<input type = "checkbox" name = "fineMotor[]" value = "coloring" />
								<label>Coloring</label>
								<br>
								<input type = "checkbox" name = "fineMotor[]" value = "cutting" />
								<label>Cutting</label>
								<br>
								<input type = "checkbox" name = "fineMotor[]" value = "lacing" />
								<label>Lacing</label>
								<br>
								<input type = "checkbox" name = "fineMotor[]" value = "writing" />
								<label>Writing</label>
								
							</fieldset>
							<fieldset>
								<legend> Nap Time </legend>
								<label style="float:left">From:</label>
								<input list="hours" name="timeSlept[]" pattern="\d{1,2}:\d{2}([ap]m)?" style="float:right"/>
								<datalist id="hours">
									<option value="">
									<option value="12:00pm">
									<option value="12:15pm">
									<option value="12:30pm">
									<option value="12:45pm">
									<option value="1:00pm">
									<option value="1:15pm">
									<option value="1:30pm">
									<option value="1:45pm">
									<option value="2:00pm">
									<option value="2:15pm">
									<option value="2:30pm">
									<option value="2:45pm">
									<option value="3:00pm">
									<option value="3:15pm">
									<option value="3:30pm">



								</datalist>
								<br>
								<br>
								<label style="float:left">To:</label>
								<input list="hours2" name="timeSlept[]" pattern="\d{1,2}:\d{2}([ap]m)?" style="float:right"/>
								<datalist id="hours2">
									<option value="">
									<option value="12:15pm">
									<option value="12:30pm">
									<option value="12:45pm">
									<option value="1:00pm">
									<option value="1:15pm">
									<option value="1:30pm">
									<option value="1:45pm">
									<option value="2:00pm">
									<option value="2:15pm">
									<option value="2:30pm">
									<option value="2:45pm">
									<option value="3:00pm">
									<option value="3:15pm">
									<option value="3:30pm">
									<option value="3:45pm">
									<option value="4:00pm">
									<option value="4:15pm">
									<option value="4:30pm">

								</datalist>
								<br>
								<br>
								<label style="float:left">How did I sleep?</label>
								<select id="quality" name="qualitySlept" style= "float:right"/>
									<option value="Well">Well </option>
									<option value="Longer than normal">Longer than normal</option>
									<option value="Less than normal">Less than normal</option>
									<option value="Did not sleep">Did not sleep</option>
								</select>
								
							</fieldset>
							<fieldset>
								<legend>Notes:</legend>
								<label style="float:left">I enjoyed:</label>
								<input class="field" name="enjoyedComm" style="float:right" type="text" placeholder="" />
								<br>
								<label style="float:left">In art I:</label>
								<input class="field" name="artComm" style="float:right" type="text" placeholder="" />
								<br>
								<label style="float:left">Special:</label>
								<input class="field" name="specialComm" style="float:right" type="text" placeholder="" />
								<br>
								<label style="float:left">Comments:</label>
								<input class="field" name="otherComm" style="float:right" type="text" placeholder="" />
							</fieldset>
							<fieldset>
							<legend> Meals and Snacks: </legend>
								<label>Early Snack:</label>
								<input class="field" name="snackAM" style="float:right" type="text" placeholder="" />
								<br>
								<label>Breakfast:</label>
								<input class="field" name="breakfast" style="float:right" type="text" placeholder="" />
								<br>
								<label>Lunch:</label>
								<input class="field" name="lunch" style="float:right" type="text" placeholder="" />
								<br>
								<label>Late snack:</label>
								<input class="field" name="snackPM" style="float:right" type="text" placeholder="" />	
								<br>
								<label style="float:left">Bottle Notes:</label>
								<br>
								<textarea rows="4" cols="50" name="bottleNotes" placeholder="Enter bottle notes here..." ></textarea>
								</fieldset>	
							<fieldset>
							<legend> Daily Feeding Log: </legend>
								<script>
									function feedingFunction() {
										if (document.getElementById('dailyFeedingToggle').value == '1') {
											document.getElementById('times').style.display = "block";
											document.getElementById('foods').style.display = "block";
											document.getElementById('amounts').style.display = "block";
											document.getElementById('provider').style.display = "block";
											document.getElementById('eFeedTimeLabel').style.display = "block";
											document.getElementById('eFeedItemLabel').style.display = "block";
											document.getElementById('eFeedAmountLabel').style.display = "block";
											document.getElementById('eFeedProviderLabel').style.display = "block";
											

										}
										if (document.getElementById('dailyFeedingToggle').value != '1') {
											document.getElementById('times').style.display = "none";
											document.getElementById('foods').style.display = "none";
											document.getElementById('amounts').style.display = "none";
											document.getElementById('provider').style.display = "none";
											document.getElementById('eFeedTimeLabel').style.display = "none";
											document.getElementById('eFeedItemLabel').style.display = "none";
											document.getElementById('eFeedAmountLabel').style.display = "none";
											document.getElementById('eFeedProviderLabel').style.display = "none";

										}
									}
								</script>						
								<select id="dailyFeedingToggle" name="dailyFeedingToggle" required="required" style="float:left" onchange = "feedingFunction();"/>
									<option value="0"> No </option>
									<option value="1"> Yes </option>
								</select>
								<br>
								<label name = "eFeedTimeLabel" id = "eFeedTimeLabel" style = "display: none">Time(s):</label>
								<input class="field" style="display: none" name="times" id="times" type="text" placeholder="times seperated by comma"/>
								<br>
								<label name = "eFeedItemLabel" id = "eFeedItemLabel" style = "display: none">Item(s):</label>
								<input class="field" name="foods" id="foods" type="text" style="display: none" placeholder="food 1, food 2, etc"/>
								<br>
								<label name = "eFeedAmountLabel" id = "eFeedAmountLabel" style = "display: none">Amount(oz):</label>
								<input class="field" name="amounts" id="amounts" type="text" style="display: none" placeholder="6oz, 10oz, etc"/>
								<br>
								<label name = "eFeedProviderLabel" id = "eFeedProviderLabel" style = "display: none">Feeding Provider:</label>
								<select class = "field" name="provider" id="provider" style = "display: none">
								<?php 
								require ("mysqli_connect.php");
								$query = $dbConnection->query("Select Concat(Teacher.fname, ' ', Teacher.lname) as 'name' from Teacher;"); // Run your query
								while ($row = mysqli_fetch_array($query)) {
									echo "<option value='" . $row['name'] ."'>" . $row['name'] ."</option>";
								}
								echo "</select>";
								?>
								</select>
							</fieldset>
							<fieldset>
								<legend>Bathroom Notes: </legend>
								<script>
									function bathroomCheckFunction() {
										if (document.getElementById('bathroomCheckList').value == '1') {
											document.getElementById('restroomComm').style.display = "block";
										}
										if (document.getElementById('bathroomCheckList').value != '1') {
											document.getElementById('restroomComm').style.display = "none";

										}
									}
								</script>
								<select name="bathroomCheckList" id="bathroomCheckList" required="required" onchange = "bathroomCheckFunction();"/>
									<option value="0"> No </option>
									<option value="1"> Yes </option>
								</select>	
								<br>
								<br>
								<textarea rows="4" cols="50" name="restroomComm" id="restroomComm" placeholder="Enter bathroom notes here..." style="display: none"></textarea>
							</fieldset>
							<fieldset>
								<legend>Medication: </legend>
								<script>
									function medCheckFunction() {
										if (document.getElementById('medCheckList').value == '1') {
											document.getElementById('eMed').style.display = "block";
										}
										if (document.getElementById('medCheckList').value != '1') {
											document.getElementById('eMed').style.display = "none";
										}
									}
								</script>
								<select id="medCheckList" name="medCheckList" required="required" style="float:left" onchange = "medCheckFunction();"/>
									<option value="0"> No </option>
									<option value="1"> Yes </option>
								</select>
								<br>
								<br>
								<textarea rows="4" cols="50" name="eMed" type="text" placeholder="Medication info...." id="eMed" style="display: none"></textarea>
							</fieldset>
							<fieldset>
							<legend>Therapy: <br></legend>
								<script>
									function therCheckFunction() {
										if (document.getElementById('therCheckList').value == 'Yes') {                                   
											document.getElementById('physTherLabel').style.display = "block";
											document.getElementById('physThrpTime').style.display = "block";									
											document.getElementById('occTherLabel').style.display = "block";
											document.getElementById('occThrpTime').style.display = "block";									
											document.getElementById('spchTherLabel').style.display = "block";
											document.getElementById('spchThrpTime').style.display = "block";
											document.getElementById('therapyNotes').style.display = "block";
											document.getElementById('therNoteNameLabel').style.display = "block";
											document.getElementById('therapistname').style.display = "block";
											document.getElementById('therNoteLabel').style.display = "block";
											
										}
										if (document.getElementById('therCheckList').value != 'Yes') {                                   
											document.getElementById('physTherLabel').style.display = "none";
											document.getElementById('physThrpTime').style.display = "none";									
											document.getElementById('occTherLabel').style.display = "none";
											document.getElementById('occThrpTime').style.display = "none";									
											document.getElementById('spchTherLabel').style.display = "none";
											document.getElementById('spchThrpTime').style.display = "none";
											document.getElementById('therapyNotes').style.display = "none";
											document.getElementById('therNoteNameLabel').style.display = "none";
											document.getElementById('therapistname').style.display = "none";
											document.getElementById('therNoteLabel').style.display = "none";
										}
									}
								</script>
								<select id="therCheckList" name="therCheckList" required="required" style="float:left" onchange = "therCheckFunction();"/>
									<option value="No"> No </option>
									<option value="Yes"> Yes </option>
									<option value="Unknown"> Unknown </option>
								</select>
								<br>
								<label id="physTherLabel" style="display: none">Physical</label>
								<input class="field" name="physThrpTime" id="physThrpTime" type="number" step="5" min="0" placeholder="amount in min." maxlength="3" style="display: none" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
								<br>						
								<label id="occTherLabel" style="display: none">Occupational</label>
								<input class="field" name="occThrpTime" id="occThrpTime" type="number" step="5" min="0" placeholder="amount in min." maxlength="3" style="display: none" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
								<br>
								<label id="spchTherLabel" style="display: none">Speech</label>
								<input class="field" name="spchThrpTime" id="spchThrpTime" type="number" step="5" min="0" placeholder="amount in min." maxlength="3" style="display: none" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
								<br>
								<label id="therNoteLabel" style="display: none">Therapy Notes: </label>
								<textarea rows="4" cols="50" name="therapyNotes" id="therapyNotes" placeholder="Enter therapy notes here..." style="display: none"></textarea>
								<br>
								<label id="therNoteNameLabel" style="display: none"> Therapist's Name: </label>
								<input class="field" name="therapistname" id="therapistname" type="text" style="display: none" placeholder=""/>
							</fieldset>
							<fieldset>
							<legend>IEP: </legend>
								
								<label style="float:left">Goals checked: &nbsp;<br></label>
								<select id="iepGoal" name="iepGoal" style="float:left" />
									<option value="0"> No </option>
									<option value="1"> Yes </option>
								</select>
							</fieldset>
						</fieldset>
						<br>
						<input type="submit" value="Submit" name="submit"/>
						<input type="reset" value="Reset Form"/>
					</form>
			</fieldset>
            </div>
            <div class="tabTwoForm">
				<form  action="changePass.php" method="post">
				<fieldset disabled>
						
                       <h1> Family update form</h1>

                    <br>

                    <input class="field" name="PID" type="text" placeholder="Parent ID" id="pid" style="display: none"/>
		    <label for="where" class="name">Where can I be reached today:</label>

                    <input class="field" name="phone" type="text" id="altPhone"/>

                    
                    <br>

                    <label for="food" class="food">When/What did your child last eat?:</label>
                    <input class="field" name="foodTimeType" id="foodTimeType" type="text"/>

                    <br>
		 <label for="medicine" class="medicine">Has any medication been given today<br></label>

                        <input type="text" class="field" name="medicine" id="parMedCheck"/>
                        
			<br>
		<label for="medicine" class="medicine">If you answered yes, what medicine?</label>
                    <input class="field" name="medicine" id="medicineDescription" type="text"/>
					<br>
                <label for="comments" class="comments">Other important  notes: 
		<textarea rows="4" cols="50" id="parComments"></textarea>
		    <fieldset>
                        <a href="logout.php" title="Logout">Logout</a>
                    </fieldset>
                    <input type="submit" value="Submit" name="submit"/>

                    <input type="reset" value="Reset Form"/>
                    </fieldset>
		</fieldset>				
	           </form>
			</div>
            <div class="tabThreeForm">
                <form  action="changePass.php" method="post">
                <fieldset>
                    <img src="images/kids.jpeg" alt="" width="400" height="200"/>
                </fieldset>
                    <input type="file" accept="image/*" capture="camera">

                  <fieldset>
                    <input type="submit" value="Upload" name="Upload"/>
                      <input type="submit" value="Submit" name="Submit"/>
                    <!--<input type="reset" value="Reset Form"/>-->
                  </fieldset>
                </form>
            </div>
            <div class="tabFourForm">
                <form  action="Tmessages.php" method="post">


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

						$query = "Select message, ParID, Messages.timestamp from Messages Where DATE(Messages.timestamp)= CURRENT_DATE AND TID = '$userID' ORDER BY Messages.timestamp ASC"; // Run your query



						$bool = true;
						if (!($result = $dbConnection->query($query))) {
							echo "No Messages";
							$bool = false;

						}

						if ($bool) { // If it ran OK.



							while ($row = mysqli_fetch_array($result)) {

								$ParIDArray = mysqli_fetch_array($result);

								$Pname = $ParIDArray['ParID'];

								$Pnamequery = $dbConnection->query("Select Concat(fname, ' ', lname) as 'name' from Parent Where ParID='$Pname';");

								$PnameArray = mysqli_fetch_array($Pnamequery);

								$Pname = $PnameArray['name'];

								$msg = $row['message'];
								$TS = $row['timestamp'];
								echo "Pname: "."$Pname"."<br>"."$msg" . "<br>". "$TS" . "<br><br>";
							}

						}


						?>

						<br>

						<fieldset>
							<label> Which Child's Parent are you messaging?: </label>
							<br>
							<select id = "PID" class = "field" name="PID">
								<option value="">Please Select a child</option>
								<?php
								$query = $dbConnection->query("Select Concat(Student.fname, ' ', Student.lname) as 'name' from Student, Teacher, Class
								Where Teacher.TID='$userID' AND Class.teacher=Teacher.TID AND Student.SID=Class.student;"); // Run your query
								while ($row = mysqli_fetch_array($query)) {
									echo "<option value='" . $row['name'] ."'>" . $row['name'] ."</option>";
								}
								echo "</select>";
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
