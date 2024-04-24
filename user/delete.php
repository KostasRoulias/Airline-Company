<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../db.php";

if(isset($_GET['deleteID'])){
    $id = $_GET['deleteID'];


    //Update the PassesThrough table because it has a FK associated to Flight table
    $sql = "DELETE FROM user WHERE id = $id";
    $result = mysqli_query($link, $sql);
    if($result){
        header('location: ./display.php');
    }else{
        die(mysqli_error($link));
    }

}

?>