<br>
    <?php
        include('Header.php');
        if(!isset($_SESSION['username'])){
            header('location:Login.php');
        }

        include('db.php');
        $id = $_GET['id'];

        $query = "SELECT * FROM students where id = '$id' ";
        $user = mysql_query($query);
        $user = mysql_fetch_assoc($user);

        $gender = $user['gender'];
        $male_status = 'unchecked';
        $female_status = 'unchecked';
                                
        if($gender == 'male'){
            $male_status = 'checked';
        }
        else if($gender == 'female'){
            $female_status = 'checked';
        }
        $username = $user['username'];
        $fname = $user['firstname'];
        $lname = $user['lastname'];
        $age = $user['age'];
        $contact = $user['contact'];
        $course_info = $user['course'];
        $src = $user['src'];

        if(isset($_POST['reg']))
        {
            $error = array();
            $flag = false;
            
            $id = $_POST['id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $contact = $_POST['contact'];
            $course = $_POST['course'];
            $src = $_POST['src'];

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
            
            if(empty($src))
            {
                $error[] = "<br>IMAGE SOURCE RESTRICTIONS:<br>[1]Image Source field should not be empty<br>[2]Image Source field should be alphanumeric";
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
                 $qry = "UPDATE students 
                SET username = '$username', password = '".md5($password)."', firstname = '$fname', lastname = '$lname',age = '$age', gender = '$gender', contact = '$contact', course = '$course' 
                WHERE id = '$id' ";
                $result = @mysql_query($qry);

                if($result){
                    header('Location:ViewAccounts.php');
                }
                else{
                    die("Query failed");
                }
            }
        }
    ?>

<html>
    <head>
        <title>User Profile</title>
        <script type = "text/javascript" src = "jquery-2.1.4.min.js"></script>
        
        <meta name = "viewport" content = "width=device=width,initial-scale=1">
        
        <link rel = "stylesheet" href = "css/bootstrap.css">
        
        <script src = "js/bootstrap.min.js"></script>
        
        <link rel = "stylesheet" href = "Home2.css">
    </head>
        <div class = "container">
            <br>
            <center>
                <form action = "Edit.php" method = "POST">
                <table>
                    <h2>Edit User Information</h2>
                    <tr>
                        <td>User ID </td>
                        <td><?php                     
                                include('db.php');
                                $id = $_GET['id'];

                                $query = "SELECT * FROM students where id = '$id' ";
                                $user = mysql_query($query);
                                $user = mysql_fetch_assoc($user);

                                $gender = $user['gender'];
                                $male_status = 'unchecked';
                                $female_status = 'unchecked';
                                    
                                echo "<input type = number class = form-control name = id value = ".$id." readonly>";

                                if($gender == 'male'){
                                    $male_status = 'checked';
                                }
                                else if($gender == 'female'){
                                    $female_status = 'checked';
                                }
                            ?></td>
                    </tr>
                    <tr>
                        <td>Username </td>
                        <td><input type = "text" class = "form-control" name = "username" value = "<?php echo $user['username']?>" required> </td>
                    </tr>
                    <tr>
                        <td>Password </td>
                        <td><input type = "password" class = "form-control" name = "password" required></td>
                    </tr>
                    <tr>
                        <td>Confirm Password </td>
                        <td><input type = "password" class = "form-control" name = "cpassword" required></td>
                    </tr>
                    <tr>
                        <td>First Name </td>
                        <td><input type = "text" class = "form-control" name = "fname" value = "<?php echo $user['firstname']?>" required> </td>
                    </tr>
                    <tr>
                        <td>Last Name </td>
                        <td><input type = "text" class = "form-control" name = "lname" value = "<?php echo $user['lastname']?>" required> </td>
                    </tr>
                    <tr>
                        <td>Age </td>
                        <td><input type = "number" class = "form-control" name = "age" value = "<?php echo $user['age']?>" required> </td>
                    </tr>
                    <tr>
                        <td>Gender </td>
                        <td>Male<input type = "radio" name = "gender" value = "male" <?php print $male_status ?> >
                            Female<input type = "radio" name = "gender" value = "female" <?php print $female_status ?> required> </td>
                    </tr>
                    <tr>
                        <td>Contact </td>
                        <td><input type = "number" class = "form-control" name = "contact" value = "<?php echo $user['contact']?>" required> </td>
                    </tr>
                    <tr>
                        <td>Course: </td>
                        <td><select name = "course" class = "form-control" value = "<?php echo $course ?>" required>
                                <option><?php echo $user['course']?></option>
                                <option>----------------</option>
                                <option value = "BSBA">BSBA</option>
                                <option value = "BSCS">BSCS</option>
                                <option value = "BSIS">BSIS</option>
                                <option value = "BSIT">BSIT</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Image Source </td>
                        <td><input type = "text" class = "form-control" name = "src" value = "<?php echo $user['src']?>" required> </td>
                    </tr>
                </table>
                <br><button type = "submit" class = "btn btn-info" name = "reg">Submit</button>
                </form>
            </center>
        </div>
</html>
