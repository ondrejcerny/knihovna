<?php
    session_start();
    if(isset($_SESSION["login"]) && $_SESSION["login"]) {
        /* echo"<script> alert('Welcome'); </script>". $_SESSION["login"];*/
    }
    else{
        header("location: index.html");
    }
    $conn = mysqli_connect("localhost", "root", "root", "knihovna_database");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="knihovna_css.css"/>
        <link rel="stylesheet" href="bootstrap.min.css"/>
    </head>
    <body>


        <!--
        <div class="topnavigator">
        <a class="active" href="#home">Home</a>
        <a href="#users">Users</a>
        <a href="#catalog">Catalog</a>
        </div>
        -->


        <!--Ovladaci panel-->
        <div class="topnavigator">
            <a href="/" class="here">Domů</a>
            <a href="http://localhost/projekt_knihovna/users.php">Uživatelé</a>
            <a href="http://localhost/projekt_knihovna/catalog.php">Katalog</a>
            <a href="autorstvi.php">Autorství</a>
            <button onclick="window.location.href = 'logout.php';"
            style="width: auto;">Odhlásit</button> 
        </div>

        <div class="header">
            <h1>Knihovna GBERG</h1>       
        </div>
        <a>TODO: foto knihovny</a>
</body>
</html>