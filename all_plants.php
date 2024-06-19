<?php
session_start(); // Start the session
include_once("header.php");
include_once("sort_search_module.php");

$category_filter = $_GET['category'] ?? 'all'; // Get selected category from URL parameter

$conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Build the query based on category filter
if ($category_filter === 'all') {
    $query = "SELECT * FROM plant";
} else {
    $query = "SELECT * FROM plant WHERE plant_class='$category_filter'";
}

$result = mysqli_query($conn, $query);

$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $products[] = [
        'id' => $row['id'], // Assuming you have an 'id' column in the plant table
        'name' => $row['plant_name'],
        'image' => $row['img_path'],
        'price' => $row['price'],
        'size' => $row['size']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Shop</title>
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
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .product-card {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            width: 200px;
            text-align: center;
        }
        .product-card img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="product-grid">
            <?php if (empty($products)): ?>
                <p>No products found.</p>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <h6 class="product_name"><?php echo $product['name']; ?></h6>
                        <h4 class="product_price"><?php echo "$" . $product['price']?></h4>
                        <h6 class="product_size"><?php echo $product['size'] . "mm"?></h6>
                        <form method="POST" action="cart_add.php">
                            <input type="hidden" name="plant_id" value="<?php echo $product['id']; ?>">
                            <input type="hidden" name="plant_name" value="<?php echo $product['name']; ?>">
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                            <input class="product_quantity" type="number" name="quantity" value="1" min="1">
                            <button type="submit">ADD TO CART</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
