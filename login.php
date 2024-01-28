<?php
/*echo "<html>"
echo "uname=" $_POST["uname"] "<br>";
echo "password=" $_POST["password"] "<br>";*/

session_start();

$username = "knihovnik";
$passwrd = "pqrgh";

if(isset($_POST["uname"])) {
    $uname = $_POST["uname"];
    $password = $_POST["password"];

    if( $uname == $username && $password == $passwrd) {
        $_SESSION["login"] = true;
        //$_SESSION["id"] = $row["id"];
        header("location: home.html");
        
    }


    else {
        header("location: index.html");
        echo "<script> alert('Wrong username or password); </script>";
        
    }
    
} //else {
    //echo "j";
    //}
?>