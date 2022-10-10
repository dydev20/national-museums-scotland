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


    <title>Events</title>
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
                        <a class="nav-item nav-link" href="index.php">Home</span></a>
                        <a class="nav-item nav-link" href="events.php">Events<span class="sr-only">(current)</span></a>
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
                <h1>Events</h1>
                <h2>What's On</h2>
            </div>

            <div class="content-container">
                <div class="search-container">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
                        <!-- day dropdown -->
                        <div class="label-input">
                            <label for="day">Day</label>
                            <select class="input" name="day" id="day">
                                <option value="All">All</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                            </select>
                        </div>
                        <!-- type dropdown -->
                        <div class="label-input">
                            <label for="type">Type</label>
                            <select class="input" name="type" id="type">
                                <option value="All">All</option>
                                <option value="Exhibition">Exhibition</option>
                                <option value="Tour">Tour</option>
                                <option value="Workshop">Workshop</option>

                            </select>
                        </div>
                        <!-- museum dropdown -->
                        <div class="label-input">
                            <label for="museum">Museum</label>
                            <select class="input" name="museum" id="museum">
                                <option value="All">All</option>
                                <option value="National Museum of Scotland">National Museum of Scotland</option>
                                <option value="National Museum of Flight">National Museum of Flight</option>
                                <option value="National Museum of Rural Life">National Museum of Rural Life</option>
                                <option value="National War Museum">National War Museum</option>
                            </select>
                        </div>
                        <!-- free input -->
                        <div class="label-input free">
                            <label for="free">Free</label>
                            <input type="checkbox" id="free" name="freeCheckbox" value="Free">
                        </div>
                        <!-- submit button -->
                        <input type="submit" class="button event-submit" name="submit" value="Search">

                    </form>
                </div>

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



                    /* Day=All, Type=All, Museum=All */
                    function displayAllEvents()
                    {

                        include "includes/dbconx.php";

                        //if free checkbox is checked display all free events
                        if (isset($_GET["freeCheckbox"])) {

                            $freeCheckbox = $_GET["freeCheckbox"];

                            $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE price=?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $freeCheckbox);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($row = $result->fetch_assoc()) {
                                displayEvent($row);
                            }
                        } else { //display all events disregarding price
                            $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event";
                            $result = $conn->query($sql);

                            while ($row = $result->fetch_assoc()) {
                                displayEvent($row);
                            }
                        }
                        $conn->close();
                    }

                    if (isset($_GET["submit"])) {

                        $eventDay = $_GET["day"];
                        $museum = $_GET["museum"];
                        $eventType = $_GET["type"];

                        include "includes/dbconx.php";

                        /* Day=All, Type=All, Museum=All */
                        if ($eventDay == "All" and $eventType == "All" and $museum == "All") {

                            displayAllEvents();
                        } else { //three select inputs are not "All"
                            if (isset($_GET["freeCheckbox"])) { //free is checked
                                $freeCheckbox = $_GET["freeCheckbox"];

                                $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE dayInWeek=? AND eventType=? AND museum=? AND price=?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("ssss", $eventDay, $eventType, $museum, $freeCheckbox);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                while ($row = $result->fetch_assoc()) {
                                    displayEvent($row);
                                }
                            } else { //free not checked
                                $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE dayInWeek=? AND eventType=? AND museum=?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("sss", $eventDay, $eventType, $museum);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                while ($row = $result->fetch_assoc()) {
                                    displayEvent($row);
                                }
                            }
                        }


                        if ($eventDay == "All") {

                            if ($eventType == "All") {
                                if (isset($_GET["freeCheckbox"])) { //free checked

                                    $freeCheckbox = $_GET["freeCheckbox"];

                                    $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE museum=? AND price=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("ss", $museum, $freeCheckbox);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        displayEvent($row);
                                    }
                                } else { //free not checked
                                    $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE museum=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("s", $museum);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        displayEvent($row);
                                    }
                                }
                            } else { //eventType is not "All"
                                if (isset($_GET["freeCheckbox"])) { //free is checked

                                    $freeCheckbox = $_GET["freeCheckbox"];

                                    $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE eventType=? AND museum=? AND price=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("sss", $eventType, $museum, $freeCheckbox);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        displayEvent($row);
                                    }
                                } else { //free is not checked

                                    $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE eventType=? AND museum=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("ss", $eventType, $museum);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        displayEvent($row);
                                    }
                                }
                            }
                        }


                        if ($eventType == "All") {

                            if ($museum == "All") {
                                if (isset($_GET["freeCheckbox"])) { //free checked

                                    $freeCheckbox = $_GET["freeCheckbox"];

                                    $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE dayInWeek=? AND price=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("ss", $eventDay, $freeCheckbox);
                                    $stmt->execute();
                                    $result = $stmt->get_result();


                                    while ($row = $result->fetch_assoc()) {
                                        displayEvent($row);
                                    }
                                } else { //free not checked
                                    $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE dayInWeek=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("s", $eventDay);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        displayEvent($row);
                                    }
                                }
                            } else { //museum is not "All"
                                if (isset($_GET["freeCheckbox"])) { //free is checked

                                    $freeCheckbox = $_GET["freeCheckbox"];

                                    $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE dayInWeek=? AND museum=? AND price=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("sss", $eventDay, $museum, $freeCheckbox);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        displayEvent($row);
                                    }
                                } else { //free is not checked

                                    $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE dayInWeek=? AND museum=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("ss", $eventDay, $museum);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        displayEvent($row);
                                    }
                                }
                            }
                        }


                        if ($museum == "All") {

                            if ($eventDay == "All") {
                                if (isset($_GET["freeCheckbox"])) { //free is checked

                                    $freeCheckbox = $_GET["freeCheckbox"];

                                    $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE eventType=? AND price=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("ss", $eventType, $freeCheckbox);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        displayEvent($row);
                                    }
                                } else { //free is not checked
                                    $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE eventType=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("s", $eventType);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        displayEvent($row);
                                    }
                                }
                            } else { //eventDay is not "All"
                                if (isset($_GET["freeCheckbox"])) { //free is checked

                                    $freeCheckbox = $_GET["freeCheckbox"];

                                    $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE dayInWeek=? AND eventType=? AND price=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("sss", $eventDay, $eventType, $freeCheckbox);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        displayEvent($row);
                                    }
                                } else { //free is not checked

                                    $sql = "SELECT eventName,eventType,dayInWeek,museum,price,image FROM event WHERE dayInWeek=? AND eventType=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("ss", $eventDay, $eventType);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        displayEvent($row);
                                    }
                                }
                            }
                        }
                        $conn->close();
                    } else {
                        //display all events on page load
                        displayAllEvents();
                    }

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
            <!-- navigation links-->

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