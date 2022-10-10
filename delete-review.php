<?php 
    session_start();

    $memberID = $_SESSION["memberID"];
    $eventID = $_POST["eventID"];
    
    include "includes/dbconx.php";
    
    /* delete event review for user */
    $sql ="DELETE FROM review WHERE eventID=? AND memberID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $eventID, $memberID);
    if($stmt->execute()){
        /* redirect to the event page  */
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
    $conn->close();
    
?>