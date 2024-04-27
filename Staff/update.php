<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../db.php";

//Get the id from the url
$id = $_GET['updateID'];

//Query to display previous values from Staff table
$sql8 = "SELECT * FROM Staff WHERE StaffID=$id";
$result8 = mysqli_query($link, $sql8);

//Query to display previous values from Works table
$sql9 = "SELECT * FROM Works WHERE StaffID=$id";
$result9 = mysqli_query($link, $sql9);

//Query to display previous values from Phone table
$sql10 = "SELECT * FROM Phone WHERE StaffID=$id";
$result10 = mysqli_query($link, $sql10);

//Query to display previous values from PilotQualification table
$sql11 = "SELECT * FROM PilotQualification WHERE StaffID=$id";
$result11 = mysqli_query($link, $sql11);

// Check if the query returned any results before accessing them
if ($result8 && $result9 && $result10 && $result11) {
    $row = mysqli_fetch_assoc($result8);
    $empNum = $row['EmpNum'];
    $name = $row['Name'];
    $surname = $row['Surname'];
    $address = $row['Address'];
    $salary = $row['Salary'];

    $row2 = mysqli_fetch_assoc($result9);
    $flightID = $row2 ? $row2['FlightID'] : '';

    $row3 = mysqli_fetch_assoc($result10);
    $phoneNumber1 = $row3 ? $row3['PhoneNumber'] : '';
    $description1 = $row3 ? $row3['Description'] : '';
    
    $row4 = mysqli_fetch_assoc($result10);
    $phoneNumber2 = $row4 ? $row4['PhoneNumber'] : '';
    $description2 = $row4 ? $row4['Description'] : '';

    $row5 = mysqli_fetch_assoc($result11);
    $aircraftType1 = $row5 ? $row5['AircraftType'] : '';
    
    $row6 = mysqli_fetch_assoc($result11);
    $aircraftType2 = $row6 ? $row6['AircraftType'] : '';
    
    $row7 = mysqli_fetch_assoc($result11);
    $aircraftType3 = $row7 ? $row7['AircraftType'] : '';
}

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

    // Update data to Staff table
    $sql1 = "UPDATE Staff SET StaffID=$id, EmpNum='$empNum', Name='$name', Surname='$surname',
         Address='$address', Salary='$salary' WHERE StaffID=$id";

    $result1 = mysqli_query($link, $sql1);

    if(!$result1){
        die("Error updating data to Staff table: " . mysqli_error($link));
    }

    // Update data to Phone table
    $sql2 = "UPDATE Phone 
         SET PhoneNumber = '$phoneNumber1', Description = '$description1' 
         WHERE StaffID = $id AND Description = '$description1'";
    $result2 = mysqli_query($link, $sql2);
    //Update for second phone number
    $sql3 = "UPDATE Phone 
         SET PhoneNumber = '$phoneNumber2', Description = '$description2' 
         WHERE StaffID = $id AND Description = '$description2'";
    $result3 = mysqli_query($link, $sql3);

    if (!$result2 || !$result3) {
        die("Error updating data into Phone table: " . mysqli_error($link));
    }
    
    // Update data to PilotQualification table
    $sql4 = "UPDATE PilotQualification SET AircraftType = '$aircraftType1'
               WHERE StaffID = '$id' AND AircraftType = '$aircraftType1'";
    $result4 = mysqli_query($link, $sql4);
    
    $sql5 = "UPDATE PilotQualification SET AircraftType = '$aircraftType2'
               WHERE StaffID = '$id' AND AircraftType = '$aircraftType2'";
    $result5 = mysqli_query($link, $sql5);
    
    $sql6 = "UPDATE PilotQualification SET AircraftType = '$aircraftType3'
               WHERE StaffID = '$id' AND AircraftType = '$aircraftType3'";
    $result6 = mysqli_query($link, $sql6);

    if (!$result4 || !$result5 || !$result6) {
        die("Error updating data into PilotQualification table: " . mysqli_error($link));
    }

    // Update data into Works table
    if($flightID){
    $sql7 = "UPDATE Works SET FlightID='$flightID' WHERE StaffID = '$id'";
    $result7 = mysqli_query($link, $sql7);

        if(!$result7){
            die ("Error updating data to Works table:" . mysqli_error($link));
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
                    <input type="text" name="flightID" class="form-control" placeholder="Match to Flight ID"
                    value="<?php echo $flightID; ?>">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="text" name="empNum" class="form-control" placeholder="Employee's Number" 
                    value="<?php echo $empNum; ?>">
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
                    value="<?php echo $surname ; ?>">
                </div>
            </div>      
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="text" name="address" class="form-control"  placeholder="Address"
                    value="<?php echo $address; ?>">
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="number" name="salary" class="form-control" placeholder="Salary €" 
                    value="<?php echo $salary; ?>">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <div class="form-line">
                        <div class="input-group">
                        <input type="text" name="phone1" class="form-control" placeholder="1. Phone Number"
                        value="<?php echo isset($phoneNumber1) ? $phoneNumber1 : ''; ?>">
                        <input type="text" name="description1" class="form-control" placeholder="Description"
                        value="<?php echo isset($description1) ? $description1 : ''; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <div class="form-line">
                        <div class="input-group">
                        <input type="text" name="phone2" class="form-control" placeholder="2. Phone Number"
                        value="<?php echo isset($phoneNumber2) ? $phoneNumber2 : ''; ?>">
                        <input type="text" name="description2" class="form-control" placeholder="Description"
                        value="<?php echo isset($description2) ? $description2 : ''; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="text" name="aircraftType1" class="form-control" placeholder="1. Aircraft Type (If not place NULL1)" 
                    value="<?php echo isset($aircraftType1) ? $aircraftType1 : ''; ?>">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="text" name="aircraftType2" class="form-control" placeholder="2. Aircraft Type (If not place NULL2)" 
                    value="<?php echo isset($aircraftType2) ? $aircraftType2 : ''; ?>">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <input type="text" name="aircraftType3" class="form-control" placeholder="3. Aircraft Type (If not place NULL3)" 
                    value="<?php echo isset($aircraftType3) ? $aircraftType3 : ''; ?>">
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

