<?php
    session_start();
    if(isset($_POST, $_POST["jmeno"], $_POST["prijmeni"], $_POST["datumnarozeni"]))
    {
        $conn = new mysqli('localhost','root','root','knihovna_database');
        if($conn->connect_error){
            die('Connection Failed:'.$conn->connect_error);
        }
            /*  $jmenoautor = $_POST['jmeno'];
             $prijmeni = $_POST['prijmeni'];
            $datumnarozeni = $_POST['datum_narozeni'];

            // propojeni s databazi
            $conn = new mysqli('localhost','root','root','knihovna_database');
            if($conn->connect_error){
            die('Connection Failed:'.$conn->connect_error);
            }else{
            $stmt = $conn->prepare("insert into autor(jmeno, prijmeni, datum_narozeni)
            values(?, ?, ?)");
            $stmt-> bind_param("ssi",$jmenoautor, $prijmeni, $datumnarozeni);
            $stmt->execute();
            echo "<script> alert('Done'); </script>";
            $stmt->close();
            $conn->close();

            }*/

            $jmenoautor = $_POST["jmeno"];
            $prijmeni = $_POST["prijmeni"];
            $datumnarozeni = $_POST["datumnarozeni"];
            echo "$datumnarozeni";
    
        
            $query ="INSERT INTO autor (jmeno, prijmeni, datum_narozeni) VALUES('$jmenoautor', '$prijmeni', str_to_date('$datumnarozeni', '%Y-%m-%d'))";
            mysqli_query ($conn,$query);
            echo "<script> alert('done'); </script>";       
    
    }
    else{
        echo "<script> alert('error'); </script>";
    }


?>