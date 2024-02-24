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
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <link rel="stylesheet" href="knihovna_css.css"/>
        <link rel="stylesheet" href="catalog.css"/>
        <link rel="stylesheet" href="bootstrap.min.css"/>
    </head>
    <body>
        <div class="topnavigator">
            <a href="home.php">Domů</a>
            <a href="users.php">Uživatelé</a>
            <a href="catalog.php">Katalog</a>
            <a class="here" href="autorstvi.php">Autorství</a>
            <button onclick="window.location.href = 'logout.php'"
                style="width: auto">Odhlásit
            </button>
        </div>
        <div id="divInsert1">
            <form class="insertFormB" action="autor.php" method="post">
            
                <label for="jmeno">Jmeno:</label>
                <input type="text" class="form-control" id="jmeno" name="jmeno">
        
                <label for="prijmeni">Prijmeni:</label>
                <input type="text" class="form-control" id="prijmeni" name="prijmeni">
            
                <label for="datumnarozeni">Datum narozeni:</label>
                <input type="date" class="form-control" id="datumnarozeni" name="datumnarozeni">
            
            
                <input id="id6" type="submit" class="button button-primary">
            </form>
        </div>
    </body>
    <?php
        if(isset($_POST, $_POST["jmeno"], $_POST["prijmeni"], $_POST["datumnarozeni"]))
        {
            $conn = new mysqli('localhost','root','root','knihovna_database');
            if($conn->connect_error){
                die('Connection Failed:'.$conn->connect_error);
            }
            $jmenoautor = $_POST["jmeno"];
            $prijmeni = $_POST["prijmeni"];
            $datumnarozeni = $_POST["datumnarozeni"];
            echo "$datumnarozeni";
        
            
            $query ="INSERT INTO autor (jmeno, prijmeni, datum_narozeni) VALUES('$jmenoautor', '$prijmeni', str_to_date('$datumnarozeni', '%Y-%m-%d'))";
            mysqli_query ($conn,$query);
            header('location:autorstvi.php');       
        }

        /*session_start();
        if(isset($_POST, $_POST["jmenoautor"], $_POST["prijmeni"], $_POST["datumnarozeni"]))
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
                }   else{
                $stmt = $conn->prepare("insert into autor(jmeno, prijmeni, datum_narozeni)
                values(?, ?, ?)");
                $stmt-> bind_param("ssi",$jmenoautor, $prijmeni, $datumnarozeni);
                $stmt->execute();
                echo "<script> alert('Done'); </script>";
                $stmt->close();
                $conn->close();

                } <=====tady konci puvodni zakomentovani !!!!!!!????????

                $jmenoautor = $_POST["jmenoautor"];
                $prijmeni = $_POST["prijmeni"];
                $datumnarozeni = $_POST["datumnarozeni"];
                echo "$datumnarozeni";
    
        
                $query ="INSERT INTO autor (jmeno, prijmeni, datum_narozeni) VALUES('$jmenoautor', '$prijmeni', str_to_date('$datumnarozeni', '%Y-%m-%d'))";
                mysqli_query ($conn,$query);
                echo "<script> alert('done'); </script>";       
    
        }
        else{
            echo "<script> alert('error'); </script>";
        }*/


    ?>
</html>