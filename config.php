<?php

session_start();
    if(isset($_SESSION["login"]) && $_SESSION["login"]) {
        $connect = mysqli_connect("localhost", "root", "root", "knihovna_database");
        if($connect->connect_error)
            die('Connection Failed:'.$connect->connect_error);
            /*echo"<script> alert('Welcome'); </script>". $_SESSION["login"];*/
        }
    else{
        header("location: index.html");
    
    }
?>