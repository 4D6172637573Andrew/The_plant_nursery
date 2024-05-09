<?php
include_once "header.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            padding: 25px;
            background-color: white;
            color: black;
            font-size: 16px;
        }

        .dark-mode {
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>

<br><br><h2>Toggle Dark/Light Mode</h2>
<p>Click the button to toggle between dark and light mode for this page.</p>

<button onclick="myFunction()"  class="btn btn-success">Toggle dark/light mode </button>

<script>
    function myFunction() {
        var element = document.body;
        element.classList.toggle("dark-mode");
    }
</script>

</body>
</html>




<?php
include_once "footer.php";
?>
