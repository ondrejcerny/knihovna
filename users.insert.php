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
    </head>
    <body>
        <div class="topnavigator">
            <a href="home.php">Home</a>
            <a class="here" href="/">Users</a>
            <a href="catalog.php">Catalog</a>
            <a href="vypujcka.php">Autorství</a>
            <button onclick="window.location.href = 'logout.php';"
            style="width: auto;">Logout</button>
        </div>

        <div id="divInsert">
            <form class="insertFormU" action="users.php" method="post">
    
                <label for="jmeno">First name:</label>
                <input id="id2" type="text" class="form-control" id="jmeno" name="jmeno">
    
                <label for="prijmeni">Last name:</label>
                <input id="id2" type="text" class="form-control" id="prijmeni" name="prijmeni">
    
                <label for="email">E-mail:</label>
                <input id="id2" type="text" class="form-control" id="email" name="email">
    
                <label for="tel_cislo">Phone number:</label>
                <input id="id2" type="number" class="form-control" id="tel_cislo" name="tel_cislo">
    
                <label for="rodne_cislo">Personal identification number:</label>
                <input id="id2" type="number" class="form-control" id="rodne_cislo" name="rodne_cislo">

                <label for="adresa">Address:</label>
                <input id="id2" type="text" class="form-control" id="adresa" name="adresa">
    
                <input id="id3" type="submit" class="button button-primary">
            </form>
        </div>
    </body>
</html>
<?php
    if(isset($_POST, $_POST['jmeno'])){
        $jmeno = $_POST['jmeno'];
        $prijmeni = $_POST['prijmeni'];
        $email = $_POST['email'];
        $tel_cislo = $_POST['tel_cislo'];
        $rodne_cislo = $_POST['rodne_cislo'];
        $adresa = $_POST['adresa'];

        // propojeni s databazi
        $connect = new mysqli('localhost','root','root','knihovna_database');
    if($connect->connect_error){
        die('Connection Failed:'.$connect->connect_error);
    }else{
        $stmt = $connect->prepare("insert into uzivatele(jmeno, prijmeni, adresa, email, rodne_cislo, tel_cislo)
            values(?, ?, ?, ?, ?, ?)");
        $stmt-> bind_param("ssssii",$jmeno, $prijmeni, $adresa, $email, $rodne_cislo, $tel_cislo);
        $stmt->execute();
        header('location:users.php');
        $stmt->close();
        $connect->close();

    }

    }
?>