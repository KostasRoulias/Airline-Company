
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../db.php";

if(isset($_POST["submit"])){
    $flightNum = mysqli_real_escape_string($link, $_POST['flightNum']);
    $origin = mysqli_real_escape_string($link, $_POST['origin']);
    $dest = mysqli_real_escape_string($link, $_POST['destination']);
    $date = mysqli_real_escape_string($link, $_POST['date']);
    $arrTime = mysqli_real_escape_string($link, $_POST['arrTime']);
    $destTime = mysqli_real_escape_string($link, $_POST['destTime']);
    $airplaneID = mysqli_real_escape_string($link, $_POST['airplaneID']);
    

    // Insert data into Flight table
    $sql1 = "INSERT into Flight (FlightNum, Origin, Dest, `Date`, Arr_Time, Dest_Time, AirplaneID) VALUES 
    ('$flightNum', '$origin', '$dest', '$date', '$arrTime', '$destTime', '$airplaneID')";

    $result1 = mysqli_query($link, $sql1);

    if(!$result1){
        die(mysqli_error($link));
    }
    // Retrieve IDs of inserted Flight
    // $flightID = mysqli_insert_id($link);

    // // Insert data into IntermediateCity table
    // $sql2 = "INSERT into IntermediateCity (Name, ZipCode) VALUES ('$intermediateCity', '$zipCode')";
    // $result2 = mysqli_query($link, $sql2);

    // if(!$result2){
    //     die(mysqli_error($link));
    // }

    // // Retrieve IDs of inserted IntermediateCity
    // $cityID = mysqli_insert_id($link);
    

    // // // Insert data into PassesThrough table
    // $sql3 = "INSERT INTO PassesThrough (FlightID, CityID) VALUES ('$flightID', '$cityID')";
    // $result3 = mysqli_query($link, $sql3);

    // if($result3){
    //     echo "Data inserted successfully";
    // }else{
    //     die(mysqli_error($link));
    // }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight & Airplane's Data</title>
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="./flight.css">
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
                <h2 class="flightTitle">Flight's Data</h2>
            </div>
        </div>
        <form method="post">
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="text" name="flightNum" class="form-control" placeholder="Flight Number">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="text" name="origin" class="form-control" placeholder="Origin">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="text" name="destination" class="form-control" placeholder="Destination">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="text" name="date" class="form-control" placeholder="Date (YYYY-MM-DD)" 
    pattern="\d{4}-\d{2}-\d{2}" min="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>">
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-md-2 offset-md-3 text-center" >
                <h2 class="ArrivalTime">Arrival Time</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="time" name="arrTime" class="form-control"  step="1">
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-md-6 offset-md-1 text-center">
                <h2 class="destinationTime">Destinantion Time</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="time" name="destTime" class="form-control" placeholder="Destination Time"  step="1">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="text" name="airplaneID" class="form-control" placeholder="Airplane ID">
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
                    <li><a href="">Contact</a></li>
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

