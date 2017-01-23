<br>
    <?php
        include('Header.php');
        if(!isset($_SESSION['username'])){
            header('location:Login.php');
        }

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
        <div  class = "container">
            <div class = "row">
                <div class = "col-md-6">
                    <aside>
                        <img class = "img-circle" src = "mj.jpg" id = "pic">
                        <h2>Mark Jovann Carsido</h2>
                        <p>Student/Web Developer</p>
                        <hr class = "line">
                        <a class = "twitter-follow-button" href = "https://www.twitter.com/iammjcarsido" data-show-count = "true" data-lang = "en"></a>
                    </aside>
                </div>
                
                <div class = "col-md-6">
                    <aside>
                        <img class = "img-circle" src = "aldin.jpeg" id = "pic">
                        <h2>Aldin Bautista Jr.</h2>
                        <p>Instructor</p>
                        <hr class = "line">
                        <a class = "twitter-follow-button" href = "https://www.twitter.com/aldinbautistajr" data-show-count = "true" data-lang = "en"></a>
                    </aside>
                </div>
            </div>
            
            <script>window.twttr = (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0],
                t = window.twttr || {};
              if (d.getElementById(id)) return t;
              js = d.createElement(s);
              js.id = id;
              js.src = "https://platform.twitter.com/widgets.js";
              fjs.parentNode.insertBefore(js, fjs);

              t._e = [];
              t.ready = function(f) {
                t._e.push(f);
              };

              return t;
            }(document, "script", "twitter-wjs"));</script> 
            
        </div>
    </body>
</html>