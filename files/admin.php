<?php

//if(isset($_SESSION['user'])){
   $page_title = 'Registeration Main';
    include ('header.php');

   // echo($_SESSION['user']);
//}
//allow
//else{
   // header("Location: http://ko-turing.ads.iu.edu/~info451-02/index.php"); /* Redirect browser */
   // exit();

//}

//The above commented code is for preventing a user form accessing the pages directly throught the URL
//It is working but I was having issues with error messages during testing so I disabled it for the time being.
//
//This is the main form info for the administrators account. a logged in admin will be able to add entities to the database
// those are (parents, students/children, teachers/caregivers, and  other administrators) They may also post, delete, and edit announcements
//They will also add student to teachers classes. they can also do simple searching and request general reports.
//each of the forms are responsive. upon selection of the entity that the admin is working with the form will display the proper fields to
// fill so that all other fields will be hidden.
//




?>



    <section class="tabs" xmlns="http://www.w3.org/1999/html">

        <input id="tabOne" type="radio" name="radio" class="tabOneSelector" checked="checked" />
        <?php if (isset($radio) && $radio=="create") require ('adminCreate.php')?>
        <span for="tabOne">Add Form</span>

        <input id="tabTwo" type="radio" name="radio" class="tabTwoSelector" />
        <?php if (isset($radio) && $radio=="delete") require ('adminDelete.php')?>
        <span for="tabTwo">Del Form</span>

        <input id="tabThree" type="radio" name="radio" class="tabThreeSelector" />
        <?php if (isset($radio) && $radio=="update") require ('adminUpdate.php')?>
        <span for="tabThree">Edit Form</span>

        <input id="tabFour" type="radio" name="radio" class="tabFourSelector" />
        <?php if (isset($radio) && $radio=="Announcements") require ('adminAnnounce.php')?>
        <span for="tabFour">Notify</span>

        <input id="tabFive" type="radio" name="radio" class="tabFiveSelector" />
        <?php if (isset($radio) && $radio=="Other") require ('other.php')?>
        <span for="tabFive">Other</span>


        <div class="overlap"></div>

        <div id="content">
            <div class="tabOneForm">

                <form action="adminCreate.php" method="post">


                    <p>
                        New entities may be created here:

                        <br>
                        <br>
                    <fieldset>
                        <label for="entity" class="entity">Select entity to create:<br></label>

                        <script>
                            function selectFunction() {
                                if (document.getElementById('entity').value == 'Student') {
                                    document.getElementById('parent').style.display = "none";
                                    document.getElementById('email').style.display = "none";
                                    document.getElementById('program').style.display = "block";
                                    document.getElementById('student').style.display = "block";

                                }
                                if (document.getElementById('entity').value == 'Parent') {
                                    document.getElementById('student').style.display = "none";
                                    document.getElementById('program').style.display = "none";
                                    document.getElementById('email').style.display = "block";
                                    document.getElementById('parent').style.display = "block";
                                }
                                if (document.getElementById('entity').value == 'Teacher') {
                                    document.getElementById('student').style.display = "none";
                                    document.getElementById('parent').style.display = "none";
                                    document.getElementById('email').style.display = "none";
                                    document.getElementById('program').style.display = "block";
                                }
                                if (document.getElementById('entity').value == 'Admin') {
                                    document.getElementById('student').style.display = "none";
                                    document.getElementById('parent').style.display = "none";
                                    document.getElementById('email').style.display = "none";
                                    document.getElementById('program').style.display = "none";
                                }
                            }


                        </script>

                        <select class = "field" id = "entity" name="entity"  onload="selectFunction()" onchange="selectFunction();"/>
                            <option value="Student">Student</option>
                            <option value="Parent">Parent</option>
                            <option value="Teacher">Teacher</option>
                            <option value="Admin">Admin</option>
                        </select>

                    </fieldset>

                    </p>

                    <br>

                    <p>All fields Required:</p>

                    <br>
                    <fieldset>
                        <label for="name" class="name">Stu Name:</label>
                        <br>
                        <input class="field" name="fname"  type="text" placeholder="First Name"/>

                        <input class="field" name="lname"  type="text" placeholder="Last Name"/>



                    </fieldset>
                    <br>
                    <fieldset id="student" >

                        <label for="PID" >Parent ID:</label>
                    <input class="field" name="PID"  type="text" placeholder="Parent ID" id="pid" style="display: block"/>
                    <br>
                        <label for="date" class="date">Student Birth date:   </label>
                        <input type="text" value = "                " name="bdate" id="bdate" readonly="true" />

                        <script type="text/javascript">
                            calendar.set("bdate");
                        </script>

		
             
                        <br><br>
                    </fieldset>


                    <div id="loginScreen">
                        <a href="#" class="cancel">&times;</a>
                    </div>

                    <div id="cover" >

                    </div>

                    <fieldset id="program" style="display: block"  >

                        <label for="program" >Select entity to create:<br></label>
                        <select class = "field" id = "program" name="program"  "/>
                        <option value= 1 >Early Head Start</option>
                        <option value= 2 >Keys for Kids</option>
                        <option value= 3 >Child Care</option>
                        </select>

                    </fieldset>



                    <fieldset  id="email" style="display: none">
                    <label for="email" class="email">Email:</label>
                        <br>
                    <input class="field" name="email"  type="email" placeholder="you@yourMail.com"/>


                    </fieldset>

                    <fieldset id="parent" style="display: none">
                        <label for="phone" >Phone:</label>
                        <br>
                        <input class="field" name="phone" type="text" placeholder="555-555-5555" />

                    </fieldset>

                    <input type="submit" value="Submit" name="submit"/>

                    <input type="reset" value="Reset Form"/>
                    </p>

                </form>
            </div>



            <div class="tabTwoForm">
				<form  action="adminDelete.php" method="post">




                    <p>
                        Entities may be removed here:

                        <br>
                        <br>

                        <label for="entity" class="entity">Select entity to remove:<br></label>

                        <select class = "field" id = "entity" name="entity"/>
                        <option value="Student">Student</option>
                        <option value="Parent">Parent</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Admin">Admin</option>
                        </select>

                    </p>
                    <label for="name" class="name">ID of entity to be removed:</label>
                    <input class="field" name="removeID" required="required" type="text" placeholder="Entity ID"/>

				  </p>
                    <input type="submit" value="Submit" name="submit"/>
				</form>
			</div>


            <div class="tabThreeForm">
                <form action="adminUpdate.php" method="post">

                    <p>
                        Entities may be updated here:


                        <br>
                        <br>

                    <fieldset>
                        <label for="update" class="entity">Select entity to update:<br></label>

                        <script>
                            function selectFunctionUpdate(){
                                if(document.getElementById('update').value == 'Student'){
                                    document.getElementById('studentU').style.display = "block";
                                    document.getElementById('parentU').style.display = "none";
                                    document.getElementById('teacherU').style.display = "none";
                                    document.getElementById('adminU').style.display = "none";
                                }
                                if(document.getElementById('update').value == 'Parent'){
                                    document.getElementById('studentU').style.display = "none";
                                    document.getElementById('parentU').style.display = "block";
                                    document.getElementById('teacherU').style.display = "none";
                                    document.getElementById('adminU').style.display = "none";

                                }
                                if(document.getElementById('update').value == 'Teacher'){
                                    document.getElementById('studentU').style.display = "none";
                                    document.getElementById('parentU').style.display = "none";
                                    document.getElementById('teacherU').style.display = "block";
                                    document.getElementById('adminU').style.display = "none";

                                }
                                if(document.getElementById('update').value == 'Admin'){
                                    document.getElementById('studentU').style.display = "none";
                                    document.getElementById('parentU').style.display = "none";
                                    document.getElementById('teacherU').style.display = "none";
                                    document.getElementById('adminU').style.display = "block";

                                }
                            }
                        </script>

                        <select class = "field" id = "update" name="update"   onload="selectFunctionUpdate()" onchange="selectFunctionUpdate();""/>
                        <option value="Student">Student</option>
                        <option value="Parent">Parent</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Admin">Admin</option>
                        </select>

                    </fieldset>

                    </p>



                    <br>
                    <fieldset  >

                        <label for="ID" >ID of Entity to Update:</label>
                        <input class="field" name="ID"  type="text" placeholder="Enter ID" />
                        <br>

                        <br><br>
                    </fieldset  >


                    <fieldset id="studentU" style="display: block">
                        <p>For Students:</p>
                    <fieldset >
                        <label for="sname" class="sname">Name:</label><br>

                        <input class="field" name="slname"  type="text" placeholder="Last Name"/>



                    </fieldset>
                    <fieldset  >

                        <label for="program2" >Program: <br></label>
                        <select class = "field" id = "program2" name="program2"  />
                        <option value= "" ></option>
                        <option value= "Early Head Start" >Early Head Start</option>
                        <option value= "Keys for Kids" >Keys for Kids</option>
                        <option value= "Child Care" >Child Care</option>
                        </select>

                    </fieldset>
                    </fieldset>


                    <fieldset id="parentU" style="display: none">
                        <p>For Parents:</p>
                    <fieldset>
                        <label for="pname" class="pname">Name:</label>

                        <input class="field" name="plname"  type="text" placeholder="Last Name"/>



                    </fieldset>
                    <fieldset >
                        <label for="email" class="email">Email:</label>
                        <br>
                        <input class="field" name="email"  type="email" placeholder="you@yourMail.com"/>


                    </fieldset>

                    <fieldset>
                        <label for="phone" >Phone:</label>
                        <br>
                        <input class="field" name="phone" type="text" placeholder="555-555-5555" />

                    </fieldset>
                        </fieldset>


                    <fieldset id="teacherU" style="display: none">
                        <p>For Teachers:</p>
                    <fieldset>
                        <label for="tname" class="tname">Name:</label>

                        <input class="field" name="tlname"  type="text" placeholder="Last Name"/>



                    </fieldset>
                    <fieldset  >

                        <label for="program3" >Program: <br></label>
                        <select class = "field" id = "program3" name="program3"  />
                        <option value= "" ></option>
                        <option value= "Early Head Start" >Early Head Start</option>
                        <option value= "Keys for Kids" >Keys for Kids</option>
                        <option value= "Child Care" >Child Care</option>
                        </select>

                    </fieldset>
                        </fieldset>

                    <fieldset id="adminU" style="display: none">
                        <p>For Admin:</p>
                        <label for="tname" class="tname">Name:</label>

                        <input class="field" name="alname"  type="text" placeholder="Last Name"/>



                    </fieldset>
                    <input type="submit" value="Submit" name="submit"/>

                    <input type="reset" value="Reset Form"/>
                    </p>

                </form>
            </div>
            <div class="tabFourForm">

                <form action="adminAnnounce.php" method="post">


                    <p>
                        Announcements may be posted here:

                        <br>
                        <br>
                    <script>
                        function dateLabelFunction(){
                            if(document.getElementById('anything').value == 'Post'){
                                document.getElementById('for_Post').style.display = "block";
                                document.getElementById('for_Delete').style.display = "none";
                                document.getElementById('for_Edit').style.display = "none";

                            }
                            if(document.getElementById('anything').value == 'Delete'){
                                document.getElementById('for_Delete').style.display = "block";
                                document.getElementById('for_Edit').style.display = "none";
                                document.getElementById('for_Post').style.display = "none";
                            }
                            if(document.getElementById('anything').value == 'EDIT'){
                                document.getElementById('for_Delete').style.display = "none";
                                document.getElementById('for_Edit').style.display = "block";
                                document.getElementById('for_Post').style.display = "none";

                            }


                        }



                    </script>

                    <fieldset>
                        <label for="anything" class="entity">Update or Post?:<br></label>



                        <select class="field" id="anything" name="anything" onload="dateLabelFunction()" onchange="dateLabelFunction();" "/>
                        <option value= "Post" >Post</option>
                        <option value= "Delete" >Delete Post</option>
                        <option value= "EDIT" >Edit</option>
                        </select>
                    </fieldset>
                    </p>
                        <br>
                    <fieldset id="updateDate" >
                        <label for="audience" class="entity">Select audience:<br></label>


                        <select class = "field" id = "audience" name="audience" />
                        <option value=""></option>
                        <option value="Public">Public</option>
                        <option value="Teachers only">Teachers only</option>

                        </select>
                        <br>

                        <label for="title" >Title:</label>
                        <br>
                        <input class="field" name="title"  type="text" placeholder="Title"/>
                    </fieldset>
                        <br>




                    <br>
                    <fieldset>
                        <label for="messageDate" class="date" id="for_Post" style="display: block">Post Date:   </label><br>
                        <label for="messageDate" class="date" id="for_Delete" style="display: none">Date of Post Deleting:   </label><br>
                        <label for="messageDate" class="date" id="for_Edit" style="display: none">Date of Post Editing:   </label><br>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" value = "                     " name="messageDate" id="messageDate"  readonly="true"  />

                        <script type="text/javascript">
                            calendar.set("messageDate");
                        </script>
                    </fieldset>


                    <br>
                    </p>
                    <p>

                        <label for="bulletin" class="bulletin" > Enter message to be posted:</label>
                        <textarea rows="4" cols="50" name="message"></textarea>
                    </p>

                    <br>
                    Today's Announcements: <br><br>
                    <?php
                    require_once('mysqli_connect.php');

                    $currentMessage = "Null";
                    $query = "Select title, announcement from Announcements Where Announcements.date = CURRENT_DATE "; // Run your query

                    $bool = true;
                    if (!($result = $dbConnection->query($query))) {

                        $bool = false;
                        echo "No Announcements today";
                    }
                    if ($bool) { // If it ran OK.
                        while ($row = mysqli_fetch_array($result)) {
                            $msg = $row['announcement'];
                            $title = $row['title'];
                            echo "Title: "."$title" . "<br><br>". "$msg" . "<br><br>";

                        }

                    }

                    ?>

                    <p class="signin button">
                        <input type="submit" value="Post" name="submit"/>

                    </p>



                </form>
            </div>

            <div class="tabFiveForm">

                <form action="other.php" method="post">


                    <p>
                        Add or Remove Child from class:
                    </p>
                        <br>
                        <br>
                    <fieldset>
                    <select class = "field" id = "add_remove" name="add_remove" />
                    <option value="">Select to add or remove</option>
                    <option value="Add">Add</option>
                    <option value="Remove">Remove</option>

                    </select>
                    </fieldset>
                    <fieldset>
                        <label for="childNames" >Select Child:</label><br>
                        <select id = "childNames" class = "field" name="childNames">
                            <option value="">Please Select a Child</option>
                            <?php
                            $query = $dbConnection->query("Select Concat(fname, ' ', lname) as 'name' from Student;"); // Run your query
                            while ($row = mysqli_fetch_array($query)) {
                                echo "<option value='" . $row['name'] ."'>" . $row['name'] ."</option>";
                            }
                            ?>
                        </select>
                    </fieldset>

                    <fieldset>
                        <label for="teacherNames" >Select Teacher:</label><br>
                        <select id = "teacherNames" class = "field" name="teacherNames">
                            <option value="">Please Select a Teacher</option>
                            <?php
                            $query = $dbConnection->query("Select Concat(fname, ' ', lname) as 'name' from Teacher;"); // Run your query
                            while ($row = mysqli_fetch_array($query)) {
                                echo "<option value='" . $row['name'] ."'>" . $row['name'] ."</option>";
                            }
                            ?>
                        </select>
                    </fieldset>
                    <p class="signin button">
                        <input type="submit" value="Add/Remove" name="submitForAddRemove"/>

                    </p>
                    <br>

                    <p>
                        Search for ID by name:
                    </p>
                        <br>
                        <fieldset>


                            <label for="table" >Select which group to search:</label>
                            <select class = "field" id = "table" name="table" />
                            <option value="">Select search group</option>
                            <option value="Student">Student</option>
                            <option value="Parent">Parent</option>
                            <option value="Teacher">Teacher</option>
                            <option value="Admin">Admin</option>
                            </select>
                            <br>

                        <label for="nameSearch" >Enter name:</label> <br>

                        <input class="field" name="nameSearch"  type="text" placeholder="Enter name 'First Last' "/>
                       </fieldset>
                    <br>
                    <p class="signin button">
                        <input type="submit" value="Search" name="submitSearch"/>

                    </p>




                    <br>

                    <p>
                        Get Reports:
                    </p>
                    <fieldset>
                        <select class = "field" id = "reports" name="reports" />
                        <option value="">Select type of report</option>
                        <option value="Roster">Roster Report</option>
                        <option value="Program">Program Report</option>
                        <option value="Other">Other</option>

                        </select>


                    </fieldset>
                    <p class="signin button">
                        <input type="submit"  value="Get Report" name="submitReports"/>

                    </p>

                </form>
            </div>

        </div>
    </section>
<?php

include ('footer.php');

?>