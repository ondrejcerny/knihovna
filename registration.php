<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "root", "knihovna_database");

    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirmpassword"];
        $duplicate = mysqli_query($conn, "SELECT username, email FROM spravce  WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
        echo "<script> alert('Username or Email has already been taken'); </script>";
    }
    else {
        if($password == $confirmpassword){
            $query ="INSERT INTO spravce (username, email, pasword) VALUES('$username', '$email', '$password')";
            mysqli_query ($conn,$query);
            echo "<script> alert('Registration Successful'); </script>";
        }
        else {
            echo"<script> alert('Password Does Not Match'); </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration</title>
        <link rel="stylesheet" href="registration.css"/>
    </head>
    <body>
    
        <div>
            <h1>Registration</h1>
            <form method="post" action="" autocomplete="off">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Your Username..">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Your Email..">
      
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Your Password..">

                <label for="confirmpassword">Confirm Password:</label>
                <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Your Password..">
      

                <input type="submit" name="submit" action="registration.php"></input>
            </form>

            <br>
            <a href="index.html">Login<a>
        </div>
</body>
</html>