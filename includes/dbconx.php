<?php
    $servername = "localhost";
    $user = "dylany";
    $pw = "CTRjRVxdxwmHcfBE";
    $db = "national_museums_scotland";

    /* create connection */
    $conn = new mysqli($servername, $user, $pw, $db);

    /* check connection */
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
?>
