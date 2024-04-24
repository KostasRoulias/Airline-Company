<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   
</head>
<body class="body">
    <nav class="navbar">
        <div class="content">
            <div class="logo"><a href="./home.php"> <img src="./images/logo.png" alt="logo"></a> </div>
            <ul class="menu-list">
                <div class="icon cancel-btn">
                    <i class="fas fa-times"></i>
                </div>
                <li><a href="./home.php">Home</a></li>
                <span class="buttons">
                <li><button type="submit" id="logoutBtn">Logout</button></li>
                </span>
            </ul>
            <div class="icon menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
    <div class="admin-container">
        <h2>Administrator's Panel</h2>
    </div>
    <div class="categories">
        <div class="flight data"><a href="./flight/display.php"><span class="dataTitle">Flight's Data</span></a></div>
        <div class="intermediateCity data"><a href="./InterCity/display.php"><span class="dataTitle">Intermiediate City's Data</span></a></div>
        <div class="airplane data"><a href="./airplane/display.php"><span class="dataTitle">Airplane's Data</span></a></div>
        <div class="staff data"><a href="./Staff/display.php"> <span class="dataTitle">Staff's Data</span></a></div>
        <div class="passenger data"><a href="./passenger/display.php"> <span class="dataTitle">Passenger's Data</span></a></div>
        <div class="user data"><a href="./user/display.php"> <span class="dataTitle">User's Data</span></a></div>

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