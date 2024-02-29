<?php
    require 'config.php';

    if(isset($_GET['deleteid'])){
        $id=$_GET['deleteid'];
        $query="SELECT count(*) pocet FROM vypujceni WHERE id_kniha = $id AND (stav = 'aktivni' OR pokuta > 0)";
        $result = mysqli_query($connect,$query);
        if(!$result){
            die(mysqli_error($connect));
        }
        $row = mysqli_fetch_array($result);
        if($row['pocet'] == 0){
            $sql="DELETE FROM katalog WHERE id=$id";
            $result=mysqli_query($connect,$sql);
            if($result){
                header('location:catalog.php');
            }else{
                die(mysqli_error($connect));
            }
        }
        else{
            echo 'nejprve uzavrete vypujcky s touto knihou';
        }
    }
?>