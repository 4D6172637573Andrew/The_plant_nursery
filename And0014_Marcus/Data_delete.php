<?php
include_once "header.php";
?>

<?php
$servername = "localhost";
$username = "root";
$password = " ";
$dbname = "pay2_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}
?>

<div class = "container">
    <h1>DATA DELETE:</h1>

    <?php
    $id  =$_POST["id"];

    $sql = "UPDATE Users
    SET status = '0'
    WHERE id = $id;";

    $result = $conn->query($sql);

    if ($result == 1){
        echo ("record of $id has been deleted successfully");

    }

    $conn->close();
    ?>

</div>
<?php
include_once "footer.php";
?>
