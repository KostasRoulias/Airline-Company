<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../db.php";

if(isset($_GET['deleteID'])){
    $interCityid = $_GET['deleteID'];


    //Update the PassesThrough table because it has a FK associated to IntermediateCity table
    $sql1 = "DELETE FROM PassesThrough WHERE CityID = $interCityid";
    $result1 = mysqli_query($link, $sql1);
    if($result1){
        
        $sql2 = "DELETE FROM IntermediateCity WHERE CityID = $interCityid";
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