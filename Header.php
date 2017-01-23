<?php
    session_start();
    include('db.php');

    if(!isset($_SESSION['username'])){
        header('location:Login.php');
    }

    $username = $_SESSION['username'];

    $qry = mysql_query("SELECT * FROM students ORDER BY id") or die (mysql_error());
                      
    while($raw = mysql_fetch_array($qry))
    {
        if($raw['username'] == $username)
        {
            $id = $raw['id'];
        }
    }
?>

<html>
    <head>
        <title>Home</title>
        <script type = "text/javascript" src = "jquery-2.1.4.min.js"></script>
    
        <meta name = "viewport" content = "width=device=width,initial-scale=1">

        <link rel = "stylesheet" href= "css/bootstrap.css">
    
        <script src = "js/bootstrap.min.js"></script>
        
        <link rel = "stylesheet" href= "Home2.css">
    </head>
    <body>
        <div class = "container">
            <div class = "navbar navbar-default fixed">
                <div class = "navbar-header">
                    <a href = "<?php echo 'Home.php?id='.$id.'' ?>"><img src = "logo.png" id = "logo" class = "img-circle" alt = "Brand"></a>
                </div>
                
                <div class = "collapse navbar-collapse">
                    <ul class = "nav navbar-nav">
                        <li><a href = "<?php echo 'Home.php?id='.$id.'' ?>">Home</a></li>
                        <li><a href = "<?php echo 'About.php?id='.$id.'' ?>">About</a></li>
                    </ul>
                    
                    <ul class = "nav navbar-nav navbar-right">
                        <li><a href = "<?php echo 'ViewAccounts.php?id='.$id.'' ?>">Accounts</a></li>
                        <li><a href = "Logout.php">Logout</a></li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </body>
</html>