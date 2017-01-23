<?php
    include('db.php');
    $id = $_GET['id'];

    $qry = "DELETE FROM students  
            WHERE id = '$id' ";
    $result = @mysql_query($qry);

    if($result){
        header('Location:ViewAccounts.php');
    }
    else{
        die("Query failed");
    }
            
?>