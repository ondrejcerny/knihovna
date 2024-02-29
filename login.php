<?php
require 'config2.php';

if(isset($_POST["submit"])){
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM spravce WHERE username = '$usernameemail' OR email = '$usernameemail'");
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if($password == password_verify($password, $row["pasword"])){
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
?>