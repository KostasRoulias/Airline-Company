<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../db.php";

if(isset($_GET['deleteID'])){
    $id = $_GET['deleteID'];


    //Update the Flight table because it has a FK associated to Airplane table
    $sql1 = "UPDATE Flight SET AirplaneID = NULL WHERE AirplaneID = $id";
    $result1 = mysqli_query($link, $sql1);
    if(!$result1){
        die(mysqli_error($link));
    }

    //Delete from the Airplane table
    $sql = "DELETE from Airplane WHERE AirplaneID = $id";
    $result = mysqli_query($link, $sql);
    if($result){
        header('location: ./display.php');
    }else{
        die(mysqli_error($link));
    }
}

?>