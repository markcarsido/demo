<?php
    session_start();
    include('db.php');

    /*START of SIGN IN MODULE*/

    if(isset($_POST['reg'])){
        $error = array();
        $flag = false;
        $username = $_POST['username'];
        $password = md5($_POST['password']);
    
        if(empty($username))
        {
            $error[] = "Username field is empty";
            $flag = true;
        }
        
        if(strlen($password) < 8)
        {
            $error[] = "Password must be more than 8 characters long";
            $flag = true;
        }
        
        if($flag == true)
        {
            foreach($error as $msg)
            {
                echo "<font color = red> $msg <br></font>";
            }
        }
        else
        {
            $qry = "SELECT * FROM students WHERE username = '$username' and password = '$password' ";
            $result = @mysql_query($qry);
            
            if($result){
                 if(mysql_num_rows($result) > 0)
			     {
				    $_SESSION['username'] = $username;
                     
                    $qry = mysql_query("SELECT * FROM students ORDER BY id") or die (mysql_error());
                      
                    while($raw = mysql_fetch_array($qry))
                    {
                        if($raw['username'] == $username)
                        {
                            header('Location:Home.php?id='.$raw['id'].'');
                        }
                    }
			     }
			     else
			     {
				    echo "<font color = red>Account does not exist. Please check your username and password</font>";
			     }
		    }
        }
    }

    /*END of SIGN IN MODULE*/

    /*START of REGISTRATION MODULE*/

    $username = "";
    $password = "";
    $cpassword = "";
    $fname = "";
    $lname = "";
    $age = "";
    $male_status = 'unchecked';
    $female_status = 'unchecked';
    $contact = "";
    $course_info = "";

    if(isset($_POST['reg2']))
    {
        $error = array();
        $flag = false;
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $contact = $_POST['contact'];
        $course = $_POST['course'];
        
        if(empty($username))
        {
            $error[] = "Username is empty";
            $flag = true;
        }
        
        if(strlen($password) < 8)
        {
            $error[] = "Password must be more than 8 characters long";
            $flag = true;
        }
        
        if($password != $cpassword)
        {
            $error[] = "Password mismatch";
            $flag = true;
        }
        
        if(empty($fname) or is_numeric($fname))
        {
            $error[] = "<br>FIRST NAME RESTRICTIONS:<br>[1]First Name field should not contain any number<br>[2]First Name field should not be empty";
            $flag = true;
        }
        
        if(empty($lname) or is_numeric($lname))
        {
            $error[] = "<br>LAST NAME RESTRICTIONS:<br>[1]Last Name field should not contain any number<br>[2]Last Name field should not be empty";
            $flag = true;
        }
        
        if(empty($age) or $age <= 0 or !is_numeric($age))
        {
            $error[] = "<br>AGE RESTRICTIONS:<br>[1]Age cannot be ZERO or less<br>[2]Age field cannot be empty<br>[3]Age field should be numbers only";
            $flag = true;
        }
        
        if(empty($gender))
        {
            $error[] = "<br>Please select a GENDER.";
            $flag = true;
        }

        if($gender == 'male')
        {
            $male_status = 'checked';

        }
        else if($gender == 'female')
        {
            $female_status = 'checked';
        }
        
        if(empty($contact) or !is_numeric($contact))
        {
            $error[] = "<br>CONTACT RESTRICTIONS:<br>[1]Contact field should not be empty<br>[2]Contact field should only be numbers";
            $flag = true;
        }
        
        if($course == 'BSBA'){
            $course_info = 'BSBA';
        }
        else if($course == 'BSIT'){
            $course_info = 'BSIT';
        }
        else if($course == 'BSIS'){
            $course_info = 'BSIS';
        }
        else{
            $course_info = 'BSCS';
        }
        
        if($flag == true)
        {
            foreach($error as $msg)
            {
                echo "<font color = red> $msg <br></font>";
            }
        }
        else
        {
            $qry = "INSERT INTO students(id,username,password,firstname,lastname,age,gender,contact,course) VALUES('','$username','".md5($password)."','$fname','$lname','$age','$gender','$contact','$course')";
            $result = @mysql_query($qry);

            if($result){
                header('Location:Login.php');
                echo "<h1>SUCCESS!</h1>";
            }
            else{
            DIE ("Query failed!");
            }
        }
        
    }

    /*END of REGISTRATION MODULE*/
?>

<html>
    <head>
        <title>Login PHP Sample</title>
        <script type = "text/javascript" src = "jquery-2.1.4.min.js"></script>
    
        <meta name = "viewport" content = "width=device=width,initial-scale=1">

        <link rel = "stylesheet" href= "css/bootstrap.css">
    
        <script src = "js/bootstrap.min.js"></script>
        <link rel = "stylesheet" href = "Login2.css">
    </head>
    
    <body>
        <div class = "header">
            <div class = "navbar-default fixed">
                <div class = "navbar-header">
                    <a href = "Home.php"><img src = "logo.png" id = "logo" class = "img-circle" alt = "Brand"></a>
                </div>
                
                <div class = "collapse navbar-collapse">
                    <ul class = "nav navbar-nav">
                        <li><a>Welcome BES Jhong!!!</a></li>
                    </ul>
                    
                </div>
            </div>
        </div>    
        <div class = "container">
                <!-- START of REGISTRATION MODULE -->
                <div class = "col-md-9">
                    <form action="Login.php" method = "POST" class = "sign-in">
                        <h1 class = "text-center">Not yet a Member??</h1>
                        <p>
                            <input type = "text" placeholder = "Username" class = "form-control" name = "username" value = "<?php echo $username ?>" required>
                        </p>
                        <p>
                            <input type = "password" placeholder = "Password" class = "form-control" name = "password" value = "<?php echo $password ?>" required>
                        </p>
                        <p>
                            <input type = "password" placeholder = "Confirm Password" class = "form-control" name = "cpassword" value = "<?php echo $cpassword ?>" required>
                        </p>
                        <p>
                            <input type = "text" placeholder = "First Name" class = "form-control" name = "fname" value = "<?php echo $fname ?>" required>
                        </p>
                        <p>
                            <input type = "text" placeholder = "Last Name" class = "form-control" name = "lname" value = "<?php echo $lname ?>" required>
                        </p>
                        <p>
                            <input type = "number" placeholder = "Age" class = "form-control" name = "age" value = "<?php echo $age ?>" required>
                        </p>
                        <p>
                            Gender:
                            <input type = "radio" name = "gender" value = "male" <?php print $male_status ?> > Male
                            <input type = "radio" name = "gender" value = "female" <?php print $female_status ?> >Female
                        </p>
                        <p>
                            <input type = "number" placeholder = "Contact Number" class = "form-control" name = "contact" value = "<?php echo $contact ?>" required>
                        </p>
                        <p>
                            <select name = "course" value = "<?php echo $course ?>" <?php $course_info ?> class = "form-control" required>
                                    <option>Course</option>    
                                    <option value = "BSBA">BSBA</option>
                                    <option value = "BSCS">BSCS</option>
                                    <option value = "BSIS">BSIS</option>
                                    <option value = "BSIT">BSIT</option>
                            </select>
                        </p>
                        <br>
                        <input type = "submit" value = "Register" class = "btn btn-info btn-block" name = "reg2">
                        </form>
                </div>
                
                <!-- END of REGISTRATION MODULE -->
                <!-- START of SIGN IN MODULE -->
                
                <div class = "col-md-3">
                    <form class = "sign-in" action="Login.php" method = "POST">    
                        <h1 class = "text-center">Sign-in</h1><br>
                        <input type = "submit" value = "sign-in" class = "btn btn-info btn-block" data-toggle='modal' data-target='#login'>
                        <div class='modal fade' id='login' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <!--<h3 class='modal-title' id='myModalLabel' align = left>Login</h3>-->
                                            <center><h2>Welcome to </h2><img src = "logo.png" id = "logo2" class = "img-circle"></center>
                                        </div>
                                        <div class='modal-body'>
                                            <form action = "Login.php" method = "POST">
                                                <div class="form-group input-group">
                                                    <span class='input-group-addon'>Username</span>
                                                    <input type="text" class="form-control" name="username" required>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class='input-group-addon'>Password </span>
                                                    <input type="password" class="form-control" name="password" required>
                                                </div>
                                                <div class='modal-footer'>
                                                    <input type='submit' class='btn btn-info btn-block pull-right' id = 'loginbtn' value = "Login" name = 'reg'/>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
                
                <!-- END of SIGN IN MODULE -->
                
                </div>
    </body>
    
</html>