<?php
include_once("header.php");
include_once("sort_search_module.php");

$conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM plant"; 
$result = mysqli_query($conn, $query); 

$products = []; 

while ($row = mysqli_fetch_assoc($result)) {
    $products[] = [ 
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
    </style>
</head>
<body>
    <div class="container">
        <h3>SHOP ALL</h3>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h6 class="product_name"><b><?php echo $product['name']; ?></b></h6>
                    <h4 class="product_price"><?php echo "$" . $product['price']?></h4>
                    <h6 class="product_size"><b><?php echo $product['size'] . "mm"?></b></h6>
                    <button>ADD TO CART</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
