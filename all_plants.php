<?php
session_start();
include_once("header.php");
include_once("sort_search_module.php");

$category_filter = $_GET['category'] ?? 'all';
$size_filter = $_GET['size'] ?? 'all';
$sort_by = $_GET['sort_by'] ?? 'default';

$conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM plant";
$conditions = [];

if ($category_filter !== 'all') {
    $conditions[] = "plant_class='$category_filter'";
}
if ($size_filter !== 'all') {
    $conditions[] = "size='$size_filter'";
}

if (count($conditions) > 0) {
    $query .= " WHERE " . implode(' AND ', $conditions);
}

switch ($sort_by) {
    case 'low_high':
        $query .= " ORDER BY price ASC";
        break;
    case 'high_low':
        $query .= " ORDER BY price DESC";
        break;
    case 'a_z':
        $query .= " ORDER BY plant_name ASC";
        break;
    case 'z_a':
        $query .= " ORDER BY plant_name DESC";
        break;
    default:
        // No sorting applied
        break;
}

$result = mysqli_query($conn, $query);

$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $products[] = [
        'id' => $row['id'], 
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
        .popup {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            border-radius: 5px;
            display: none;
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
                        <a href="plant_page.php?plant_id=<?php echo $product['id']; ?>" title="yes  " class="plant_like" style="color: black; font-size:20px;">
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        </a>
                        <h6 class="product_name"><?php echo $product['name']; ?></h6>
                            <h4 class="product_price"><?php echo "$" . $product['price'] ."   " ?>
                                <a href="liked_plant.php?plant_id=<?php echo $product['id']; ?>" title="like" class="plant_like" style="color: black; font-size:20px;">
                                    <i class="fa fa-heart-o"></i>
                                </a>
                            </h4>
                        <h6 class="product_size"><?php echo $product['size'] . "mm"?></h6>
                        <form method="POST" action="cart_add.php" onsubmit="addToCart(event)">
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

    <div class="popup" id="popup"></div>

    <script>
    function addToCart(event) {
        event.preventDefault();
        var form = event.target;

        var formData = new FormData(form);
        
        fetch('cart_add.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showPopup(data.message);
            } else {
                showPopup(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function showPopup(message, type = 'success') {
        var popup = document.getElementById('popup');
        popup.innerText = message;
        if (type === 'error') {
            popup.style.backgroundColor = '#f44336';
        } else {
            popup.style.backgroundColor = '#4caf50';
        }
        popup.style.display = 'block';
        setTimeout(() => {
            popup.style.display = 'none';
        }, 3000);
    }
    </script>
</body>
</html>
