<?php
include_once("header.php");

$conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<head>
    <style>
        th {
        background-color: #95A5A6;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        }
        tr {
        background-color: #ffffff;
        box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
        }
        .container {
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
        padding-left: 10px;
        padding-right: 10px;
        }
        
    </style>
</head>

<body>
<div class="col-lg-10 table-body container"><br>
    <h1>cart:</h1>
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
        $sql = "SELECT id, user_id, plant_id, plant_name, price, quantity FROM cart";
        $result = $conn->query($sql);

        $query = "SELECT * FROM cart WHERE user_id = 1"; 
        $result = mysqli_query($conn, $query); 

        $total_final = 0; 

        while ($row = mysqli_fetch_assoc($result)) {
            $total = $row["price"] * $row["quantity"]; 
            $total_final += $total;
            echo '
                <tr>
                    <td style="text-align:left;">' . $row["plant_name"] . '</td>
                    <td style="text-align:left;">' . $row["price"] . '</td>
                    <td style="text-align:left;">' . $row["quantity"] . '</td>
                    <td style="text-align:left;">' . $total . '</td>
                    <td style="text-align:center;">
                        <a href="#" title="Delete" id="delete_row class="row_delete" style="color: black; font-size:20px;" data-row-id="' . $row["id"] . '">
                            <i class="btn fa fa-trash-o"></i>
                        </a>
                    </td>
                </tr>
            ';
        }
        ?>
        <tr>
            <td colspan="3" style="text-align:left;"><b>Total Final:</b></td>
            <td colspan="2"><?php echo "$" . $total_final; ?></td> 
        </tr>
        </tbody>
    </table>
</div>
</body>
