<?php 
    session_start();
    
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-pwd"];
    
    /* check if passwords entered are the same */
    function checkPasswordMatch($password, $confirmPassword){

        if($password == $confirmPassword){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function checkUsername($username){

        include "includes/dbconx.php";

        /* query to check if username already exists */
        $checkUsername = "SELECT username FROM member WHERE username=?"; 
        $stmt=$conn->prepare($checkUsername);
        $stmt -> bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return  $result->num_rows;

        $conn->close();
        
    }

    function checkEmail($email){
        include "includes/dbconx.php";

        //query to check if email already exists
        $checkEmail = "SELECT email FROM member WHERE email=?";
        $stmt=$conn->prepare($checkEmail);
        $stmt -> bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return  $result->num_rows;

        $conn->close();
    }
    
    
    
    /* if 1 result found then username already exists */
    if(checkUsername($username)==1 ){

        /* set session message to display on register page */
        $_SESSION["register-error"] = "Username already exists";
        /* redirect to register page */
        header("location:register-form.php");
        

    }elseif(checkEmail($email)==1){ //email already exists
        /* set session message to display on register page */
        $_SESSION["register-error"] = "Email already exists";
        /* redirect to register page */
        header("location:register-form.php");
        
    }else{
        
        /* check if passwords entered match */
        $passwordMatch = checkPasswordMatch($password,$confirmPassword);
        
        /* if passwords entered are the identical, register account  */
        if($passwordMatch==TRUE){

            /* hash password */
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            include "includes/dbconx.php";
            
            /* add username and hashed password to database */
            $sql = "INSERT INTO member (username,email,password) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt -> bind_param("sss", $username,$email,$passwordHash);

            if ($stmt->execute()) {
                /* redirect to sign in page */
                header("location:sign-in-form.php");
                
            }
            $conn->close();

        }else{ /* passwords entered does not match */
            $_SESSION["register-error"] = "Passwords do not match";
            header("location:register-form.php");
        }
    }
    


?>