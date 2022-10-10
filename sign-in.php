<?php 
    
    session_start();

    include "includes/dbconx.php";
    
    $username=$_POST["username"];
    $password=$_POST["password"];

    $sql = "SELECT memberID, password FROM member WHERE username=?";
    
    $stmt=$conn->prepare($sql);
    $stmt -> bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row=$result->fetch_assoc();

    $memberID = $row["memberID"];
    $hashedPassword = $row["password"];

    /* check password entered and hashed password in db match  */
    $passwordMatch = password_verify($password, $hashedPassword);

    /* if 1 result from query found and password matches redirect user to admin page */
    if($result->num_rows===1 && $passwordMatch==TRUE){

        $_SESSION["username"]=$username;
        $_SESSION["memberID"]=$memberID;

        header("location:account.php");
        
    }else{
        $_SESSION["sign-in-error"] = "Wrong username or password";
        header("location:sign-in-form.php");
        
    }
    
    $conn->close();
?>