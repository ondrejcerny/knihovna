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

    if(isset($_GET['deleteid'])){
        $id=$_GET['deleteid'];
        $sql="DELETE FROM uzivatele WHERE id=$id";
        $result=mysqli_query($connect,$sql);
        if($result){
            header('location:users.php');
        }else{
            die(mysqli_error($connect));
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <!--<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <link rel="stylesheet" href="knihovna_css.css"/>
    </head>
    <body>
        <div class="topnavigator">
            <a href="home.php">Home</a>
            <a class="here" href="/">Users</a>
            <a href="catalog.php">Catalog</a>
            <a href="vypujcka.php">Book Loan</a>
            <button onclick="window.location.href = 'logout.php';"
            style="width: auto;">Logout</button>
        </div>
        <a href="users.php">Return<a>

        <div>
            <form class="deleteuser" action="users.delete.php" method="post">
                <select id="user" name="user">
                    <?php
                        /*$query = "SELECT  id, jmeno, prijmeni FROM uzivatele";
                        $result = mysqli_query($connect, $query);

                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<option value=\"" . $row["id"] . "\">" . $row["jmeno"] . " " . $row["prijmeni"] . "</option>";
                        }*/
                    ?>
                </select>
                <input id="id8" type="submit" class="button button-primary">
            </form>
        </div>
    </body>

    <?php
        /*if(isset($_POST, $_POST['user'])){
            $user = $_POST['user'];
    
            $connect = new mysqli('localhost','root','root','knihovna_database');
            if($connect->connect_error){
                die('Connection Failed:'.$connect->connect_error);
            }
            else{
                $sql = "DELETE FROM uzivatele WHERE id = '$user'";
            }
            if($connect->query($sql) === TRUE){
                echo "User Deleted";
            }
            else{
                echo "Error";
            }
        }
            //echo "gg";*/
    ?>
</html>-->