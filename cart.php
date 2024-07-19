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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
    <h1>Cart:</h1>
    <table class="styled-table style" style="width: 100%;">
        <thead class="thead-dark">
        <tr class="active-row">
            <th scope="col">Added items</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM cart WHERE user_id = ?"; 
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $total_final = 0; 

        while ($row = mysqli_fetch_assoc($result)) {
            $total = $row["price"] * $row["quantity"]; 
            $total_final += $total;
            echo '
                <tr>
                    <td>' . $row["plant_name"] . '</td>
                    <td>$' . number_format($row["price"], 2) . '</td>
                    <td>' . $row["quantity"] . '</td>
                    <td>$' . number_format($total, 2) . '</td>
                    <td><a href="#" title="Delete" class="row_delete" style="color: black; font-size:20px;" data-row-id="' . $row["id"] . '"><i class="btn fa fa-trash-o"></i></a></td>
                </tr>
            ';
        }

        mysqli_stmt_close($stmt);
        ?>
        <tr class="total-row">
            <td colspan="3" style="text-align:left;"><b>Total Final:</b></td>
            <td colspan="2"><?php echo "$" . number_format($total_final, 2); ?></td> 
        </tr>
        </tbody>
    </table>
    <button class="proceed-btn">Proceed to Checkout</button>
</div>
</body>
</html>



