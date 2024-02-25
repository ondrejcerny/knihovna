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

    function dispaly_data(){
        global $connect;
        $query = "SELECT * FROM katalog";
        $result = mysqli_query($connect,$query);
        return $result;
    }

    $result = dispaly_data();
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

        <div class="container">
            <button type="button" class="btn btn-dark btn-sm mt-4"><a href="insert.kniha.php" class="text-light">Přidat Knihu</a></button>
            <div class="row mt-4">
                <div class="col mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="display-6 text-center">Katalog</h1>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered text-center">
                                <tr class="bg-dark text-white">
                                    <td>Kniha ID</td>
                                    <td>Nazev Knihy</td>
                                    <td>Počet výtisků</td>
                                    <td>Napsal</td>
                                    <td>Delete</td>
                                </tr>

                                <tr>
                                    <?php             
                                        $sql="SELECT * FROM katalog";
                                        $result=mysqli_query($connect,$sql);
                                        if($result){
                                            while($row=mysqli_fetch_assoc($result)){
                                                $id=$row['id'];
                                                $nazev=$row['nazev'];
                                                $pocet=$row['pocet'];
                                                $autor=$row['autor'];
                                                echo '
                                                    <tr>
                                                        <th scope="row">'.$id.'</th>
                                                        <td>'.$nazev.'</td>
                                                        <td>'.$pocet.'</td>
                                                        <td>'.$autor.'</td>
                                                        <td><a href="delete.book.php? deleteid='.$row['id'].'">Smazat</a></td>
                                                    </tr>';
                                            }
                                        }                                   
                                ?>
                                </tr>
                                

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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