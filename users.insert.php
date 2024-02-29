<?php
    require 'config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link rel="stylesheet" href="knihovna_css.css"/>
        <link rel="stylesheet" href="http://localhost/projekt_knihovna/bootstrap.min.css"/>
    </head>
    <body>
        <div class="topnavigator">
            <a href="home.php">Domů</a>
            <a class="here" href="/">Uživatelé</a>
            <a href="catalog.php">Katalog</a>
            <a href="vypujcka.php">Autoři</a>
            <button onclick="window.location.href = 'logout.php';"
            style="width: auto;">Odhlásit</button>
        </div>

        <button type="button" class="btn btn-dark btn-sm mt-3"><a href="users.php" class="text-light">Zpět</a></button>

        <div class="container mt-2 pt-2">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card bg-dark text-white" >
                        <div class="card-body">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                            </svg>

                            <h1>Přidejte Uživatele</h1>
                            <form class="insertFormU" action="users.php" method="post">
    
                                <label for="jmeno">Jméno:</label>
                                <input id="id2" type="text" class="form-control" id="jmeno" placeholder="Zadejte Jméno Uživatele.." name="jmeno">
    
                                <label for="prijmeni">Přijmení:</label>
                                <input id="id2" type="text" class="form-control" id="prijmeni" placeholder="Zadejte Přijmení Uživatele.." name="prijmeni">
    
                                <label for="email">Email:</label>
                                <input id="id2" type="text" class="form-control" id="email" placeholder="Zadejte Email Uživatele.." name="email">
    
                                <label for="tel_cislo">Telefoní Číslo:</label>
                                <input id="id2" type="number" class="form-control" id="tel_cislo" placeholder="Zadejte Telefon Uživatele.." name="tel_cislo">
    
                                <label for="rodne_cislo">Rodné Číslo:</label>
                                <input id="id2" type="number" class="form-control" id="rodne_cislo" placeholder="Zadejte Rodné Číslo Uživatele.." name="rodne_cislo">

                                <label for="adresa">Adresa:</label>
                                <input id="id2" type="text" class="form-control" id="adresa" placeholder="Zadejte Adresu Uživatele.." name="adresa">
    
                                <div class="text-center mt-3">
                                <input id="id3" type="submit" value="Přidat" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    if(isset($_POST, $_POST['jmeno']))
    {
        $jmeno = $_POST['jmeno'];
        $prijmeni = $_POST['prijmeni'];
        $email = $_POST['email'];
        $tel_cislo = $_POST['tel_cislo'];
        $rodne_cislo = $_POST['rodne_cislo'];
        $adresa = $_POST['adresa'];

        /*$connect = new mysqli('localhost','root','root','knihovna_database');
        if($connect->connect_error){
            die('Connection Failed:'.$connect->connect_error);
        }
        /*else{
            $stmt = $connect->prepare("insert into uzivatele(jmeno, prijmeni, adresa, email, rodne_cislo, tel_cislo)
                values(?, ?, ?, ?, ?, ?)");
            $stmt-> bind_param("ssssii",$jmeno, $prijmeni, $adresa, $email, $rodne_cislo, $tel_cislo);
            $stmt->execute();
            header('location:users.php');
            $stmt->close();
            $connect->close();

        }*/
        $query ="INSERT INTO uzivatele (jmeno, prijmeni, adresa, email, rodne_cislo, tel_cislo) VALUES('$jmeno', '$prijmeni', '$adresa', $email, $rodne_cislo, $tel_cislo)";
            mysqli_query ($connect,$query);
            header('location:users.php');       

    }
?>