<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../db.php";

if(isset($_GET['deleteID'])){
    $passengerid = $_GET['deleteID'];


    //Update the Boards table because it has a FK associated to Passenger table
    $sql1 = "DELETE FROM Boards WHERE PassengerID = $passengerid";
    $result1 = mysqli_query($link, $sql1);
    if($result1){
        
        $sql2 = "DELETE FROM Passenger WHERE PassengerID = $passengerid";
        $result2 = mysqli_query($link, $sql2);
        if($result2){
            header('location: ./display.php');
        }else{
            die(mysqli_error($link));
        }
    }else{
        die(mysqli_error($link));
    }
   
}

?>