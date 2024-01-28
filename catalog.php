<?php
session_start();

$nazev = $_POST['nazev'];
$pocet = $_POST['pocet'];
$autor = $_POST['autor'];

// propojeni s databazi
$conn = new mysqli('localhost','root','root','knihovna_database');
    if($conn->connect_error){
        die('Connection Failed:'.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into katalog(nazev, pocet, autor)
            values(?, ?, ?)");
        $stmt-> bind_param("sii",$nazev, $autor, $pocet);
        $stmt->execute();
        echo "registration successfully...";
        $stmt->close();
        $conn->close();

    }




?>