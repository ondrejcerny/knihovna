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
            <a href="autorstvi.php">Autorství</a>
            <button onclick="window.location.href = 'logout.php';"
            style="width: auto;">Odhlásit</button>
        </div>

        <div class="container">
        <button type="button" class="btn btn-dark btn-sm mt-3"><a href="users.insert.php" class="text-light">Nový uživatel</button>
            <div class="row mt-4">
                <div class="col mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="display-6 text-center">Uživatelé</h1>
                        </div>
                        <div class="card-body">
                            
                            <table class="table table-bordered text-center">
                                <tr class="bg-dark text-white">
                                    <td>User ID</td>
                                    <td>Jmeno</td>
                                    <td>Přijmení</td>
                                    <td>Email</td>
                                    <td>Operace</td>
                                    
                                </tr>

                                <tr>
                                    <?php             
                                        $sql="SELECT * FROM uzivatele";
                                        $result=mysqli_query($connect,$sql);
                                        if($result){
                                            while($row=mysqli_fetch_assoc($result)){
                                                $id=$row['id'];
                                                $jmeno=$row['jmeno'];
                                                $prijmeni=$row['prijmeni'];
                                                $email=$row['email'];
                                                echo '
                                                    <tr>
                                                        <th scope="row">'.$id.'</th>
                                                        <td>'.$jmeno.'</td>
                                                        <td>'.$prijmeni.'</td>
                                                        <td>'.$email.'</td>
                                                        <td>
                                                            <a href="vypujcka.php? uzivatelid='.$row['id'].'">Vypůjčit</a>
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

        <!--Formular na insert uzivatelu
        <div id="divInsert">
            <form class="insertFormU" action="users.php" method="post">
    
                <label for="jmeno">First name:</label>
                <input id="id2" type="text" class="form-control" id="jmeno" name="jmeno">
    
                <label for="prijmeni">Last name:</label>
                <input id="id2" type="text" class="form-control" id="prijmeni" name="prijmeni">
    
                <label for="email">E-mail:</label>
                <input id="id2" type="text" class="form-control" id="email" name="email">
    
                <label for="tel_cislo">Phone number:</label>
                <input id="id2" type="number" class="form-control" id="tel_cislo" name="tel_cislo">
    
                <label for="rodne_cislo">Personal identification number:</label>
                <input id="id2" type="number" class="form-control" id="rodne_cislo" name="rodne_cislo">

                <label for="adresa">Address:</label>
                <input id="id2" type="text" class="form-control" id="adresa" name="adresa">
    
                <input id="id3" type="submit" class="button button-primary">
            </form>
        </div>-->
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