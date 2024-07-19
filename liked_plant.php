<?php
session_start();
include_once "header.php";
include_once "includes/config.php";

$conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$plant_id = $_GET['plant_id'] ?? null;

if ($plant_id) {
    // Fetch plant name by plant ID
    $query = "SELECT plant_name FROM plant WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $plant_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $plant_name);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($plant_name) {
        // Add plant name to liked_plants for the user
        $query = "UPDATE users SET liked_plant = CONCAT(IFNULL(liked_plant, ''), ?) WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        $liked_plant = $plant_name . ",";
        mysqli_stmt_bind_param($stmt, "si", $liked_plant, $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Retrieve liked plants
$query = "SELECT liked_plant FROM users WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $liked_plants);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$liked_plants_array = explode(',', rtrim($liked_plants, ','));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liked Plants</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            text-align: center;
            padding: 20px;
        }
        .liked-plants {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .liked-plant {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            width: 200px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liked Plants</h1>
        <div class="liked-plants">
            <?php if (empty($liked_plants_array[0])): ?>
                <p>No liked plants found.</p>
            <?php else: ?>
                <?php foreach ($liked_plants_array as $liked_plant): ?>
                    <div class="liked-plant">
                        <h4><?php echo htmlspecialchars($liked_plant); ?></h4>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
