<?php
require "includes/config.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $rowId = $_POST['id'];

    $conn = new mysqli(HOST, DBUSER, DBPASS, DBNAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM cart WHERE id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $rowId);

        if ($stmt->execute()) {
            echo "Row with ID $rowId has been deleted successfully.";
        } else {
            echo "Error executing the DELETE query: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing the DELETE statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>