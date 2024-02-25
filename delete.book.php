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

    if(isset($_GET['deleteid'])){
        $id=$_GET['deleteid'];
        $sql="DELETE FROM katalog WHERE id=$id";
        $result=mysqli_query($connect,$sql);
        if($result){
            header('location:catalog.php');
        }else{
            die(mysqli_error($connect));
        }
    }
?>