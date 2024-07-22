<?php
include_once("header.php");

$plant_id = $_GET['plant_id'] ?? null; // Correctly retrieve the plant_id

if ($plant_id === null) {
    echo "Invalid plant ID.";
    exit;
}

echo "Plant ID: " . htmlspecialchars($plant_id);

$conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM plant WHERE id='$plant_id'";
echo "Query: " . $query;
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "Plant not found.";
    exit;
}

$plant = mysqli_fetch_assoc($result);
print_r($plant); // Debugging line to check the retrieved data
?>

<!DOCTYPE html>
<html lang="en">
<>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><br><br><br>
    <title><?php echo $plant['plant_name']; ?> - Plant Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .plant-image {
            flex: 1;
            max-width: 500px;
            margin-right: 20px;
        }
        .plant-image img {
            width: 100%;
            height: auto;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .plant-details {
            flex: 2;
            max-width: 700px;
            text-align: left;
            margin-left: 20px;
        }
        .plant-details h1 {
            font-size: 2em;
            margin: 0;
        }
        .plant-details h2 {
            font-size: 1.5em;
            color: #333;
            margin-top: 0;
        }
        .plant-details p {
            font-size: 1em;
            line-height: 1.6;
            color: #666;
        }
        .plant-details .price {
            font-size: 1.5em;
            color: #333;
            margin-top: 20px;
        }
        .plant-details .quantity {
            margin-top: 20px;
        }
        .plant-details .quantity label {
            font-size: 1em;
            margin-right: 10px;
        }
        .plant-details .quantity select {
            padding: 5px;
            font-size: 1em;
        }
        .plant-details .add-to-cart {
            margin-top: 20px;
        }
        
        .plant-details .additional-info {
            margin-top: 20px;
        }
        .plant-details .additional-info button {
            background-color: #f1f1f1;
            color: #333;
            padding: 10px 20px;
            font-size: 1em;
            border: 1px solid #ccc;
            cursor: pointer;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="plant-image">
            <img src="<?php echo $plant['img_path']; ?>" alt="<?php echo $plant['plant_name']; ?>">
        </div>
        <div class="plant-details">
            <h1><?php echo $plant['plant_name']; ?></h1>
            <h2><?php echo $plant['size'] . "MM"; ?></h2>
            <div class="price"><?php echo "$" . $plant['price']; ?></div>
            <p><?php echo $plant['description']; ?></p>
            <div class="quantity">
                <label for="quantity">Select Quantity:</label>
                <input type="number" name="quantity" value="1" min="1">
            </div>
            <div class="add-to-cart">
                <form method="POST" action="cart_add.php">
                    <input type="hidden" name="plant_id" value="<?php echo $plant['id']; ?>">
                    <input type="hidden" name="plant_name" value="<?php echo $plant['plant_name']; ?>">
                    <input type="hidden" name="price" value="<?php echo $plant['price']; ?>">
                    <input type="number" name="quantity" value="1" id="hidden-quantity">
                    <button type="submit" class="btn">ADD TO CART</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

    

