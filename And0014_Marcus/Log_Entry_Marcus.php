<?php
include_once "header.php";
?>

<div class="container">
    <h1>Log Entry</h1>

    <b><u>Requirements:</u></b><br>
    Capture the value entered by the user and print it on the screen on the same page<br>
    The multiply that value by 2 and print it again on the next line on the same page<br>




<?php
echo "<br><br><b><u><h3>Log entry submission: </h3></u></b><br>"
?>

<form method="post">
    <b>Enter a number:</b> <input type="text" name="number">
    <input type="submit" name="submit" value="Submit">  (please note that only numbers will be accepted e.g 123)
</form>

<?php
// Check if the form is submitted and the number is set
if (isset($_POST['submit']) && isset($_POST['number'])) {
    $number = $_POST['number'];
    $result = $number * 2;
    echo "<br><b>The result is:</b> $result";


}
?>
</div>

<?php
include_once "footer.php"
?>
