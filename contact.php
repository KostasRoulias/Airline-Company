<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="./home.css">
    <link rel="stylesheet" href="./contact.css">
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
                <li><a href="./contact.php"><span style="text-decoration: underline pink;">Contact</span></a></li>
                <span class="buttons">
                <li><a href="./delete.php"><button type="submit" id="logoutBtn">Logout</button></a></li>
                </span>
            </ul>
            <div class="icon menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- Contact -->
    <section class="contact">
          <div class="ContactForm">
            <form target="_blank" action="https://formsubmit.co/kostasroulias92@gmail.com" method="post">
             <h2>Send Message</h2>
             <div class="inputBox">                   
               <input type="text" name="name"  required="required"> 
               <span>Full name</span>                          
             </div>
             <div class="inputBox">
               <input type="email" name="email"  required="required"> 
               <span>email</span>  
             </div>

             <div class="inputBox"> 
               <textarea   required="required" name="message"></textarea>  
               <span>Type your Message...</span>     
             </div>

             <div class="inputBox">
               <label for="Problem" style="color: #fff;">What problem do you have?</label>
               <select class="selected" name="Problem" >
                 <option>Refund</option>
                 <option>Unable to book a flight</option>
                 <option>Lost my luggage</option>
                 <option>Other</option>
               </select>
             </div>
                             
             <div class="inputBox">
               <input type="submit" name="" value="Send"  style="border-radius: 25px; ">                        
             </div>
            </form>
          </div>
        </div>
      </section>
   
    
    
   
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

