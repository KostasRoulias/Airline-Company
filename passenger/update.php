<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../db.php";

//Get the id from the url
$id = $_GET['updateID'];

//Query to display previous values from Passenger table
$sql3 = "SELECT * FROM Passenger WHERE PassengerID=$id";
$result3 = mysqli_query($link, $sql3);
$row = mysqli_fetch_assoc($result3);
$name = $row['Name'];
$surname = $row['Surname'];
$phone = $row['Phone'];
$address = $row['Address'];

//Query to display previous values from Boards table
$sql4 = "SELECT * FROM Boards WHERE PassengerID=$id";
$result4 = mysqli_query($link, $sql4);
$row2 = mysqli_fetch_assoc($result4);
$flightID = $row2['FlightID'];

if(isset($_POST["submit"])){
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $surname = mysqli_real_escape_string($link, $_POST['surname']);
    $phone = mysqli_real_escape_string($link, $_POST['phone']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    $flightID = mysqli_real_escape_string($link, $_POST['flightID']);
    
    // Update data into Passenger table
    $sql1 = "UPDATE Passenger SET PassengerID=$id, Name='$name', Surname= '$surname', 
    Phone='$phone', Address='$address' WHERE PassengerID=$id";

    $result1 = mysqli_query($link, $sql1);

    if(!$result1){
        die("Error updating data to Passenger table: " . mysqli_error($link));
    }

    // Update data into Boards table
    $sql2 = "UPDATE Boards SET FlightID='$flightID' WHERE PassengerID=$id";
    $result2 = mysqli_query($link, $sql2);

    if(!$result2){
        die("Error updating data to Boards table: " . mysqli_error($link));
    }
    else{
        header('location:display.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger's Data</title>
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="./passenger.css">
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
                <li><button type="submit" id="logoutBtn">Logout</button></li>
                </span>
            </ul>
            <div class="icon menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
   
    <div class="container my-5 p-4">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h2 class="passengerTitle">Passenger's Data</h2>
            </div>
        </div>
        <form method="post">
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="text" name="flightID" class="form-control" placeholder="Match to Flight ID"
                value="<?php echo $flightID; ?>">
            </div>
            </div>
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Name" 
                value="<?php echo $name; ?>">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="text" name="surname" class="form-control" placeholder="Surname"
                value="<?php echo $surname; ?>">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                value="<?php echo $phone; ?>">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="text" name="address" class="form-control" placeholder="Address"
                value="<?php echo $address; ?>">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <button type="submit" name="submit" class="btn btn-warning">Update</button>
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

