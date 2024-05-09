<?php
require "includes/config.php";
if ($_SERVER["REQUEST_METHOD"] === "POST" && ($c = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME)))
    echo mysqli_query($c, "DELETE FROM shifts") ? "success" : "error";
mysqli_close($c);
?>