<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../db.php";

if(isset($_POST["submit"])){
    // Sanitize and validate input
    $flightID = mysqli_real_escape_string($link, $_POST['flightID']);
    $empNum = mysqli_real_escape_string($link, $_POST['empNum']);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $surname = mysqli_real_escape_string($link, $_POST['surname']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    $salary = mysqli_real_escape_string($link, $_POST['salary']);
    $phoneNumber1 = mysqli_real_escape_string($link, $_POST['phone1']);
    $description1 = mysqli_real_escape_string($link, $_POST['description1']);
    $phoneNumber2 = mysqli_real_escape_string($link, $_POST['phone2']);
    $description2 = mysqli_real_escape_string($link, $_POST['description2']);
    $aircraftType1 = mysqli_real_escape_string($link, $_POST['aircraftType1']);
    $aircraftType2 = mysqli_real_escape_string($link, $_POST['aircraftType2']);
    $aircraftType3 = mysqli_real_escape_string($link, $_POST['aircraftType3']);

    // Insert data into Staff table
    $sql1 = "INSERT into Staff (EmpNum, `Name`, Surname, `Address`, Salary) VALUES 
    ('$empNum', '$name', '$surname', '$address', '$salary')";

    $result1 = mysqli_query($link, $sql1);

    if(!$result1){
        die("Error inserting into Staff table: " . mysqli_error($link));
    }
    /// Retrieve IDs of inserted Staff ///
    $staffID = mysqli_insert_id($link);

    // Insert data into Phone table
    $sql2 = "INSERT INTO Phone (StaffID, PhoneNumber, Description) VALUES
    ('$staffID', '$phoneNumber1', '$description1'), ('$staffID', '$phoneNumber2', '$description2')";
   
    $result2 = mysqli_query($link, $sql2);

    if(!$result2){
        die("Error inserting data into Phone table: " . mysqli_error($link));
    }

    // Insert data into PilotQualification table
    $sql3 = "INSERT INTO PilotQualification (StaffID, AircraftType) VALUES ('$staffID', '$aircraftType1'), 
    ('$staffID', '$aircraftType2'), ('$staffID', '$aircraftType3')";
    $result3 = mysqli_query($link, $sql3);

    if(!$result3){
        die("Error inserting data into PilotQualification table: " . mysqli_error($link));
    }

    // Insert data into Works table
    if($flightID){
    $sql4 = "INSERT INTO Works (FlightID, StaffID) VALUES ('$flightID', '$staffID')";
    $result4 = mysqli_query($link, $sql4);

        if(!$result4){
            die ("Error inserting data into Works table:" . mysqli_error($link));
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff's Data</title>
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="./staff.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="body">
    <nav class="navbar">
        <div class="content">
            <div class="logo"><a href="../home.php"> <img src="../images/logo.png" alt="logo"></a> </div>
            <ul class="menu-list">
                <div class="icon cancel-btn">
                    <i class="fas fa-times"></i>
                </div>
                <li><a href="../home.php">Home</a></li>
                <li><a href="../admin.php">Admin Panel</a></li>
                <span class="buttons">
                <li><a href="../delete.php"><button type="submit" id="logoutBtn">Logout</button></a></li>                </span>
            </ul>
            <div class="icon menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
   
    <div class="container my-5 p-4">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h2 class="staffTitle">Staff's Data</h2>
            </div>
        </div>
        <form method="post">
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="text" name="flightID" class="form-control" placeholder="Match to Flight ID">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="text" name="empNum" class="form-control" placeholder="Employee's Number">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="text" name="surname" class="form-control" placeholder="Surname">
                </div>
            </div>      
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="text" name="address" class="form-control"  placeholder="Address">
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="number" name="salary" class="form-control" placeholder="Salary €" >
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <div class="form-line">
                        <div class="input-group">
                        <input type="text" name="phone1" class="form-control" placeholder="1. Phone Number">
                        <input type="text" name="description1" class="form-control" placeholder="Description">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <div class="form-line">
                        <div class="input-group">
                        <input type="text" name="phone2" class="form-control" placeholder="2. Phone Number">
                        <input type="text" name="description2" class="form-control" placeholder="Description">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="text" name="aircraftType1" class="form-control" placeholder="1. Aircraft Type (If not place NULL1)" >
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="text" name="aircraftType2" class="form-control" placeholder="2. Aircraft Type (If not place NULL2)" >
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="text" name="aircraftType3" class="form-control" placeholder="3. Aircraft Type (If not place NULL3)" >
                </div>
            </div>
            <div class="row justify-content-center">
            <div class="col-12 text-center">
                <button type="submit" name="submit" class="btn btn-warning">Submit</button>
            </div>
        </div>
        
        </form>
    </div>

   
   
    <button id="scrollToTopBtn" onclick="scrollToTop()"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button>

    <footer>
        <div class="footer1-container">
            <div class="footer-content">
                <h3>Contact Us</h3>
                <p>Email: skyvoyageairways@gmail.com</p>
                <p>Phone: +30XXXXXXXX</p>
                <p>Address: Agias Irinis, 31 Marousi</p>
            </div>
            <div class="footer-content">
                <h3>Quick Links</h3>
                <ul class="list1">
                    <li><a href="../home.php">Home</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-content">
                <h3>Follow Us</h3>
                <ul class="social-icons">
                    <li><a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://twitter.com/"><i class="fab fa-twitter"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="bottom-bar">
            <p>&copy; 2024 SkyVoyage Airways. All rights reserved.</p>
        </div>
    </footer>

    <script src="../home1.js" charset="utf-8"></script>
</body>
</html>

