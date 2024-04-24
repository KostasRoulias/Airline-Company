<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../db.php";

if(isset($_GET['deleteID'])){
    $flightid = $_GET['deleteID'];


    //Update the PassesThrough table because it has a FK associated to Flight table
    $sql1 = "DELETE FROM PassesThrough WHERE FlightID = $flightid";
    $result1 = mysqli_query($link, $sql1);

    //Update the Boards table because it has a FK associated to Flight table
    $sql2 = "DELETE FROM Boards WHERE FlightID = $flightid";
    $result2 = mysqli_query($link, $sql2);
    
    //Update the Works table because it has a FK associated to Flight table
    $sql3 = "DELETE FROM Works WHERE FlightID = $flightid";
    $result3 = mysqli_query($link, $sql3);
    
    //Check if there are any records in the Flight table with the specified AirplaneID
    $sql4 = "SELECT * FROM Flight WHERE AirplaneID = $flightid";
    $result4 = mysqli_query($link, $sql4);

    if($result1 && $result2 && $result3 && mysqli_num_rows($result4) == 0){
        //Delete from the Flight table
        $sql5 = "DELETE FROM Flight WHERE FlightID = $flightid";
        $result5 = mysqli_query($link, $sql5);
        if($result4){
            header('location: ./display.php');
        }else{
            die(mysqli_error($link));
        }
    }else{
        echo "Cannot delete the airplane because it is associated with existing flights.";
    }
   
}

?>