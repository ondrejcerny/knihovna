<?php
session_start();

$jmeno = $_POST['jmeno'];
$prijmeni = $_POST['prijmeni'];
$email = $_POST['email'];
$tel_cislo = $_POST['tel_cislo'];
$rodne_cislo = $_POST['rodne_cislo'];
$adresa = $_POST['adresa'];

// propojeni s databazi
$conn = new mysqli('localhost','root','root','knihovna_database');
    if($conn->connect_error){
        die('Connection Failed:'.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into uzivatele(jmeno, prijmeni, adresa, email, rodne_cislo, tel_cislo)
            values(?, ?, ?, ?, ?, ?)");
        $stmt-> bind_param("ssssii",$jmeno, $prijmeni, $adresa, $email, $rodne_cislo, $tel_cislo);
        $stmt->execute();
        echo "registration successfully...";
        $stmt->close();
        $conn->close();

    }

?>