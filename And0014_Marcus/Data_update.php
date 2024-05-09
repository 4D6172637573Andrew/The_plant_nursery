<?php
include_once "Header.php";
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pay2_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<div class = "container">
    <h1>DATA UPDATE:</h1>

    <?php
    $id  =$_POST["id"];
    $marks  =$_POST["marks"];
    $sql = "UPDATE users
    SET marks = $marks
    WHERE id = $id;";



    $result = $conn->query($sql);

    if ($result == 1){
        echo ("record of user no.$id has been updated successfully");

    }

    $conn->close();
    ?>
    <form method="post" action="Data_update_form.php">
        <input type="submit" value="Back to update form"><br><br>
</div>

<?php
include_once "footer.php";
?>