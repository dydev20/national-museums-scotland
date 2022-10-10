<?php
session_start();
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

    <title>Farming Machinery</title>
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
                        <?php
                        if (isset($_SESSION["username"]) and isset($_SESSION["memberID"])) {
                            /* for signed in users*/
                            echo '<a class="nav-item nav-link" href="account.php">Account</a>';
                            echo '<a class="nav-item nav-link" href="sign-out.php">Sign Out</a>';
                        } else {
                            /* for users not signed in */
                            echo '<a class="nav-item nav-link" href="register-form.php">Register</a>';
                            echo '<a class="nav-item nav-link" href="sign-in-form.php">Sign In</a>';
                        }
                        ?>
                    </div>
                </div>
            </nav>
            <!-- navbar -->
        </header>

        <main>
            <div class="heading-banner">
                <?php
                include "includes/dbconx.php";

                $eventID = 5;
                /* display event name and type */
                $sql = "SELECT eventName,eventType FROM event WHERE eventID=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $eventID);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<h1>" . $row['eventName'] . "</h1>";
                        echo "<h2>" . $row['eventType'] . "</h2>";
                    }
                } else {
                    echo "<p>No results found</p>";
                }
                $conn->close();

                ?>
            </div>

            <div class="content-container">

                <section class="event">
                    <div class="event-img">
                        <?php

                        include "includes/dbconx.php";
                        /* display event image */
                        $sql = "SELECT image FROM event WHERE eventID=?";

                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $eventID);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<img class='event-img' src=" . $row['image'] . ">";
                            }
                        } else {
                            echo "<p>No results found</p>";
                        }
                        $conn->close();


                        ?>

                    </div>

                    <div class="event-info">
                        <ul>
                            <?php

                            include "includes/dbconx.php";
                            /* display event info */
                            $sql = "SELECT dayInWeek,museum,price FROM event WHERE eventID=?";

                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $eventID);
                            $stmt->execute();
                            $result = $stmt->get_result();


                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {

                                    echo "<li>" . $row['museum'] . "</li>";
                                    echo "<li>" . $row['dayInWeek'] . "</li>";
                                    if ($row['price'] == "Free") {
                                        //free event
                                        echo "<li>" . $row['price'] . "</li>";
                                    } else {
                                        /* if event is not free display £ symbol */
                                        echo "<li>&pound" . $row['price'] . "</li>";
                                    }
                                }
                                /* if user is signed in then check if member has booked this event and display message if event is booked*/
                                if (isset($_SESSION["memberID"])) {
                                    $memberID = $_SESSION["memberID"];

                                    $sql = "SELECT eventID,memberID FROM booking WHERE memberID=? AND eventID=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("ii", $memberID, $eventID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows > 0) {
                                        echo "<li class='booking-status'><strong>Event Booked</strong></li>";
                                    }
                                }
                            } else {
                                echo "<li>No results found</li>";
                            }
                            $conn->close();
                            ?>
                        </ul>

                        <!-- book event button -->
                        <form action="book.php" method="POST">
                            <input type="hidden" name="eventID" value="5">
                            <input type="submit" class="button book-btn" name="submit" value="Book Now">
                        </form>
                    </div>
                    <!-- event info -->

                    <div class="event-description">
                        <?php

                        include "includes/dbconx.php";
                        /* display event description */
                        $sql = "SELECT description FROM event WHERE eventID=?";

                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $eventID);
                        $stmt->execute();
                        $result = $stmt->get_result();


                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                echo "<p>" . $row['description'] . "</p>";
                            }
                        } else {
                            echo "<p>No results found</p>";
                        }
                        $conn->close();
                        ?>
                    </div>
                    <!-- event description -->
                </section>
                <!-- event -->


                <section class="review">
                    <div>
                        <!-- review event form -->
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <label for="review">
                                <h2>Review Event</h2>
                            </label>

                            <!-- stars container -->
                            <div class="star-rating">
                                <label for="1-star" class="star">
                                    <input type="radio" name="rating" value="1" id="1-star">
                                    <i class="fa-regular fa-star" id="rating1"></i>
                                    <i class="fa-solid fa-star" id="rating1-solid"></i>
                                </label>

                                <label for="2-star" class="star">
                                    <input type="radio" name="rating" value="2" id="2-star">
                                    <i class="fa-regular fa-star" id="rating2"></i>
                                    <i class="fa-solid fa-star" id="rating2-solid"></i>
                                </label>

                                <label for="3-star" class="star">
                                    <input type="radio" name="rating" value="3" id="3-star">
                                    <i class="fa-regular fa-star" id="rating3"></i>
                                    <i class="fa-solid fa-star" id="rating3-solid"></i>
                                </label>

                                <label for="4-star" class="star">
                                    <input type="radio" name="rating" value="4" id="4-star">
                                    <i class="fa-regular fa-star" id="rating4"></i>
                                    <i class="fa-solid fa-star" id="rating4-solid"></i>
                                </label>

                                <label for="5-star" class="star">
                                    <input type="radio" name="rating" value="5" id="5-star">
                                    <i class="fa-regular fa-star" id="rating5"></i>
                                    <i class="fa-solid fa-star" id="rating5-solid"></i>
                                </label>
                            </div>
                            <!-- stars container -->

                            <div class="review">
                                <!-- review comment -->
                                <textarea class="input text-input" name="comment" id="review" placeholder="Leave a comment..." maxlength="100" required></textarea>
                                <!-- submit button -->
                                <input type="submit" class="button review-submit-btn" name="submit" value="Submit">
                            </div>

                        </form>
                    </div>

                    <div>
                        <?php
                        /* process review form */

                        if (isset($_POST["submit"]) and !isset($_SESSION["username"])) {/* review form submitted, user not signed in */
                            echo "<p><strong>Please sign in to review event</strong></p>";
                        } elseif (isset($_POST["submit"]) and !isset($_POST["rating"])) {/* review form submitted, star rating not selected */
                            echo "<p><strong>Please leave a rating for the event</strong></p>";
                        } elseif (isset($_POST["submit"]) and isset($_POST["rating"]) and isset($_POST["comment"])) {
                            $username = $_SESSION["username"];
                            $memberID = $_SESSION["memberID"];
                            $rating = $_POST["rating"];
                            $comment = $_POST["comment"];

                            include "includes/dbconx.php";

                            /* check if signed in user has already left review on this event */
                            $sql = "SELECT rating,memberComment FROM review WHERE memberID=? AND eventID=?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ii", $memberID, $eventID);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            /* if review already submitted, display message */
                            if ($result->num_rows == 1) {
                                echo "<p><strong>You have already submitted a review on this event</strong></p>";
                            } else {
                                /* insert review info into review table */
                                $sql = "INSERT INTO review(eventID,memberID,memberComment,rating) VALUES (?,?,?,?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("iisi", $eventID, $memberID, $comment, $rating);

                                $stmt->execute();
                            }
                            $conn->close();
                        }
                        ?>
                    </div>

                    <div class="user-reviews">
                        <?php
                        /* display user review */
                        function displayReview($row)
                        {
                            echo "<p class='review-username'>" . $row["username"] . "</p>";
                            displayRating($row);

                            echo "<p>" . $row["memberComment"] . "</p>";
                            
                            /* if user is signed in, check if review is left by signed in user */
                            if (isset($_SESSION["memberID"])) {
                                /* if review is left by signed in user, display delete review button */
                                if ($row["memberID"] == $_SESSION["memberID"]) {
                                    echo "<form action='delete-review.php' method='POST'>
                                        <input type='hidden' name='eventID' value=" . $row["eventID"] . ">
                                        <input class='delete-review' type='submit' name='submit' value='Delete Review'>
                                        
                                    </form>";
                                }
                            }
                        }
                        
                        /* display star rating from user review */
                        function displayRating($row)
                        {
                            $rating = $row["rating"];
                            
                            /* display stars depending on star rating*/
                            switch ($rating) {
                                case 1:
                                    /* if rating is 1 display only 1 solid star */
                                    echo '
                                    <div class="user-rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    </div>';
                                    break;
                                case 2:
                                    /* if rating is 2 display 2 solid stars */
                                    echo '
                                    <div class="user-rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    </div>';
                                    break;
                                case 3:

                                    echo '
                                    <div class="user-rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    </div>';
                                    break;
                                case 4:
                                    echo '
                                    <div class="user-rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    </div>';
                                    break;
                                case 5:
                                    echo '
                                    <div class="user-rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    </div>';
                                    break;
                            }
                        }

                        include "includes/dbconx.php";
                        /* get info for reviews submitted for this event */
                        $sql = "SELECT member.username, rating,memberComment,review.memberID,review.eventID FROM review INNER JOIN member ON review.memberID = member.memberID WHERE eventID=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $eventID);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            displayReview($row);
                        }
                        $conn->close();
                        ?>
                    </div>
                </section>
                <!-- user review -->
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
    <!-- star rating -->
    <script src="scripts/rating.js"></script>
    <!-- display current year in footer -->
    <script>
        document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>
</body>

</html>