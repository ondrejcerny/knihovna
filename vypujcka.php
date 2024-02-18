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
    </head>
    <body>
        <div class="topnavigator">
            <a href="home.php">Home</a>
            <a href="users.php">Users</a>
            <a href="catalog.php">Catalog</a>
            <a class="here" href="vypujcka.php">Book Loan</a>
            <button onclick="window.location.href = 'logout.php'"
                style="width: auto">Logout
            </button>
        </div>

        <div>
            <form action="vypujcka.php" method="post">
                Zadejte Uzivatele: 
                <select id="user" name="user">
                    <?php
                        $query = "SELECT  id, jmeno, prijmeni FROM uzivatele";
                        $result = mysqli_query($connect, $query);

                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<option value=\"" . $row["id"] . "\">" . $row["jmeno"] . " " . $row["prijmeni"] . "</option>";
                        }
                    ?>
                </select>
                Zadejte knihu: 
                <select id="kniha" name="kniha">
                    <?php
                        $query = "SELECT id, nazev, pocet, autor FROM katalog";
                        $result = mysqli_query($connect, $query);

                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<option value=\"" . $row["id"] . "\">" . $row["nazev"] . " pocet: " . $row["pocet"] . " napsal: " . $row["autor"] . "</option>";
                        }
                    ?>
                </select>

                <label for="vypujceni">Den Vypujceni:</label>
                <input type="date" class="form-control" id="vypujceni" name="vypujceni">

                <label for="vraceni">Den Vraceni:</label>
                <input type="date" class="form-control" id="vraceni" name="vraceni">

                <input id="id8" type="submit" class="button button-primary">
            </form>
        </div>

        <a href="vraceni.php">Vratit knihu<a>
    </body>
    <?php
        $stav = 'aktivni';
        if(isset($_POST["user"])){
            $user = $_POST["user"];
            $kniha = $_POST["kniha"];
            $vypujceni = $_POST["vypujceni"];
            $vraceni = $_POST["vraceni"];

            $query ="INSERT INTO vypujceni (id_osoba, id_kniha, zacatek, konec, stav) VALUES('$user', '$kniha', '$vypujceni', '$vraceni', '$stav')";
            mysqli_query ($connect,$query);
            echo "<script> alert('Vypujceno'); </script>";
        }
    ?>
</html>