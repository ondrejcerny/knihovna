<?php
    require 'config.php';

    if(isset($_GET['deleteid'])){
        $id=$_GET['deleteid'];
        $query="SELECT count(*) pocet FROM katalog WHERE autor = $id";
        $result = mysqli_query($connect,$query);
        if(!$result){
            die(mysqli_error($connect));
        }
        $row = mysqli_fetch_array($result);
        if($row['pocet'] == 0){
            $sql="DELETE FROM autor WHERE id=$id";
            $result=mysqli_query($connect,$sql);
            if($result){
            header('location:autorstvi.php');
            }else{
                die(mysqli_error($connect));
            }
        }
        else{
            echo 'nejprve odstrante knihy autora';
        }
    }
    
?>

