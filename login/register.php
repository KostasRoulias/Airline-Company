<?php

// require_once "db.php";

// function setup_data($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
//   }

// $emailregister = $passwordregister = "";
// $emailregister_err = $passwordregister_err = "";

// if($_SERVER["REQUEST_METHOD"] == "POST"){
   
//     //validate email
//     if(empty(trim($_POST["emailRegister"])) || !filter_var($_POST["emailRegister"], FILTER_VALIDATE_EMAIL)){
//         $emailregister_err = "*";
      
//     } else{
//         $sql = "SELECT id FROM user WHERE email = ?";

//         if($stmt = mysqli_prepare($link, $sql)){
//             mysqli_stmt_bind_param($stmt, "s", $param_emailregister);

//             $param_emailregister = setup_data($_POST["emailRegister"]);

//             if(mysqli_stmt_execute($stmt)){

//                 mysqli_stmt_store_result($stmt);

//                 if(mysqli_stmt_num_rows($stmt) == 1){
//                     $emailregister_err = "This email already exists.";
//                 }else{
//                     $emailregister = setup_data($_POST["emailRegister"]);
//                 }
//             } else{
//                 echo "Something went wrong. Try again later.";
//             }
//             mysqli_stmt_close($stmt);
//         }
//     }
    
//     //validate password
//     if(empty(trim($_POST["passwordRegister"]))){
//         $passwordregister_err = "*";
        
//     } elseif(strlen(trim($_POST["passwordRegister"])) < 6){
//         $passwordregister_err = "*";
        
//     } else{
//         $passwordregister = setup_data($_POST["passwordRegister"]);
//     }

//     if(empty($emailregister_err) && empty($passwordregister_err)){
//         $sql = "INSERT INTO user (email, password) VALUES (?, ?)";

//         if($stmt = mysqli_prepare($link, $sql)){
//             mysqli_stmt_bind_param($stmt, "ss", $param_emailregister, $param_passwordregister);

//             $param_emailregister = $emailregister;
//             $param_passwordregister = password_hash($passwordregister, PASSWORD_DEFAULT);
//            // $param_passwordregister = $passwordregister;

//             if(mysqli_stmt_execute($stmt)){
//                 header("location: ../home.php");
                
//             }else{
//                 echo "Something went wrong. Try again later.";
//             }
//             mysqli_stmt_close($stmt);
//         }
//     }
//     mysqli_close($link);
// }

?>