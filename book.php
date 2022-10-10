<?php 
    session_start();

    /* if user is not signed in redirect to sign in page */
    if(!isset($_SESSION["username"])){
        header("location:sign-in-form.php");
    }else{
        
        $username = $_SESSION["username"];
        $memberID = $_SESSION["memberID"];
        $eventID=$_POST["eventID"];
        
        include "includes/dbconx.php";

        /* book event by inserting eventID and memberID into booking table */
        $sql = "INSERT INTO booking(eventID,memberID) VALUES (?,?)";

        $stmt = $conn->prepare($sql);
        $stmt -> bind_param("ss", $eventID, $memberID);
        if ($stmt->execute()) {
            
            /* after booking event redirect back to the event page  */
            switch($eventID){
                case 1:
                    header("location:dinosaurs.php");
                    break;
                case 2:
                    header("location:the-first-flight.php");
                    break;
                case 3:
                    header("location:tractors.php");
                    break;
                case 4:
                    header("location:life-in-trenches.php");
                    break;
                case 5:
                    header("location:farming-machinery.php");
                    break;
                case 6:
                    header("location:t-rex.php");
                    break;
                
            }
            
            
        }else{
            switch ($eventID) {
                case 1:
                    header("location:dinosaurs.php");
                    break;
                case 2:
                    header("location:the-first-flight.php");
                    break;
                case 3:
                    header("location:tractors.php");
                    break;
                case 4:
                    header("location:life-in-trenches.php");
                    break;
                case 5:
                    header("location:farming-machinery.php");
                    break;
                case 6:
                    header("location:t-rex.php");
                    break;
            }
            
        }
    }
    
        
    


    

?>