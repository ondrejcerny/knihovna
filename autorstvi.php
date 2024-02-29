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
            <a href="catalog.php">Katalog</a>
            <a class="here" href="autorstvi.php">Autoři</a>
            <button onclick="window.location.href = 'logout.php'"
                style="width: auto">Odhlásit
            </button>
        </div>

        <div class="container">
            <button type="button" class="btn btn-dark btn-sm mt-4"><a href="autor.php" class="text-light">Přidat Autora</a></button>
            <div class="row mt-3">
                <div class="col mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="display-6 text-center">Autoři</h1>
                        </div>
                        <div class="card-body">
                            
                            <table class="table table-bordered text-center">
                                <tr class="bg-dark text-white">
                                    <td>ID Autora</td>
                                    <td>Jmeno</td>
                                    <td>Přijmení</td>
                                    <td>Datum Narození</td>
                                    <td>Operace</td>                          
                                </tr>

                                <tr>
                                    <?php             
                                        $sql="SELECT * FROM autor";
                                        $result=mysqli_query($connect,$sql);
                                        if($result){
                                            while($row=mysqli_fetch_assoc($result)){
                                                $id=$row['id'];
                                                $jmeno=$row['jmeno'];
                                                $prijmeni=$row['prijmeni'];
                                                $datumnarozeni=$row['datum_narozeni'];
                                                echo '
                                                    <tr>
                                                        <th scope="row">'.$id.'</th>
                                                        <td>'.$jmeno.'</td>
                                                        <td>'.$prijmeni.'</td>
                                                        <td>'.$datumnarozeni.'</td>
                                                        <td>
                                                            <a href="delete.author.php? deleteid='.$row['id'].'">Smazat</a>
                                                        </td>
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