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

        <link rel="stylesheet" href="http://localhost/projekt_knihovna/knihovna_css.css"/>
        <!--<link rel="stylesheet" href="http://localhost/projekt_knihovna/users.css"/>-->
        <link rel="stylesheet" href="http://localhost/projekt_knihovna/bootstrap.min.css"/>
    </head>
    <body>
        <div class="topnavigator">
            <a href="home.php">Domů</a>
            <a class="here" href="users.php">Uživatelé</a>
            <a href="catalog.php">Katalog</a>
            <a href="autorstvi.php">Autorství</a>
            <button onclick="window.location.href = 'logout.php'"
                style="width: auto">Odhlásit
            </button>
        </div>

        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card bg-dark text-white" >
                        <div class="card-body">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4"/>
                            </svg>
                            <h1>Vytvořte Výpujčku</h1>
                            <form action="insert.vypujcky.php" method="post">
                                <div class="text-center mt-3">
                                    Zadejte Uživatele: 
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
                                </div>

                                <div class="text-center mt-3">
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
                                </div>

                                <label for="vypujceni">Den Vypujceni:</label>
                                    <?php 
                                        $sql="SELECT CURDATE() cd, adddate(CURDATE(), interval 30 day) fd";
                                        $result=mysqli_query($connect,$sql);

                                        while($row = mysqli_fetch_array($result))
                                        {
                                            echo "<input type=\"date\" value=\"" . $row["cd"] . "\"class=\"form-control\" id=\"vypujceni\" name=\"vypujceni\">";
                                        }
                                    ?> 

                                <label for="vraceni">Den Vraceni:</label>
                                    <!--<input type="date" class="form-control" id="vraceni" name="vraceni">
                                    <input type="date" value="-->
                                    <?php
                                        $sql="SELECT CURDATE() cd, adddate(CURDATE(), interval 30 day) fd";
                                        $resultdate=mysqli_query($connect,$sql);

                                        while($row = mysqli_fetch_array($resultdate))
                                        {
                                            echo "<input type=\"date\" value=\"" . $row["fd"] . "\"class=\"form-control\" id=\"vraceni\" name=\"vraceni\">";
                                        }
                        
                                    ?> 
                                <div class="text-center mt-3">
                                    <input id="id8" type="submit" class="btn btn-success">
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