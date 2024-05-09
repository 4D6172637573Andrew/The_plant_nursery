<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.111.3">
    <title>Carousel Template · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">

    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/my_style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/boot_style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/carousel.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

</head>
<body>





<!DOCTYPE html>
<head>
    <title>Page Title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Style the body */
        body {
            font-family: Arial;
            margin: 0;
        }

        /* Header/Logo Title */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-family: "Arial Black";
            padding: 10px;
            background: black;
            color: white;
            font-size: 15px;
        }

        .header-title {
            text-align: center; /* Center align the header title */
        }

        .button {
            font-family: "Arial Black";
            background: #fbfbfb;
            color: black;
            font-size: 15px;
        }

        /* Search Bar Container */
        .search-bar-container {
            flex: 1; /* This will make the container take the available space */
            display: flex;
            justify-content: center; /* Center align the search bar */
        }

        .search-bar {
            min-width: 480px;
            display: flex;
            align-items: center;
            background-color: #454545;
            border-radius: 18px;
            padding: 5px;
        }

        .search-input {
            flex: 1;
            border: none;
            background-color: transparent;
            color: white;
            padding: 5px;
            outline: none;
        }

        /* Page Content */
        .content {
            padding: 20px;
        }

        /* Additional styles for the dark mode */
        body {
            text-align: left;
            padding: 0px;
            background-color: white;
            color: black;
            font-size: 16px;
        }

        .dark-mode {
            background-color: #444444;
            color: darkgrey;
        }

        /* Orange Rectangle */
        .orange-rectangle {
            display: inline-block;
            background-color: orange;
            padding: 5px 10px;
            color: black; /* Set the color of the text within the rectangle */
            border-radius: 10px; /* Add border-radius for curved edges */
        }

    </style>
</head>


<body>
<div class="header">
    <div class="header-title">
        <h1>Pay <span class="orange-rectangle">Hub</span></h1>
    </div>
    <div class="search-bar-container">
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="&#128269; ">
        </div>
    </div>
    <button onclick="myFunction()" class="button">dark/light mode</button>
</div>

<script>
    function myFunction() {
        var element = document.body;
        element.classList.toggle("dark-mode");
    }
</script>
</body>
</html> <!-- Header -->