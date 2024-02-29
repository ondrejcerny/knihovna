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
        <link rel="stylesheet" href="http://localhost/projekt_knihovna/users.css"/>
        <link rel="stylesheet" href="http://localhost/projekt_knihovna/bootstrap.min.css"/>
    </head>
    <body>

        <div class="topnavigator">
            <a href="home.php">Domů</a>
            <a class="here" href="/">Uživatelé</a>
            <a href="catalog.php">Katalog</a>
            <a href="autorstvi.php">Autoři</a>
            <button onclick="window.location.href = 'logout.php';"
            style="width: auto;">Odhlásit</button>
        </div>

        <div class="container">
        <button type="button" class="btn btn-dark btn-sm mt-3"><a href="users.insert.php" class="text-light">Nový uživatel</a></button>
            <div class="row mt-4">
                <div class="col mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="display-6 text-center">Uživatelé</h1>
                        </div>
                        <div class="card-body">
                            
                            <table class="table table-bordered text-center">
                                <tr class="bg-dark text-white">
                                    <td>ID Uživatele</td>
                                    <td>Jmeno</td>
                                    <td>Přijmení</td>
                                    <td>Email</td>
                                    <td>Pokuty</td>
                                    <td>Operace</td>
                                    
                                    
                                </tr>

                                <tr>
                                    <?php             
                                        $sql="SELECT u.id, u.jmeno, u.prijmeni, u.email, case when sum(v.pokuta) is null then 0 else sum(v.pokuta) end pokuta
                                            from uzivatele u
                                             left outer join vypujceni v on u.id = v.id_osoba
                                            group by u.id, u.jmeno, u.prijmeni, u.email";
                                        $result=mysqli_query($connect,$sql);
                                        if($result){
                                            while($row=mysqli_fetch_assoc($result)){
                                                $id=$row['id'];
                                                $jmeno=$row['jmeno'];
                                                $prijmeni=$row['prijmeni'];
                                                $email=$row['email'];
                                                $pokuta=$row['pokuta'];
                                                echo '
                                                    <tr>
                                                        <th scope="row">'.$id.'</th>
                                                        <td>'.$jmeno.'</td>
                                                        <td>'.$prijmeni.'</td>
                                                        <td>'.$email.'</td>
                                                        <td>'.$pokuta.'</td>
                                                        <td>
                                                            <a href="vypujcka.php? uzivatelid='.$row['id'].'">Výpujčky</a>
                                                            <a href="users.delete.php? deleteid='.$row['id'].'">Smazat</a>
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
</html>

<?php

    if(isset($_POST, $_POST['jmeno'])){
        $jmeno = $_POST['jmeno'];
        $prijmeni = $_POST['prijmeni'];
        $email = $_POST['email'];
        $tel_cislo = $_POST['tel_cislo'];
        $rodne_cislo = $_POST['rodne_cislo'];
        $adresa = $_POST['adresa'];

        // propojeni s databazi
        $connect = new mysqli('localhost','root','root','knihovna_database');
    if($connect->connect_error){
        die('Connection Failed:'.$connect->connect_error);
    }else{
        $stmt = $connect->prepare("insert into uzivatele(jmeno, prijmeni, adresa, email, rodne_cislo, tel_cislo)
            values(?, ?, ?, ?, ?, ?)");
        $stmt-> bind_param("ssssii",$jmeno, $prijmeni, $adresa, $email, $rodne_cislo, $tel_cislo);
        $stmt->execute();
        echo "registration successfully...";
        $stmt->close();
        $connect->close();

    }

    }
?>