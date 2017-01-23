<br>
<?php
        include('Header.php');
        if(!isset($_SESSION['username'])){
            header('location:Login.php');
        }
?>

<html>
    <head>
        <title>View Members</title>
        <script type = "text/javascript" src = "jquery-2.1.4.min.js"></script>
        <meta name = "viewport" content = "width=device=width,initial-scale=1">
         <link rel = "stylesheet" href = "css/bootstrap.css">
        <script src = "js/bootstrap.min.js"></script>
        <link rel = "stylesheet" href = "Home2.css">
        <meta charset="utf-8">
          
    </head>
    <body>
        <div id="body">
            <br>
            <center><h2>Members List</h2>
            <br>
            <table class = "table-condensed">
            <?php
              include('db.php');

              $username = $_SESSION['username'];
                
              $qry = mysql_query("SELECT * FROM students ORDER BY id") or die (mysql_error());
              while($raw = mysql_fetch_array($qry))
              {
                  if($raw['username'] == $username)
                  {
                      echo '<tr class = "success"><td><a href = "Profile.php?id='.$raw['id'].'">'.$raw['firstname']." ".$raw['lastname'].'</a></td><td> &nbsp&nbsp&nbsp</td><td><a role = "button" class = "btn btn-warning" href = "Edit.php?id='.$raw['id'].'">Edit</a>&nbsp<a role = "button" class = "btn btn-danger" href = "Delete.php?id='.$raw['id'].'">Delete</a></td></tr>';  
                  }
                  else
                  {
                      echo '<tr><td><a href = "Profile.php?id='.$raw['id'].'">'.$raw['firstname']." ".$raw['lastname'].'</a></td>';
                  }
                     
              }
            ?>
            </table>
            </center>
        </div>
    </body>
</html>