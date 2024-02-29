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
            <a class="here" href="autorstvi.php">Autoři</a>
            <button onclick="window.location.href = 'logout.php'"
                style="width: auto">Odhlásit
            </button>
        </div>

        <button type="button" class="btn btn-dark btn-sm mt-3"><a href="autorstvi.php" class="text-light">Zpět</a></button>

        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card bg-dark text-white" >
                        <div class="card-body">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-feather" viewBox="0 0 16 16">
                            <path d="M15.807.531c-.174-.177-.41-.289-.64-.363a3.8 3.8 0 0 0-.833-.15c-.62-.049-1.394 0-2.252.175C10.365.545 8.264 1.415 6.315 3.1S3.147 6.824 2.557 8.523c-.294.847-.44 1.634-.429 2.268.005.316.05.62.154.88q.025.061.056.122A68 68 0 0 0 .08 15.198a.53.53 0 0 0 .157.72.504.504 0 0 0 .705-.16 68 68 0 0 1 2.158-3.26c.285.141.616.195.958.182.513-.02 1.098-.188 1.723-.49 1.25-.605 2.744-1.787 4.303-3.642l1.518-1.55a.53.53 0 0 0 0-.739l-.729-.744 1.311.209a.5.5 0 0 0 .443-.15l.663-.684c.663-.68 1.292-1.325 1.763-1.892.314-.378.585-.752.754-1.107.163-.345.278-.773.112-1.188a.5.5 0 0 0-.112-.172M3.733 11.62C5.385 9.374 7.24 7.215 9.309 5.394l1.21 1.234-1.171 1.196-.027.03c-1.5 1.789-2.891 2.867-3.977 3.393-.544.263-.99.378-1.324.39a1.3 1.3 0 0 1-.287-.018Zm6.769-7.22c1.31-1.028 2.7-1.914 4.172-2.6a7 7 0 0 1-.4.523c-.442.533-1.028 1.134-1.681 1.804l-.51.524zm3.346-3.357C9.594 3.147 6.045 6.8 3.149 10.678c.007-.464.121-1.086.37-1.806.533-1.535 1.65-3.415 3.455-4.976 1.807-1.561 3.746-2.36 5.31-2.68a8 8 0 0 1 1.564-.173"/>
                            </svg>
                            <h1>Přidejte Autora</h1>
                            <form class="insertFormB" action="autor.php" method="post">
            
                                <label for="jmeno">Jméno Autora:</label>
                                <input type="text" class="form-control" id="jmeno" name="jmeno" placeholder="Zadejte Jméno Autora..">
        
                                <label for="prijmeni">Přijmení Autora:</label>
                                <input type="text" class="form-control" id="prijmeni" name="prijmeni" placeholder="Zadejte Přijmení Autora..">
            
                                <label for="datumnarozeni">Datum Narození Autora:</label>
                                <input type="date" class="form-control" id="datumnarozeni" name="datumnarozeni" placeholder="Zadejte Datum Narození Autora..">
            
                                <div class="text-center mt-3">
                                    <input id="id6" type="submit" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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