<?php
    require 'config.php';

    if(isset($_GET['vraceniid'])){
        $id=$_GET['vraceniid'];
        $sql="UPDATE vypujceni SET pokuta = NULL WHERE id=$id";
        $result=mysqli_query($connect,$sql);
        if(!$result){
            die(mysqli_error($connect));
        }
        header("location: users.php");
    }
    else{
        echo "error";
    }
?>
