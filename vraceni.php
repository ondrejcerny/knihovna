<?php
    require 'config.php';

    $sql="SELECT CURDATE() cd";
    $resultdate=mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($resultdate);

    $stav = "vraceno";
    if(isset($_GET['vraceniid'])){
        $id=$_GET['vraceniid'];
        $sql="UPDATE vypujceni  SET pokuta = case when curdate() > konec then 100 else pokuta end, konec = str_to_date('" . $row["cd"] . "', '%Y-%m-%d'), stav = '" . $stav . "' WHERE id = $id";
        echo "$sql";
        $result=mysqli_query($connect,$sql);
        if(!$result){
            die(mysqli_error($connect));
        }
        $sql= "SELECT id_osoba FROM vypujceni WHERE id= $id";
        $result=mysqli_query($connect,$sql);
        $row = mysqli_fetch_array($result);
        header("location:vypujcka.php? uzivatelid=" . $row["id_osoba"]);
    }
?>