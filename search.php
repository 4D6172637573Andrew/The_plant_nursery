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
<body>
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

