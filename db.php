<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'informatics';

    mysql_connect($hostname,$username,$password) or die ('Connection to host has failed! Perhaps the server is down!');

    mysql_select_db($dbname) or die('Database not available!');
?>