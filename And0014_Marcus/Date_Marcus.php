<?php
include_once "Header.php";
?>



<div class="container">
     <h1>Dates:</h1>
<?php
echo "Today is: " . date("Y/m/d") . "<br>";
echo "Today is: " . date("Y.m.d") . "<br>";
echo "Today is: " . date("Y-m-d") . "<br>";

echo "<br>Today is ". date("l") . "<br>";
date_default_timezone_set("Australia/Melbourne");
echo "The time is " . date("h:i:sa") . "<br>";
?>

<?php
// Prints the day
echo"<br><b><u>Prints the day</u></b><br>";
echo date("l") . "<br>";

// Prints the day, date, month, year, time, AM or PM
echo"<br><b><u>Prints the day, date, month, year, time, AM or PM</u></b><br>";
echo date("l jS \of F Y h:i:s A") . "<br>";

// Prints October 3, 1975 was on a Friday
echo"<br><b><u>Prints a certain date</u></b><br>";
echo "Oct 3,1975 was on a ".date("l", mktime(0,0,0,10,3,1975)) . "<br>";

// Use a constant in the format parameter
echo date(DATE_RFC822) . "<br>";

// prints something like: 1975-10-03T00:00:00+00:00
echo date(DATE_ATOM,mktime(0,0,0,10,3,1975));


?>

<?php
 include_once "footer.php";
?>
