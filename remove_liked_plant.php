<?php
include_once "includes/config.php";

$conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $data = json_decode(file_get_contents('php://input'), true);
    $plant_name = $data['plant_name'];

    $query = "SELECT liked_plant FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $liked_plants);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $liked_plants_array = explode(',', rtrim($liked_plants, ','));
    if (($key = array_search($plant_name, $liked_plants_array)) !== false) {
        unset($liked_plants_array[$key]);
    }

    $new_liked_plants = implode(',', $liked_plants_array) . ',';
    $query = "UPDATE users SET liked_plant = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $new_liked_plants, $user_id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
