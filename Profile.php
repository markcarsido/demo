<br>
    <?php
        include('Header.php');
        if(!isset($_SESSION['username'])){
            header('location:Login.php');
        }
        
        /*SAVE MESSAGE*/
        if(isset($_POST['reg'])){
            
            /*GET ID of LOGGED IN USER/SENDER*/
                $username = $_SESSION['username'];

                $qry = mysql_query("SELECT * FROM students ORDER BY id") or die (mysql_error());
                while($raw = mysql_fetch_array($qry))
                {
                    if($raw['username'] == $username)
                    {
                        $senderid = $raw['id'];
                    }
                }
            
            $message = $_POST['message'];
            $id = $_POST['id'];
            
            $qry1 = "INSERT INTO comments(message,senderid,receiverid) VALUES ('$message','$senderid','$id')";
            $result = @mysql_query($qry1);

            if($result){
                header('Location:Home.php?id='.$id.' ');
            }
            else{
                DIE ("Query failed!");
            }
        }

    ?>

<html>
    <head>
    <script type = "text/javascript" src = "jquery-2.1.4.min.js"></script>
    
    <meta name = "viewport" content = "width=device=width,initial-scale=1">

    <link rel = "stylesheet" href= "css/bootstrap.css">
    
    <script src = "js/bootstrap.min.js"></script>

    <link rel = "stylesheet" href = "Home2.css">
    </head>
    <body>
        <div class="container">
            <div class = "row">
                        <?php
                            include('db.php');
                            $id = $_GET['id'];
                
                            $query = "SELECT * FROM students where id = '$id' ";
                            $user = mysql_query($query);
                            $user = mysql_fetch_assoc($user);
                            
                            if($user['username'] != $username)
                            {
                                $id = $user['id'];
                                $src = $user['src'];
                                $username = $user['username'];
                                $firstname = $user['firstname'];
                                $lastname = $user['lastname'];
                                $age = $user['age'];
                                $gender = $user['gender'];
                                $contact = $user['contact'];
                                $course = $user['course'];
                                
                                echo '<div class = col-md-3><center>
                                <table class = table-condensed>
                                <img class = img-circle src = '.$src.' id = pic><br><br>';
                                echo '<tr><td>User ID</td><td>' .$id.'</td></tr>';
                                echo '<tr><td>Username &nbsp</td><td>' .$username.'</td></tr>';
                                echo '<tr><td>First Name &nbsp</td><td>' .$firstname.'</td></tr>';
                                echo '<tr><td>Last Name &nbsp</td><td>' .$lastname.'</td></tr>';
                                echo '<tr><td>Age &nbsp</td><td>' .$age.'</td></tr>';
                                echo '<tr><td>Gender &nbsp</td><td>' .$gender.'</td></tr>';
                                echo '<tr><td>Contact &nbsp</td><td>' .$contact.'</td></tr>';
                                echo '<tr><td>Course &nbsp</td><td>' .$course.'</td></tr></table></center></div>';
                                
                                echo '<div class = col-md-8>
                                    <form action = "Profile.php" method = "POST">
                                      <h5>Write your message here:</h5>
                                      <input type = "hidden" name = "id" value = "'.$id.'"/>
                                      <textarea class="form-control" rows="5" name="message" required></textarea><br>
                                    <input type="submit" class="btn btn-info btn-block pull-right" value = "Submit" name = "reg"/>
                                    </form>
                                </div>';
                                /*Includes messages of other people*/
                                
                            }
                            else{
                                echo '<center><table class = table-condensed>
                                <img class = img-circle src = '.$user['src'].' id = pic><br><br>';
                                echo '<tr><td>User ID</td><td>' .$id.'</td></tr>';
                                echo '<tr><td>Username &nbsp</td><td>' .$user['username'].'</td></tr>';
                                echo '<tr><td>First Name &nbsp</td><td>' .$user['firstname'].'</td></tr>';
                                echo '<tr><td>Last Name &nbsp</td><td>' .$user['lastname'].'</td></tr>';
                                echo '<tr><td>Age &nbsp</td><td>' .$user['age'].'</td></tr>';
                                echo '<tr><td>Gender &nbsp</td><td>' .$user['gender'].'</td></tr>';
                                echo '<tr><td>Contact &nbsp</td><td>' .$user['contact'].'</td></tr>';
                                echo '<tr><td>Course &nbsp</td><td>' .$user['course'].'</td></tr></table>';
                                echo '<br><a role = "button" class = "btn btn-warning" href = "Edit.php?id='.$id.'">Edit</a>&nbsp&nbsp<a role = "button" class = "btn btn-danger" href = "Delete.php?id='.$id.'">Delete</a></center>';
                            }
                        ?>
            </div>
        </div>
    </body>
    
</html>