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
    </head>
    <body>
        <div class="topnavigator">
            <a href="home.php">Home</a>
            <a href="users.php">Users</a>
            <a class="here" href="/">Catalog</a>
            <a href="vypujcka.php">Book Loan</a>
            <button onclick="window.location.href = 'logout.php';"
            style="width: auto;">Logout</button>
        </div>
        <a href="catalog.php">Return<a>

        <div>
            <form class="deleteautor" action="delete.author.php" method="post">
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
                <input id="id8" type="submit" class="button button-primary">
            </form>
        </div>
    </body>

    <?php
        if(isset($_POST, $_POST['autor'])){
            $autor = $_POST['autor'];
    
            $connect = new mysqli('localhost','root','root','knihovna_database');
            if($connect->connect_error){
                die('Connection Failed:'.$connect->connect_error);
            }
            else{
                $sql = "DELETE FROM autor WHERE id = '$autor'";
            }
            if($connect->query($sql) === TRUE){
                echo "Autor Deleted";
            }
            else{
                echo "Error";
            }
        }
            //echo "gg";
    ?>
</html>