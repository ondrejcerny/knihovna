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
            <a href="/" class="here">Catalog</a>
            <a href="vypujcka.php">Book Loan</a>
            <button onclick="window.location.href = 'logout.php'"
                style="width: auto">Logout
            </button>
        </div>

        <div id="divInsert">
            <form class="insertFormB" action="catalog.php" method="post">
            
                <label for="nazev">Name:</label>
                <input type="text" class="form-control" id="nazev" name="nazev">                 
            
                <label for="pocet">How many:</label>
                <input type="number" class="form-control" id="pocet" name="pocet"> 

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

    <div id="divInsert1">
        <form class="insertFormB" action="autor.php" method="post">
            
                <label for="jmenoautor">Jmeno:</label>
                <input type="text" class="form-control" id="jmeno" name="jmeno">
        
                <label for="prijmeni">Prijmeni:</label>
                <input type="text" class="form-control" id="prijmeni" name="prijmeni">
            
                <label for="datumnarozeni">Datum narozeni:</label>
                <input type="date" class="form-control" id="datumnarozeni" name="datumnarozeni">
            
            
            <input id="id6" type="submit" class="button button-primary">
        </form>
    </div>

    <div>
    <a href="delete.author.php">Delete an Author:<a> Or <a href="delete.book.php"> a Book:<a>
    </div>

     <h1>TODO: tabulka knih</h1>

<?php
    if(isset($_POST, $_POST['nazev'])){
        $nazev = $_POST['nazev'];
        $pocet = $_POST['pocet'];
        $autor = $_POST['autor'];
   
        $stmt = $connect->prepare("insert into katalog(nazev, pocet, autor) values(?, ?, ?)");
        $stmt-> bind_param("sii",$nazev, $pocet, $autor);
        $stmt->execute();
        echo "registration successfully...";
        $stmt->close();
        $connect->close();
    }
?>
</body>
</html>