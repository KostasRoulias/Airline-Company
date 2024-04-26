
<?php

//registration

session_start(); // Start the session

require_once "db.php";

function setup_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$emailregister = $passwordregister = "";
$emailregister_err = $passwordregister_err = "";
$registration_success_msg = $registration_error_msg = "";
//$registration_success = false;

// //Registration method
 if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])){
   
//     //validate email
    if(empty(trim($_POST["emailRegister"])) || !filter_var($_POST["emailRegister"], FILTER_VALIDATE_EMAIL)){
        $emailregister_err = "*";
      
    } else{
        $sql = "SELECT id FROM user WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_emailregister);

            $param_emailregister = setup_data($_POST["emailRegister"]);

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $emailregister_err = "This email already exists.";
                }else{
                    $emailregister = setup_data($_POST["emailRegister"]);
                }
            } else{
                echo "Something went wrong. Try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    //validate password
    if(empty(trim($_POST["passwordRegister"]))){
        $passwordregister_err = "*";
        
    } elseif(strlen(trim($_POST["passwordRegister"])) < 6){
        $passwordregister_err = "Password must have at least 6 characters.";
        
    } else{
        $passwordregister = setup_data($_POST["passwordRegister"]);
    }

    if(empty($emailregister_err) && empty($passwordregister_err)){
        $sql = "INSERT INTO user (email, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_emailregister, $param_passwordregister);

            $param_emailregister = $emailregister;
            $param_passwordregister = password_hash($passwordregister, PASSWORD_DEFAULT);
            //$param_passwordregister = $passwordregister;

            if(mysqli_stmt_execute($stmt)){
                //$registration_success = true;
               $_SESSION['registration_success'] = true;
               $registration_success_msg = "Registration successful!";
                header("location: home.php");
                exit;
            }else{
                $registration_error_msg = "Something went wrong. Try again later.";

                //echo "Something went wrong. Try again later.";
            }
            mysqli_stmt_close($stmt);
        }
        
    } else{
        $_SESSION['registration_success'] = false;
    }
    mysqli_close($link);
    
}

unset($_SESSION['registration_success']);


//end of registration
?>

<?php 
//login method

//initialize the session

// Check if the user is already logged in, if yes then redirect him to welcome page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: home.php");
//     exit;
// }

require_once "db.php";

$email = $password = "";
$email_err = $password_err =$login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Login"])) {

    if(empty(trim($_POST["emailLogin"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST['emailLogin']);
    }

    if(empty(trim($_POST["passwordLogin"]))){
        $password_err = "Please enter password.";
    } else{
        $password = trim($_POST['passwordLogin']);
    }
    
    if(empty($email_err) && empty($password_err)){

        $sql = "SELECT id, email, password FROM user WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = $email;

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){

                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                       if(password_verify($password, $hashed_password)){
                       
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["emailLogin"] = $email;

                         // Check if email and password match the admin credentials
                        if ($email === "admin@gmail.com" && $password === "123456") {
                            // If admin credentials match, set session variables and redirect to admin.php
                            header("location: admin.php");
                        } else {
                        header("location: home.php");
                       }     
                    exit;
                }
            }else{
                //echo"fail2";
                $login_err = "Invalid email or password.";
            }
        }else{
            //echo"fail3";
            echo "Something went wrong. Please try again.";
        }
        mysqli_stmt_close($stmt);
    }//$_SESSION['login'] = true;
    }
}
mysqli_close($link);
   
}

?>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "db.php";

$origin = $destination = $date = "";
$origin_err = $destination_err = $date_err = $book_err = "";

if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['search'])){

    if(empty(trim($_POST['origin']))){
        $origin_err = "*";
    }else{
        $origin = trim($_POST['origin']);
    }

    if(empty(trim($_POST['destination']))){
        $destination_err = "*";
    }else{
        $destination = trim($_POST['destination']);
    }    
    
    if(empty(trim($_POST['Date']))){
        $date_err = "*";
    }else{
        $date = trim($_POST['Date']);
    }    
    
    if(empty($origin_err) && empty($destination_err) && empty($date_err)){

        // $sql = "SELECT FlightID, FlightNum, Origin, Date, Dest, Arr_Time, Dest_Time, AirplaneID
        //          FROM Flight WHERE Origin = ? AND Dest = ? AND Date =?";
        $sql = "SELECT Flight.FlightID, Flight.FlightNum, Flight.Origin, Flight.Date, Flight.Dest, 
                        Flight.Arr_Time, Flight.Dest_Time, Flight.AirplaneID, Airplane.Manufacturer, 
                        IntermediateCity.Name, IntermediateCity.ZipCode
                FROM Flight
                JOIN Airplane ON Flight.AirplaneID = Airplane.AirplaneID
                LEFT JOIN PassesThrough ON Flight.FlightID = PassesThrough.FlightID
                LEFT JOIN IntermediateCity ON PassesThrough.CityID = IntermediateCity.CityID
                WHERE Flight.Origin = ? AND Flight.Dest = ? AND Flight.Date = ?";
       
        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "sss", $param_origin, $param_destination, $param_date);

            $param_origin = $origin;
            $param_destination = $destination;
            $param_date = $date;

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) > 0){
                    $flight_data_array = [];

                    mysqli_stmt_bind_result($stmt, $id, $flightNum, $origin, $date, $dest, $arr_time,
                    $dest_time, $airplaneID, $manufacturer, $name, $zipCode);
                    
                    while(mysqli_stmt_fetch($stmt)){
                        $flight_data_item = [
                            'FlightID' => $id,
                            'FlightNum' => $flightNum,
                            'Origin' => $origin,
                            'Date' => $date,
                            'Dest' => $dest,
                            'Arr_Time' => $arr_time,
                            'Dest_Time' => $dest_time,
                            'AirplaneID' => $airplaneID,
                            'Manufacturer' => $manufacturer,
                            'Name' => $name,
                            'ZipCode' => $zipCode                             
                        ];
                        $flight_data_array[] = $flight_data_item;
                    }
            
                        $flight_data_json = json_encode($flight_data_array);
                        // Redirect to displayResult.php with flight data as a GET parameter
                        header("Location: ./displayResult.php?flights=" . urlencode($flight_data_json));
                        exit;
                }else{
                    // If no flights found, redirect with a message
                    // header("Location: displayResult.php?message=" . urlencode("No flights found for the selected criteria."));
                    // exit;
                   $book_err = "No flights found for the selected criteria.";
                    //header("Location: home.php?error=" . urlencode($book_err));
                    // header("location: ./home.php");
                    // exit;
                }
           } mysqli_stmt_close($stmt);
        }
    } 
    mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
</head>
<body>
    <nav class="navbar">
        <div class="content">
            <div class="logo"><a href="#"> <img src="./images/logo.png" alt="logo"></a> </div>
            <ul class="menu-list">
                <div class="icon cancel-btn">
                    <i class="fas fa-times"></i>
                </div>
                <li><a href="./home.php">Home</a></li>
                <li><a href="./contact.php">Contact</a></li>
                
                <li><button type="submit" id="registBtn">Register</button></li>
                <li><button type="submit" id="loginBtn">Login</button></li>
                
            </ul>
            <div id="popupForm" class="popup">
                <!-- <form action="home.php" method="POST"> -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="cancel-btn2">
                        <i class="fas fa-times"></i>
                    </div>
                    
                    <h2 id="login-title">Login</h2>
                    
                    <div class="credentials"> 
                        <input type="email" name="emailLogin" placeholder="Email" value="<?php echo $email; ?>"><br>
                        <span class="invalid"><?php echo $email_err; ?></span>
                        <input type="password" name="passwordLogin" placeholder="Password" value="<?php echo $password; ?>">   
                        <span class="invalid"><?php echo $password_err; ?></span><br>
                        <span class="invalid"><?php echo $login_err; ?></span>
                        <?php if (!empty($login_err)): ?>
                            <script>alert('<?php echo $login_err; ?>');</script>
                            
                        <?php endif; ?>
                    </div>
                    <?php
                            // if (isset($_SESSION['login_success'])) {
                            //     if ($_SESSION['login_success'] === true) {
                            //         echo "<script>alert('login_success successful!');</script>";
                            //     } else {
                            //         echo "<script>alert('login_success failed!');</script>";
                            //     }
                            //     unset($_SESSION['login_success']); // Unset session variable after displaying the alert
                            // }
                    ?>
                   <p>Don't have an account?<span class="registerLink"><a href="#">Register</a></span></p><br>
                   <button type="submit" name="Login" id="login">Login</button>
                </form>
            </div>
            <div class="register">
                <!-- <form action="./login/home.php" method="POST"> -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="cancel-btn3">
                        <i class="fas fa-times"></i>
                    </div>
                    <h2>Register</h2>
                    <div class="credentialsRegister"> 
                        <input type="text" name="emailRegister" placeholder="Email" value="<?php echo htmlspecialchars($emailregister);?>">
                        <span class="invalid" ><?php echo isset($emailregister_err) ? $emailregister_err : ''; ?></span><br>
                        <input type="password" name="passwordRegister" placeholder="Password" value="<?php echo htmlspecialchars($passwordregister);?>">
                        <span class="invalid"><?php echo isset($passwordregister_err) ? $passwordregister_err : ''; ?></span>
                       
                        <?php
                            if (isset($registration_success_msg) && !empty($registration_success_msg)) {
                                echo "<script>consol.log('$registration_success_msg'); alert('$registration_success_msg');</script>";
                                unset($_SESSION['registration_success']);
                            } 
                        ?>

                        <?php
                            // if (isset($_SESSION['registration_success'])) {
                            //     if ($_SESSION['registration_success'] === true) {
                            //         echo "<script>alert('Registration successful!');</script>";
                            //     } else {
                            //         echo "<script>alert('Registration failed!');</script>";
                            //     }
                            //     unset($_SESSION['registration_success']); // Unset session variable after displaying the alert
                            // }
                        ?>
                    </div>
                   <button type="submit" name="register" id="registerButton">Register</button>
                </form>
            </div>

            <div class="icon menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <div class="banner"></div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="tickets">
            <div class="title">Broaden your Horizons</div>
            <div class="toggle">   
                <div class="switchToggle switch3">
                    <input id="roundtrip" class="roundtrip" name="TravelType" type="radio">
                    <label>
                        Round trip
                    </label>
                    <input id="oneway" class="oneway" name="TravelType" type="radio">
                    <label>
                        One way
                    </label>
                </div>
            </div>
            <div class="cities">
                <input type="text" name="origin" placeholder="Origin" value="<?php echo $origin; ?>">
                <span class="invalid"><?php echo $origin_err ?></span>
                <input type="text" name="destination" placeholder="Destination" value="<?php echo $destination; ?>"><br><br>
                <span class="invalid"><?php echo $destination_err ?></span><br>
            </div> 
            <div class="dates">
                <input type="date" class="Date" name="Date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $date; ?>"><br>
                <span class="invalid"><?php echo $date_err; ?></span>
                <span class="invalid1"><?php echo $book_err; ?></span>

                <!-- <input type="date" class="depDate" name="departureDate" min="<?php //echo date('Y-m-d'); ?>" value="<?php //echo $depDate; ?>">
                <span class="invalid"><?php //echo $depDate_err; ?></span> -->
            </div>
            <div class="search-wrapper">
                <button type="submit" name="search" class="search">Search</button>
            </div> 
        </div>
        <div class="destinations">
            <div class="container">
                <div class="images">
                    <img src="./images/capadocia.jpg" alt="">
                    <img src="./images/machu.jpg" alt="">
                    <img src="./images/easter.jpg" alt="">
                    <span class="airplane">..Famous Destinations..</span>
                </div>
            </div>
        </div>
    </form>
   
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
                    <li><a href="./home.php">Home</a></li>
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

    <script src="home1.js" charset="utf-8"></script>
</body>
</html>

