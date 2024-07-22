<?php
include_once("header.php");

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
    $query = "SELECT plant_name FROM plant WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $plant_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $plant_name);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($plant_name) {
        $query = "UPDATE users SET liked_plant = CONCAT(IFNULL(liked_plant, ''), ?) WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        $liked_plant = $plant_name . ",";
        mysqli_stmt_bind_param($stmt, "si", $liked_plant, $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

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
            background-color: #f8f8f8;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 2px solid #e1e1e1;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f1f1f1;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        tr {
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .row_delete {
            background-color: transparent;
            border: none;
            color: #e74c3c;
            font-size: 20px;
            cursor: pointer;
        }
        .total-row {
            font-weight: bold;
        }
        .proceed-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2c3e50;
            color: #fff;
            text-transform: uppercase;
            text-decoration: none;
            letter-spacing: 0.05em;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .proceed-btn:hover {
            background-color: #34495e;
        }
    </style>
</head>
<body>
<div class="col-lg-10 table-body container"><br>
    <h1>Liked Plants:</h1>
    <table class="styled-table style" style="width: 100%;">
        <thead class="thead-dark">
        <tr class="active-row">
            <th scope="col">Plant Name</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (empty($liked_plants_array[0])) {
            echo '<tr><td colspan="2">No liked plants found.</td></tr>';
        } else {
            foreach ($liked_plants_array as $liked_plant) {
                echo '
                    <tr>
                        <td>' . htmlspecialchars($liked_plant) . '</td>
                        <td><a href="#" title="Remove" class="row_delete" style="color: black; font-size:20px;" data-plant-name="' . htmlspecialchars($liked_plant) . '"><i class="btn fa fa-trash-o"></i></a></td>
                    </tr>
                ';
            }
        }
        ?>
        </tbody>
    </table>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.row_delete').forEach(button => {
        button.addEventListener('click', event => {
            event.preventDefault();
            const plantName = event.currentTarget.getAttribute('data-plant-name');
            removeLikedPlant(plantName);
        });
    });
});

function removeLikedPlant(plantName) {
    fetch('remove_liked_plant.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ plant_name: plantName })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            location.reload();
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
</body>
</html>
