<?php
include_once "includes/config.php";
$conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
    $plant_id = $_POST['plant_id'];
    $plant_name = $_POST['plant_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Insert data into cart table
    $query = "INSERT INTO cart (user_id, plant_id, plant_name, price, quantity) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iisdi", $user_id, $plant_id, $plant_name, $price, $quantity);

    if (mysqli_stmt_execute($stmt)) {
        echo "Product added to cart successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>
