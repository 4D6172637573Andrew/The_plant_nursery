<head>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
}

h2 {
    color: #b30000;
    text-align: center;
    margin-top: 20px;
}

.search-result {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 10px auto;
    padding: 15px;
    width: 80%;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.search-result h3 {
    color: #b30000;
    font-size: 1.5em;
}

.search-result a {
    text-decoration: none;
    color: #333;
}

.search-result a:hover {
    text-decoration: underline;
}

.search-result article {
    margin-top: 10px;
}

@media (max-width: 768px) {
    .search-result {
        width: 90%;
    }
}

    </style>
</head>

<?php
include_once("header.php");
$conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en-GB">
<head>
    <title>Search results</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body><br><br>
<!-- <div class="search-box">
    <form action="search.php" method="get">
        <input type="text" name="search" maxlength="60" placeholder="Search..." required>
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
</div> -->
</div>
</body>
</html>

<?php 
if (isset($_GET['search'])) {
    $param = "%{$_GET['search']}%";
    $query = mysqli_prepare($conn, "SELECT * FROM Results WHERE Description LIKE ?");
    mysqli_stmt_bind_param($query, "s", $param);
    mysqli_stmt_execute($query); 
    $results = mysqli_stmt_get_result($query);
    $rows = mysqli_num_rows($results);
    mysqli_stmt_close($query);

    if ($rows > 0) {
        echo "<h2>Search results for: {$_GET['search']}</h2>";
             
        while ($result = mysqli_fetch_array($results)) {
            $result_title=$result['Title'];
            $result_url=$result['URL'];
            $result_preview=$result['Preview'];
				
            echo "<div class='search_result'> 						

                <article><a href='$result_url'>$result_preview</a></article>			
            </div>";
        }   
    } else {
        echo "<h2>No results found for your search: {$_GET['search']}</h2>";
    }
} else {
    echo "<h2>No search query provided. Please try your search again.</h2>";
}

//  insert <h3><a href='$result_link'>$result_title</a></h3> after echo "<div class='search_result'> if needed
?>

