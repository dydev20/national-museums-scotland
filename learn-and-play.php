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


    <title>Learn and Play</title>
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
                        <a class="nav-item nav-link" href="learn-and-play.php">Learn & Play<span class="sr-only">(current)</span></a>
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
                <h1>Learn & Play</h1>
            </div>

            <div class="content-container">
                <p class="guess-info">Guess the museum object by typing into the text box. Check you answer by clicking on the "Enter button"</p>
                <div class="learn-play">
                    <!-- guess 1 -->
                    <div class="guess-container guess1">
                        <img src="images/tyrannosaurus.jpg" alt="Tyrannosaurus" class="guess-img">
                        <input type="text" id="t-rex-input" class="input text-input guess-input">
                        <button type="button" id="t-rex-submit" class="button guess-submit">Enter</button>
                        <p class="guess-result" id="t-rex-result"></p>
                    </div>
                    <!-- guess 1 -->

                    <!-- guess 2 -->
                    <div class="guess-container guess2">
                        <img src="images/velociraptor2.jpg" alt="Velociraptor" class="guess-img">
                        <input type="text" id="velociraptor-input" class="input text-input guess-input">
                        <button type="button" id="velociraptor-submit" class="button guess-submit">Enter</button>
                        <p class="guess-result" id="velociraptor-result"></p>
                    </div>
                    <!-- guess 2 -->

                    <!-- guess 3 -->
                    <div class="guess-container guess3">
                        <img src="images/sarcophagus.jpg" alt="Sarcophagus" class="guess-img">
                        <input type="text" id="sarcophagus-input" class="input text-input guess-input">
                        <button type="button" id="sarcophagus-submit" class="button guess-submit">Enter</button>
                        <p class="guess-result" id="sarcophagus-result"></p>
                    </div>
                    <!-- guess 3 -->

                    <!-- guess 4 -->
                    <div class="guess-container guess4">
                        <img src="images/sphinx.jpg" alt="Sphinx" class="guess-img">
                        <input type="text" id="sphinx-input" class="input text-input guess-input">
                        <button type="button" id="sphinx-submit" class="button guess-submit">Enter</button>
                        <p class="guess-result" id="sphinx-result"></p>
                    </div>
                    <!-- guess 4 -->
                </div>
            </div>
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
    <!-- learn and play -->
    <script src="scripts/learn-and-play.js"></script>
    <!-- display current year in footer -->
    <script>
        document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>
</body>

</html>