<?php
session_start();

$conn = mysqli_connect("localhost", "root", "root", "knihovna_database");

if(isset($_POST["submit"])){
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM spravce WHERE username = '$usernameemail' OR email = '$usernameemail'");
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if($password == $row["pasword"]){
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("location: home.php");
        }
        else{
            echo "<script> alert('Incorect Password'); </script>";
        }
    }
    else{
        header("location: index.html");
        echo "<script> alert('Incorect Username Or Email'); </script>";
        
    }
}


/*$username = "knihovnik";
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
    //}   */
?>