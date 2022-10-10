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
    <title>Collections</title>
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
                        <a class="nav-item nav-link " href="index.php">Home</a>
                        <a class="nav-item nav-link" href="events.php">Events</a>
                        <a class="nav-item nav-link" href="collections.php">Collections<span class="sr-only">(current)</span></a>
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
                <h1>Collections</h1>
            </div>

            <div class="content-container">
                <div class="search-container">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">

                        <!-- collection dropdown -->
                        <div class="label-input">
                            <label for="collection">Collection</label>
                            <select class="input" name="collection" id="collection">
                                <option value="All">All</option>
                                <option value="Dinosaur">Dinosaur</option>
                                <option value="Ancient Egypt">Ancient Egypt</option>
                            </select>
                        </div>

                        <!-- search box -->
                        <input type="search" class="collection-search input text-input" name="q" placeholder="Search..." pattern="[A-Za-z ]{1,30}" title="Letters only" maxlength="30">

                        <!-- search button -->
                        <button type="submit" class="button collection-submit" name="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>

                    </form>
                </div>

                <div class="collection-grid">
                    <?php
                    /* display item info */
                    function displayItem($row)
                    {
                        echo "<div class='item'>";
                        echo "<img class='item-img' src=" . $row['image'] . " alt='" .$row['itemName']."'>";
                        echo "<p class='itemName'><strong>" . $row['itemName'] . "</strong></p>";
                        echo "<p>" . $row['collection'] . "</p>";
                        echo "</div>";
                    }

                    /* display all items  */
                    function displayAllItems()
                    {
                        include "includes/dbconx.php";

                        $sql = "SELECT itemName,collection,image FROM collection";

                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                displayItem($row);
                            }
                        }
                        $conn->close();
                    }

                    if (isset($_GET["submit"]) and isset($_GET["collection"]) and isset($_GET["q"])) {

                        include "includes/dbconx.php";

                        $collection = $_GET["collection"];
                        $trimSearchString = trim($_GET["q"]);
                        $searchString = "%" . $trimSearchString . "%";

                        if ($searchString == "%%") { /* no search string entered*/

                            if ($collection == "All") { /* no search string entered. All collecion selected */
                                displayAllItems(); //Display all collection items

                            } else {
                                /* no search string entered but collection selected. display items in selected collection */

                                $sql = "SELECT itemName,collection,image FROM collection WHERE collection=?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $collection);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                while ($row = $result->fetch_assoc()) {
                                    displayItem($row);
                                }
                            }
                        } else {
                            /* search string entered and all collection selected. Search for items with search string all collections*/

                            if ($collection == "All") {
                                $sql = "SELECT itemName,collection,image FROM collection WHERE itemName LIKE ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $searchString);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        displayItem($row);
                                    }
                                } else {
                                    echo "<p>No results found</p>";
                                }
                            } else {

                                /* search string entered and collection selected. Search for items with search string in selected collection*/

                                $sql = "SELECT itemName,collection,image FROM collection WHERE collection=? AND itemName LIKE ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("ss", $collection, $searchString);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        displayItem($row);
                                    }
                                } else {
                                    echo "<p>No results found</p>";
                                }
                            }
                        }
                        $conn->close();
                    } else {
                        /* on page load,form not submitted. Display all products */
                        displayAllItems();
                    }
                    ?>
                </div>
                <!-- collection grid -->
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