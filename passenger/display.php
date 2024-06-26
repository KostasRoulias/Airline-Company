<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../db.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger's Data</title>
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="./display.css">
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
   
    <div class="container my-5 p-4 mb-0">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h2 class="displayTitle">Passenger's Data (Display)</h2>
            </div>
        </div>
    </div>

   <div class="container">
        <button class="btn btn-warning my-5"><a href="./passenger.php"
                class="text-dark">Add Passenger</a>
        </button>
        <button class="btn btn-warning my-5"><a href="../admin.php"
                class="text-dark">Back to menu</a>
        </button>
    </div>
    <div class="table-container">
        <table class="table table-hover my-bottom-5 table-custom">
            <thead>
                <tr>
                <th scope="col">Passenger ID</th>
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Address</th>
                <th scope="col">Operations</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">

            <?php
            
            $sql = "SELECT * FROM Passenger";
            $result = mysqli_query($link, $sql);
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['PassengerID'];
                    $name = $row['Name'];
                    $surname = $row['Surname'];
                    $phone = $row['Phone'];
                    $address = $row['Address'];

                    echo ' <tr>
                        <th scope="row">'.$id.'</th>
                        <td>'.$name.'</td>
                        <td>'.$surname.'</td>
                        <td>'.$phone.'</td>
                        <td>'.$address.'</td>
                        <td>
                            <button class="btn btn-primary"><a href="./update.php?updateID='.$id.'" class="text-light">Update</a></button>
                            <button class="btn btn-danger"><a href="./delete.php?deleteID='.$id.'" class="text-light">Delete</a></button>
                        </td>

                    </tr> ';
                }
            }

            
            ?>
            

            </tbody>
        </table>
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

