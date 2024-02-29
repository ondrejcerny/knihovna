<?php
    require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="knihovna_css.css"/>
    <link rel="stylesheet" href="http://localhost/projekt_knihovna/bootstrap.min.css"/>
    </head>
    <body>
        <div class="topnavigator">
            <a href="home.php">Domů</a>
            <a href="users.php">Uživatelé</a>
            <a href="/" class="here">Katalog</a>
            <a href="autorstvi.php">Autoři</a>
            <button onclick="window.location.href = 'logout.php'"
                style="width: auto">Odhlásit
            </button>
        </div>
        <button type="button" class="btn btn-dark btn-sm mt-3"><a href="catalog.php" class="text-light">Zpět</a></button>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card bg-dark text-white" >
                        <div class="card-body">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                            </svg>
                            <h1>Přidejte Knihu</h1>
                            <form class="insertFormB" action="catalog.php" method="post">
            
                                <label for="nazev">Název Knihy:</label>
                                <input type="text" class="form-control" id="nazev" name="nazev" placeholder="Zadejte Název Knihy..">                 
            
                                <label for="pocet">Počet Výtisků:</label>
                                <input type="number" min="1" class="form-control" id="pocet" name="pocet" placeholder="Zadejte Počet Výtisků.."> 

                                <div class="text-center mt-3">
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
                                </div>

                                <div class="text-center mt-3">
                                    <input id="id4" type="submit" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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