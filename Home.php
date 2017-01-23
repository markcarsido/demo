<br>
    <?php
        include('Header.php');
        if(!isset($_SESSION['username'])){
            header('location:Login.php');
        }

        $id = $_GET['id'];

    ?>

<html>
    <head>
        <title> Home </title>
        <script type = "text/javascript" src = "jquery-2.1.4.min.js"></script>
        <meta name = "viewport" content = "width=device=width,initial-scale=1">
        <link rel = "stylesheet" href= "css/bootstrap.css">
        <script src = "js/bootstrap.min.js"></script>
        <link rel = "stylesheet" href = "Home2.css">
    </head>
    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        
        <div  class = "container">
            <div class = "row">
                <div class = "col-md-3">
                    <aside>
                        <?php
                            include('db.php');
                            
                            $username = $_SESSION['username'];
                            
                            $query = "SELECT * FROM students where id = '$id' ";
                            $user = mysql_query($query);
                            $user = mysql_fetch_assoc($user);
                        
                            echo '<img class = "img-circle" src = "'.$user['src'].'" id = "pic">';
                            echo '<h3>'.$user['firstname'].'  '.$user['lastname'].'</h3>';
                        ?>
                        <hr class = "line">
                        <h5>Like the Informatics International College Page</h5>
                        <div class="fb-like" data-href="https://www.facebook.com/informaticsph/?fref=ts" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="true"></div>
                    </aside>
                </div>
                
                <div class = "col-md-9">
                    <aside>
                        <?php
                            include('db.php');
                            
                            $qry = mysql_query("SELECT * FROM comments where receiverid = '$id' ") or die (mysql_error());
                            while($raw = mysql_fetch_array($qry))
                            {
                                $sender = $raw['senderid'];

                                $query = "SELECT * FROM students where id = '$sender' ";
                                $sender1 = mysql_query($query);
                                $sender1 = mysql_fetch_assoc($sender1);

                                echo '<ul class=list-inline>
                                        <li><a href = Profile.php?id='.$sender.'><img src="'.$sender1['src'].'" class=img-rounded></a></li>
                                        <li> 
                                            <tr><h6>'.$sender1['firstname'].'  '.$sender1['lastname'].' wrote..</h6></tr>
                                            <tr><h4>'.$raw['message'].'</h4></tr>
                                        </li>
                                      </ul>
                                      <hr class = "line">';
                            }
                        ?>
                    </aside>
                </div>
            </div>
            
        </div>
    </body>
</html>