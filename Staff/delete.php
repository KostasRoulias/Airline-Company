<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../db.php";

if(isset($_GET['deleteID'])){
    $staffid = $_GET['deleteID'];


    //Update the Works table because it has a FK associated to Staff table
    $sql1 = "DELETE FROM Works WHERE StaffID = $staffid";
    $result1 = mysqli_query($link, $sql1);

    //Update the Phone table because it has a FK associated to Staff table
    $sql2 = "DELETE FROM Phone WHERE StaffID = $staffid";
    $result2 = mysqli_query($link, $sql2);
    
    //Update the PilotQualification table because it has a FK associated to Staff table
    $sql3 = "DELETE FROM PilotQualification WHERE StaffID = $staffid";
    $result3 = mysqli_query($link, $sql3);

    if($result1 && $result2 && $result3){
        //Delete from the Staff table
        $sql4 = "DELETE FROM Staff WHERE StaffID = $staffid";
        $result4 = mysqli_query($link, $sql4);
        if($result4){
            header('location: ./display.php');
        }else{
            die(mysqli_error($link));
        }
    }else{
        die(mysqli_error($link));
    }
   
}

?>