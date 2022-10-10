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

    <title>Home</title>
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
                        <a class="nav-item nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
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

            <section class="about">
                <div class="overlay"></div>
                <div class="text-container">
                    <h1>About Us</h1>
                    <p>We are the governing body for the national museums in Scotland - National Museum of Scotland, National Museum of Flight, National Museum of Rural Life and National War Museum - responsible for taking care of their collections and ensuring they can be easily accessed by you. Use this website to search for events and explore collections. Register for a membership to gain benefits like booking and managing events.</p>
                </div>
            </section>

            <!-- events -->
            <div class="heading-banner home">
                <h2>Events</h2>
            </div>

            <div class="content-container">
                <section class="home-events">

                    <div class="results-grid">
                        <?php
                        /* display event card */
                        function displayEvent($row)
                        {
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
                            }

                            echo "<div class='card-body'>
                            <p class='card-text'>" . $row["museum"] . "</p>
                            <p class='card-text'>" . $row["dayInWeek"] . "</p>";
                            if ($row["price"] == "Free") {
                                //free event
                                echo "<p class='card-text'>" . $row["price"] . "</p>
                            </div>";
                            } else {
                                /* if event not free display £ symbol */
                                echo "<p class='card-text'>&pound" . $row["price"] . "</p>
                            </div>";
                            }

                            echo "</div>";
                        }

                        $Dinosaur = "Dinosaurs";
                        $Flight = "The First Flight";
                        $Tractors = "Tractors";

                        include "includes/dbconx.php";

                        /* display Dinosaurs, The First Flight and Tractors event */
                        $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE eventName = ? OR eventName = ? or eventName=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("sss", $Dinosaur, $Flight, $Tractors);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            displayEvent($row);
                        }

                        $conn->close();
                        ?>
                    </div>
                    <!-- results grid -->

                    <p>We offer a wide range of events across our national museums such as <br> tours, exhibitions and workshops</p>

                    <button class="button home-btn"><a href="events.php">More Events</a></button>
                </section>
                <!-- events -->
            </div>
            <!-- content container -->

            <!-- collections -->
            <div class="heading-banner home">
                <h2>Collections</h2>
            </div>
            <div class="content-container">
                <section class="home-collections">

                    <!-- Bootstrap carousel -->
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="images/golden-mask.jpg" alt="Golden Mask">
                            </div>

                            <div class="carousel-item">
                                <img class="d-block w-100" src="images/triceratops.jpg" alt="Triceratops">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="images/allosaurus.jpg" alt="Allosaurus">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="images/anubis.jpg" alt="Anubis">
                            </div>
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <!-- Bootstrap carousel -->

                    <button class="button home-btn"><a href="collections.php">Explore Collections</a></button>
                </section>
                <!-- collections -->
            </div>
            <!-- content container -->

            <!-- membership -->
            <div class="heading-banner home">
                <h2>Membership</h2>
            </div>
            <div class="content-container">
                <div class="benefits">
                    <p>Register for a membership for benefits:</p>
                    <ul>
                        <li>Book events</li>
                        <li>Cancel bookings</li>
                        <li>Free coffee</li>
                        <li>Monthly newsletter</li>
                    </ul>
                    <button class="button home-btn"><a href="register-form.php">Register Now</a></button>
                </div>
            </div>
            <!-- membership -->
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