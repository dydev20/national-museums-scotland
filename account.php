<?php
session_start();
$username = $_SESSION["username"];
$memberID = $_SESSION["memberID"];

/* if user is not signed in redirect to sign in page */
if (!isset($_SESSION["username"]) and !isset($_SESSION["memberID"])) {
    header("location:sign-in-form.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- custom CSS -->
    <link rel="stylesheet" href="styles/styles.css">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0c70a546c2.js" crossorigin="anonymous"></script>

    <title>My Account</title>
</head>

<body>
    <div class="page-container">
        <header>
            <!-- navbar -->
            <nav class="navbar navbar-expand-md navbar-light ">
                <a class="navbar-brand" href="index.php">National Museums <br> Scotland</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="index.php">Home</a>
                        <a class="nav-item nav-link" href="events.php">Events</a>
                        <a class="nav-item nav-link" href="collections.php">Collections</a>
                        <a class="nav-item nav-link" href="learn-and-play.php">Learn & Play</a>
                        <a class="nav-item nav-link" href="sign-out.php">Sign Out</a>
                    </div>
                </div>
            </nav>
            <!-- navbar -->
        </header>

        <main>
            <div class="heading-banner">
                <h1>My Account</h1>
                <h2>Manage Events</h2>
            </div>

            <div class="content-container">
                <div class="manage-acc">
                    <ul>
                        <?php
                        /* display username of signed in user */
                        echo "<li>Signed in as " . $username . "</li>";
                        ?>
                    </ul>
                </div>

                <div class="results-grid">
                    <?php
                    /* display event card */
                    function displayEvent($row)
                    {
                        echo "<div class='manage-event'>";
                        echo "<div class='card text-black mb-3' style='max-width: 16.5rem;'>";
                        echo "<div class='card-header'><p>" . $row["eventName"] . "</p></div>";
                        echo "<div class='card-header'>" . $row["eventType"] . "</div>";

                        /* different link depending on event name */
                        switch ($row["eventName"]) {
                            case "Dinosaurs":
                                echo "<a href='dinosaurs.php'><img class='card-img-top' src=" . $row["image"] . " alt='" . $row["eventName"] . "'></a>";
                                break;

                            case "The First Flight":
                                echo "<a href='the-first-flight.php'><img class='card-img-top' src=" . $row["image"] . " alt='" . $row["eventName"] . "'></a>";
                                break;
                            case "Tractors":
                                echo "<a href='tractors.php'><img class='card-img-top' src=" . $row["image"] . " alt='" . $row["eventName"] . "'></a>";
                                break;
                            case "Life in the Trenches":
                                echo "<a href='life-in-trenches.php'><img class='card-img-top' src=" . $row["image"] . " alt='" . $row["eventName"] . "'></a>";
                                break;
                            case "Farming Machinery":
                                echo "<a href='farming-machinery.php'><img class='card-img-top' src=" . $row["image"] . " alt='" . $row["eventName"] . "'></a>";
                                break;
                            case "T-rex":
                                echo "<a href='t-rex.php'><img class='card-img-top' src=" . $row["image"] . " alt='" . $row["eventName"] . "'></a>";
                                break;
                        }
                        echo "<div class='card-body'>
                            <p class='card-text museum-name'>" . $row["museum"] . "</p>
                            <p class='card-text'>" . $row["dayInWeek"] . "</p>";
                        if ($row["price"] == "Free") {
                            /* free event */
                            echo "<p class='card-text'>" . $row["price"] . "</p>
                                </div>";
                        } else {
                            /* if event not free display £ symbol */
                            echo "<p class='card-text'>&pound" . $row["price"] . "</p>
                                </div>";
                        }

                        echo "</div>";
                    }

                    include "includes/dbconx.php";

                    /* get info for events booked by signed in user */
                    $sql = "SELECT event.eventID,event.eventName,event.eventType, event.dayInWeek,event.image,event.museum,event.price FROM booking INNER JOIN event ON booking.eventID=event.eventID WHERE memberID = ?";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $memberID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            displayEvent($row);

                            /* cancel button to cancel event booking */
                            echo "<form action='cancel-booking.php' method='POST'>
                            <input type='hidden' name='eventID' value=" . $row["eventID"] . ">
                            <input type='submit' class='button cancel-booking-btn' name='submit' value='Cancel Booking' >
                            </form></div>";
                        }
                    } else {
                        echo "<p>No events booked</p>";
                    }

                    $conn->close();
                    ?>
                </div>
                <!-- results grid -->
            </div>
            <!-- content container -->
        </main>

        <footer>
            <!-- navigation links -->
            <div class="footer-links footer-nav">
                <h2 class="footer-heading">
                    <bold>Navigation</bold>
                </h2>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php">About Us</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="collections.php">Collections</a></li>
                    <li><a href="learn-and-play.php">Learn & Play</a></li>
                </ul>
            </div>
            <!-- navigation links -->

            <!-- membership links -->
            <div class="footer-links footer-membership">
                <h2 class="footer-heading">
                    <bold>Membership</bold>
                </h2>
                <ul>
                    <li><a href="register-form.php">Register</a></li>
                    <li><a href="sign-in-form.php">Sign In</a></li>
                </ul>
            </div>
            <!-- membership links -->

            <!-- contact info -->
            <div class="footer-links footer-contact">
                <h2 class="footer-heading">
                    <bold>Contact Us</bold>
                </h2>
                <ul>
                    <li>
                        0141 375 5555
                    </li>
                    <li>
                        enquiries@museumssco.co.uk
                    </li>
                </ul>
            </div>
            <!-- contact info -->

            <!-- social media -->
            <div class="footer-social">
                <h2 class="footer-heading">
                    <bold>Follow Us on Social Media</bold>
                </h2>
                <ul class="social-icons">
                    <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
            <!-- social media -->

            <div class="footer-legal">
                <p>&copy;<span id="year"></span> National Museums Scotland. All rights reserved</p>
            </div>
        </footer>
    </div>
    <!-- bootsrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- display current year in footer -->
    <script>
        document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>
</body>

</html>