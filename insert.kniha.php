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
            <a href="/" class="here">Katalog</a>
            <a href="autorstvi.php">Autorství</a>
            <button onclick="window.location.href = 'logout.php'"
                style="width: auto">Odhlásit
            </button>
        </div>
        <div id="divInsert">
            <form class="insertFormB" action="catalog.php" method="post">
            
                <label for="nazev">Název Knihy:</label>
                <input type="text" class="form-control" id="nazev" name="nazev">                 
            
                <label for="pocet">Počet Výtisků:</label>
                <input type="number" min="1" class="form-control" id="pocet" name="pocet"> 

                <select id="autor" name="autor">
                    <?php
                        $query = "SELECT id, jmeno, prijmeni FROM autor";
                        $result = mysqli_query($connect, $query);

                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<option value=\"" . $row["id"] . "\">" . $row["jmeno"] . " " . $row["prijmeni"] . "</option>";
                        }
                    ?>
                </select>
                        
                <input id="id4" type="submit" class="button button-primary">
            </form>
        </div>
    </body>
    <?php
        if(isset($_POST, $_POST['nazev'])){
            $nazev = $_POST['nazev'];
            $pocet = $_POST['pocet'];
            $autor = $_POST['autor'];
       
            $stmt = $connect->prepare("insert into katalog(nazev, pocet, autor) values(?, ?, ?)");
            $stmt-> bind_param("sii",$nazev, $pocet, $autor);
            $stmt->execute();
            header('location:catalog.php');
            $stmt->close();
            $connect->close();
        }
    ?>
</html>