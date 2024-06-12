<?php
include_once "header.php";
include_once "carousel.php";
?>

<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url(assets/img/) no-repeat;
    background-size: cover;
    background-position: center;
}
 </style> 
<!-- <hr class="featurette-divider"> -->
<div class="container">
        <div class="header">
        <hr class="featurette-divider">
        </div>
        <div class="categories filters filters-container">
            <div class="category" href="all_plants.php" data-category="all">
                <img src="assets/img/plant_all.jpg" alt="Shop All">
                <span>SHOP ALL</span>
            </div>
            <div class="category" onclick="setCategory('indoor')" data-category="indoor">
                <img src="assets/img/Indoor_plants.jpg" alt="Indoor Plants">
                <span>INDOOR PLANTS</span>
            </div>
            <div class="category" onclick="setCategory('outdoor')" data-category="outdoor">
                <img src="assets/img/Outdoor_plants.jpg" alt="Outdoor Plants">
                <span>OUTDOOR PLANTS</span>
            </div>
            <div class="category" onclick="setCategory('pots')" data-category="pots">
                <img src="assets/img/plant_accessories.jpg" alt="Pots & Accessories">
                <span>POTS - ACCESSORIES</span>
            </div>
        </div>

<hr class="featurette-divider">


<?php
include_once "footer.php";
?>



