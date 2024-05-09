<?php
include_once "includes/config.php";
?>


<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.111.3">
    <title>The Plant Nursery</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">




    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/my_style.css" rel="stylesheet">
    <link href="./css/boot_style.css" rel="stylesheet">
    <link href="./css/carousel.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">


</head>
<body>

<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
      <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./js/my_script.js"></script>

<?php
if(isset($_SESSION['loggedin'])) {
    include_once "logged_in_menubar.php";
} else {
    include_once "logged_out_menubar.php";
}
?>

<main>


