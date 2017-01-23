<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header('location:Login.php');
    }
?>

<html>
    <head>
        <title>Home</title>
        <script type = "text/javascript" src = "jquery-2.1.4.min.js"></script>
    
        <meta name = "viewport" content = "width=device=width,initial-scale=1">

        <link rel = "stylesheet" href= "css/bootstrap.css">
    
        <script src = "js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class = "container">
            <div class = "navbar navbar-default fixed">
                <div class = "navbar-header">
                    <a href = "Home.php" class = "navbar-brand">Bleh.com</a>
                    
                    <!--<button type = "button" class = "navbar-toggle" data-toggle = "collapse" data-target = ".navbar-collapse">
                        <span class = "sr-only">Toggle Navigation</span>
                            <span class = "icon-bar"></span>
                            <span class = "icon-bar"></span>
                            <span class = "icon-bar"></span>
                    </button>-->
                </div>
                
                <div class = "collapse navbar-collapse">
                    <ul class = "nav navbar-nav">
                        <li><a href = "Home.php">Home</a></li>
                        <li><a href = "About.php">About</a></li>
                    </ul>
                    
                    <ul class = "nav navbar-nav navbar-right">
                        <li><a href = "ViewAccounts.php">Accounts</a></li>
                        <li><a href = "Logout.php">Logout</a></li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </body>
</html>