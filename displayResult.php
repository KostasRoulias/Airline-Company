

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User's Data</title>
    <link rel="stylesheet" href="./home.css">
    <link rel="stylesheet" href="./displayResult.css">
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
                <li><button type="submit" id="logoutBtn">Logout</button></li>
                </span>
            </ul>
            <div class="icon menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
   
    <div class="container my-5 p-4 mb-0">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h2 class="displayTitle">Available Flights</h2><br>
                <h4 class="displaysubtitle">To book a ticket, you must first log in to your account!</h4>
            </div>
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

            <?php            
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            require_once "./db.php";

            session_start();
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=== true){
                echo "eimai sundedemenos";
            }else{
                echo "den eimai sundedemenos";
            }

            // Retrieve flight data from GET parameter
            if(isset($_GET['flights'])){
                $flight_data_json = urldecode($_GET['flights']);
                $flight_data_array = json_decode($flight_data_json, true);

                // Display flight tickets
                foreach($flight_data_array as $flight){

                // Store flight information in session variables
                $_SESSION['FlightID'] = $flight['FlightID'];
                $_SESSION['FlightNum'] = $flight['FlightNum'];
                $_SESSION['Origin'] = $flight['Origin'];
                $_SESSION['Dest'] = $flight['Dest'];
                $_SESSION['Date'] = $flight['Date'];
                $_SESSION['Arr_Time'] = $flight['Arr_Time'];
                $_SESSION['Dest_Time'] = $flight['Dest_Time'];
                $_SESSION['AirplaneID'] = $flight['AirplaneID'];
                $_SESSION['Manufacturer'] = $flight['Manufacturer'];
                $_SESSION['Name'] = $flight['Name'];
                $_SESSION['ZipCode'] = $flight['ZipCode'];
                
                echo '<tr>';
                    echo '<td scope="row">' . $flight['FlightID'] . '</td>';
                    echo '<td>' . $flight['FlightNum'] . '</td>';
                    echo '<td>' . $flight['Origin'] . '</td>';
                    echo '<td>' . $flight['Dest'] . '</td>';
                    echo '<td>' . $flight['Date'] . '</td>';
                    echo '<td>' . $flight['Arr_Time'] . '</td>';
                    echo '<td>' . $flight['Dest_Time'] . '</td>';
                    echo '<td>' . $flight['AirplaneID'] . '</td>';
                    echo '<td>' . $flight['Manufacturer'] . '</td>';
                    echo '<td>' . $flight['Name'] . '</td>';
                    echo '<td>' . $flight['ZipCode'] . '</td>';
                    // echo '<td><button class="btn btn-info"><a href="./book.php?bookID=' . $flight['FlightID'] . '" class="text-light">Book</a></button></td>';
                    echo '<td><button class="btn btn-info">';
                    echo '<a href="' . (isset($_SESSION['loggedin']) && $_SESSION['loggedin']=== true ? './book.php?bookID=' . $flight['FlightID'] : './home.php') . '" class="text-light">Book</a>';
                    echo '</button></td>';
                    echo '</tr>';

                }
             } else {
                // Display a message if no flights found
                echo '<tr><td colspan="12">No flights found</td></tr>';
                unset($_SESSION['loggedin']);
            }

             //elseif(isset($_GET['message'])) {
            //     // Display message if no flights found
            //     echo $_GET['message'];
            // }

                    // echo ' <tr>
                    //     <td scope="row">'.$FlightID.'</td>
                    //     <td>'.$FlightNum.'</td>
                    //     <td>'.$Origin.'</td>
                    //     <td>'.$Dest.'</td>
                    //     <td>'.$Date.'</td>
                    //     <td>'.$Arr_Time.'</td>
                    //     <td>'.$Dest_Time.'</td>
                    //     <td>'.$AirplaneID.'</td>
                    //     <td>'.$Manufacturer.'</td>
                    //     <td>'.$Name.'</td>
                    //     <td>'.$ZipCode.'</td>
                    //     <td>
                    //             <button class="btn btn-info"><a href="./book.php?bookID='.$FlightID.'" class="text-light">Book</a></button>
                    //     </td>
                       
                    // </tr> ';    
            ?>
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

