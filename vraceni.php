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
            <a href="users.html">Users</a>
            <a href="catalog.php">Catalog</a>
            <a class="here" href="/">Book Loan</a>
            <button onclick="window.location.href = 'logout.php';"
            style="width: auto;">Logout</button>
        </div>

        <div>
            <form action="vraceni.php" method="post">
                <select id="vypujckavraceni" name="vypujckavraceni">
                    <?php
                        $query = "SELECT id, id_osoba, id_kniha, zacatek FROM vypujceni";
                        $result = mysqli_query($connect, $query);

                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<option value=\"" . $row["id"] . "\">" . $row["id_osoba"] . " neco: " . $row["id_kniha"] . " vypujceno dne: " . $row["zacatek"] . "</option>";
                        }
                    ?>
                </select>
        
                <label for="datumvraceni">Den Vraceni:</label>
                <input type="date" class="form-control" id="datumvraceni" name="datumvraceni">

                <input id="id8" type="submit" class="button button-primary">
            </form> 
        </div>
        <a href="vypujcka.php">Return<a>


    </body>
</html>
<?php
    $stav = 'vraceno';
    if(isset($_POST["vypujckavraceni"])){
        $vypujckavraceni = $_POST["vypujckavraceni"];
        $datumvraceni = $_POST["datumvraceni"];

        $query ="UPDATE vypujceni  SET konec = '$datumvraceni', stav = '$stav' WHERE id = $vypujckavraceni";
        mysqli_query ($connect,$query);
        echo "<script> alert('Vraceno'); </script>";
    }
?>