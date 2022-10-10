<?php 
    session_start();
    $memberID=$_SESSION["memberID"];
    $eventID=$_POST["eventID"];
    
    include "includes/dbconx.php";
    /* delete event booking for user */
    $sql ="DELETE FROM booking WHERE eventID=? AND memberID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $eventID, $memberID);
    if($stmt->execute()){
        /* after booking deletion redirect to account page */
        header("location:account.php");
        
        unset($_SESSION["bookingStatus"]); //unset session variable so event page does not display booking status
    }
    $conn->close();

?>