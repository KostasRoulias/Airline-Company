<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "./db.php";

$FlightID = $_SESSION['FlightID'];
$FlightNum = $_SESSION['FlightNum'];
$Origin = $_SESSION['Origin'];
$Dest = $_SESSION['Dest'];
$Date = $_SESSION['Date'];
$Arr_Time = $_SESSION['Arr_Time'];
$Dest_Time = $_SESSION['Dest_Time'];
$AirplaneID = $_SESSION['AirplaneID'];
$Manufacturer = $_SESSION['Manufacturer'];
$Name = $_SESSION['Name'];
$ZipCode = $_SESSION['ZipCode'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receive Ticket</title>
    <link rel="stylesheet" href="./home.css">
    <link rel="stylesheet" href="./ticket.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="body">
    <div class="wrapper">
    <nav class="navbar">
        <div class="content">
            <div class="logo"><a href="./home.php"> <img src="./images/logo.png" alt="logo"></a> </div>
            <ul class="menu-list">
                <div class="icon cancel-btn">
                    <i class="fas fa-times"></i>
                </div>
                <li><a href="./home.php">Home</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <span class="buttons">
                <li><a href="./delete.php"><button type="submit" id="logoutBtn">Logout</button></a></li>                </span>
            </ul>
            <div class="icon menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
   
    <div class="row justify-content-center mb-0">
            <div class="col-12 text-center">
                <h2 class="ticketTitle" style="margin-bottom: 0;">Enjoy your Flight!! </h2>
                <h3 class="ticket" style="margin-top: 0;">Your ticket..</h3>
            </div>
    </div>

    <div class="table-container">
        <table class="table table-hover my-bottom-5 table-custom">
            <thead>
                <tr class="text-center">
                    <th scope="col">Flight ID</th>
                    <th scope="col">Flight Number</th>
                    <th scope="col">Origin</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Date</th>
                    <th scope="col">Arrival Time</th>
                    <th scope="col">Departure Time</th>
                    <th scope="col">AirplaneID</th>
                    <th scope="col">Manufacturer</th>
                    <th scope="col">Intermediate City</th>
                    <th scope="col">Zip Code</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">            
                 <tr>
                     <td scope="row"> <?php echo $FlightID; ?> </td>
                     <td> <?php echo $FlightNum; ?> </td>
                     <td> <?php echo $Origin; ?> </td>
                     <td> <?php echo $Dest; ?> </td>
                     <td> <?php echo $Date; ?> </td>
                     <td> <?php echo $Arr_Time; ?> </td>
                     <td> <?php echo $Dest_Time; ?> </td>
                     <td> <?php echo $AirplaneID; ?> </td>
                     <td> <?php echo $Manufacturer; ?> </td>
                     <td> <?php echo $Name; ?> </td>
                     <td> <?php echo $ZipCode; ?> </td>
                     <td>
                        <button class="btn btn-warning" onclick="window.print()">Print</button>
                     </td>
                </tr>

            </tbody>
        </table>
    </div>  

    
   
    <button id="scrollToTopBtn" onclick="scrollToTop()"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button>
    </div>
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
                    <li><a href="./home.php">Home</a></li>
                    <li><a href="./contact.php">Contact</a></li>
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

