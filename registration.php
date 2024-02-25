<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "root", "knihovna_database");

    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirmpassword"];
        $duplicate = mysqli_query($conn, "SELECT username, email FROM spravce  WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
        ?>       
            <div class="alert alert-danger" role="alert">
               Chyba! <a href="#" class="alert-link">Uživatelské Jméno nebo Email jsou již zabrané</a>.
            </div>
        <?php
       }
    else {
        if($password == $confirmpassword){
            $query ="INSERT INTO spravce (username, email, pasword) VALUES('$username', '$email', '$password')";
            mysqli_query ($conn,$query);
            ?> 
                <div class="alert alert-success" role="alert">
                <a href="#" class="alert-link">Registrace proběhla úspěšně</a>.
                </div>
            <?php
        }
        else {
            ?>       
                <div class="alert alert-danger" role="alert">
                    Chyba! <a href="#" class="alert-link">Špatně Potvrzené Heslo</a>.
                </div>
            <?php
        }
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration</title>
        <!--<link rel="stylesheet" href="registration.css"/>-->
        <link rel="stylesheet" href="http://localhost/projekt_knihovna/bootstrap.min.css"/>
    </head>
    <body>
    
    <div class="container mt-4 pt-4">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card bg-dark text-white" >
                    <div class="card-body">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                        <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5"/>
                        <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z"/>
                        </svg>
                        <h1>Registrace</h1>
                            <form method="post" action="" autocomplete="off">
                                <label for="username">Uživatelské jméno:</label>
                                <input type="text" id="username" name="username" class="form-control my-3 py-2" placeholder="Napište Vaše Jméno..">

                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control my-3 py-2" placeholder="Napište Váš Email..">
      
                                <label for="password">Heslo:</label>
                                <input type="password" id="password" name="password" class="form-control my-3 py-2" placeholder="Napište Vaše Heslo..">

                                <label for="confirmpassword">Potvrďte Heslo:</label>
                                <input type="password" id="confirmpassword" name="confirmpassword" class="form-control my-3 py-2" placeholder="Potvrďte Vaše Heslo..">
                                <div class="text-center mt-3">
                                    <input type="submit" name="submit" value="Zaregistrovat" class="btn btn-success" action="registration.php"></input>
                                </div>

                                <div class="text-center mt-3">
                                    <a href="index.html">Přihlášení<a>
                                </div>
                                </form>            
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>