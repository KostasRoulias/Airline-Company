<?php 
//login

//initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}

require_once "db.php";

$email = $password = "";
$login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = setup_data($_POST['emailLogin']);
    $password = setup_data($_POST['passwordLogin']);
    
    if($email && $password){
        $sql = "SELECT id, email, password FROM user WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = $email;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){

                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                       //if(password_verify($password, $hashed_password)){
                       if($password === $hashed_password){
                        session_start();

                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["emailLogin"] = $email;
                        $_SESSION['login'] = true;
                        header("location: contact.php");
                        echo"ola kala";
                        exit;
                       } else {
                        $login_err = "Invalid email or password.";
                    }
                }
            }else{
                $login_err = "Invalid email or password.";
            }
        }else{
            echo "Something went wrong. Please try again.";
        }
        mysqli_stmt_close($stmt);
    }$_SESSION['login'] = true;
    }
    mysqli_close($link);
   
}

?>
