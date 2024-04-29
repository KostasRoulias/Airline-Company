<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../db.php";

//Get the id from the url
$id = $_GET['updateID'];

//Query to display the previous values
$sql = "SELECT * from Airplane  WHERE AirplaneID=$id";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$serNum = $row['SerNum'];
$manufacturer = $row['Manufacturer'];
$model = $row['Model'];

if(isset($_POST["submit"])){
    
    $serNum = mysqli_real_escape_string($link, $_POST['serNum']);
    $manufacturer = mysqli_real_escape_string($link, $_POST['manufacturer']);
    $model = mysqli_real_escape_string($link, $_POST['model']);
    
    // Update data to Airplane table
    $sql1 = "UPDATE Airplane SET AirplaneID=$id, SerNum='$serNum', Manufacturer='$manufacturer', Model='$model' 
            WHERE AirplaneID=$id";

    $result1 = mysqli_query($link, $sql1);

    if($result1){
        header('location:display.php');
    }else{
        die(mysqli_error($link));
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airplane's Data</title>
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="./airplane.css">
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
                <h2 class="airplaneTitle">Airplane's Data (Update)</h2>
            </div>
        </div>
        <form method="post">
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="text" name="serNum" class="form-control" placeholder="Airplane's Serial Number" 
                    value="<?php echo $serNum; ?>">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="text" name="manufacturer" class="form-control" placeholder="Manufacturer" 
                value="<?php echo $manufacturer; ?>">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <input type="text" name="model" class="form-control" placeholder="Model" value="<?php echo $model; ?>">
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

