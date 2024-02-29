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

    if(isset($_GET['uzivatelid'])){
        $id=$_GET['uzivatelid'];
        $sqlUzivatel="SELECT jmeno, prijmeni, id FROM uzivatele WHERE id=$id";
        //echo "$sqlUzivatel";
        $resultUzivatel=mysqli_query($connect,$sqlUzivatel);
        if($resultUzivatel){
            $row=mysqli_fetch_assoc($resultUzivatel);
            $uzivatel=$row['jmeno'] . " " . $row['prijmeni'];
        }else{
            die(mysqli_error($connect));
        }
/*
        $sql="SELECT id, id_kniha, zacatek, konec, stav FROM vypujceni WHERE id_osoba=$iduzivatel";
        $result=mysqli_query($connect,$sql);
        if($result){
            //header('location:users.php');
        }else{
            die(mysqli_error($connect));
        }*/
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <link rel="stylesheet" href="http://localhost/projekt_knihovna/knihovna_css.css"/>
        <link rel="stylesheet" href="http://localhost/projekt_knihovna/users.css"/>
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
        <div class="container">
        <button type="button" class="btn btn-dark btn-sm mt-3"><a href="insert.vypujcky.php" class="text-light">Vypůjčit knihu</a></button>
            <div class="row mt-4">
                <div class="col mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="display-6 text-center"><?php echo "$uzivatel"?> Výpujčky</h1>
                        </div>
                        <div class="card-body">
                            
                            <table class="table table-bordered text-center">
                                <tr class="bg-dark text-white">
                                    <td>ID Výpujčky</td>
                                    <td>Kniha</td>
                                    <td>Začátek</td>
                                    <td>Konec</td>
                                    <td>Stav</td>
                                    <td>Operace</td>
                                    
                                </tr>

                                <tr>
                                    <?php             
                                        $sql="SELECT v.id, k.nazev, v.zacatek, v.konec, v.stav FROM vypujceni v, katalog k where v.id_osoba=$id and v.id_kniha = k.id";
                                        $result=mysqli_query($connect,$sql);
                                        if($result){
                                            while($row=mysqli_fetch_assoc($result)){
                                                $idvypujcka=$row['id'];
                                                $nazev=$row['nazev'];
                                                $zacatek=$row['zacatek'];
                                                $konec=$row['konec'];
                                                $stav=$row['stav'];
                                                echo '
                                                    <tr>
                                                        <th scope="row">'.$idvypujcka.'</th>
                                                        <td>'.$nazev.'</td>
                                                        <td>'.$zacatek.'</td>
                                                        <td>'.$konec.'</td>
                                                        <td>'.$stav.'</td>
                                                        <td>';
                                                if ($stav=="aktivni"){
                                                    echo '<a href="vraceni.php? vraceniid='. $idvypujcka .'">Uzavřít</a>';
                                                }
                                                            
                                                if ($stav=="vraceno") {

                                                      
                                                       echo '
                                                       <a href="pokuta.php? vraceniid='. $idvypujcka .'">Zaplatit</a>
                                                
                                                       </td>
                                                     </tr>';
                                                }
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
</html>