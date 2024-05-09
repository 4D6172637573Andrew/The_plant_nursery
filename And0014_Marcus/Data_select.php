<?php
include_once "header.php";
?>

<div class="container">
    <h1>User Data:</h1>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pay2_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("<b>Connection failed:</b> " . $conn->connect_error);
}
    echo "<b>Database Status:</b> " . "Connected successfully";


$sql = "SELECT * from users";

if ($result = mysqli_query($conn, $sql)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $result );

    // Display result
    printf("<br><b>Total users in database:</b>  %d\n ", $rowcount);

}
$qry = "SELECT MAX(date) FROM users";
$result = mysqli_query($conn,$qry);
$date = mysqli_fetch_array($result);
echo "<br><b>User marks last updated on:</b> ".$date[0];



?>

<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Number</th>
        <th scope="col">Code</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Marks</th>
        <th scope="col">date updated</th>
        <th scope="col">Password</th>

    </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT id, code,  f_name, l_name, marks, date, Password FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th scope='row'>" . $row["id"] . "</th>";
            echo "<td>" . $row["code"] . "</td>";
            echo "<td>" . $row["f_name"] . "</td>";
            echo "<td>" . $row["l_name"] . "</td>";
            echo "<td>" . $row["marks"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["Password"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>0 results</td></tr>";
    }
    ?>
    </tbody>
</table>

<?php
$conn->close();
include_once "footer.php";
?>
