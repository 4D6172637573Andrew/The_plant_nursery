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
            /* background-image: linear-gradient(to bottom right, #000428  , #004e92); */
        }
        .container {
            text-align: center;
            padding: 20px;
        }
        .header img {
            width: 50%;
            height: auto;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="path/to/your/header-image.png" alt="Plant Shop Header">
        </div><br><br>
        <div class="categories filters filters-container">
            <div class="category" onclick="setCategory('all')" data-category="all">
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
        <div class="filters filters-container">
            <div>
                <label for="category">Category</label>
                <select id="category">
                    <option value="all">All</option>
                    <option value="indoor">Indoor Plants</option>
                    <option value="outdoor">Outdoor Plants</option>
                    <option value="pots">Pots & Accessories</option>
                </select>
            </div>
            <div>
                <label for="plant-family">Plant Family</label>
                <select id="plant-family">
                    <option value="all">All</option>
                    <option value="cacti">Cacti</option>
                    <option value="shrub">Shrub</option>
                    <option value="tree">Tree</option>
                </select>
            </div>
            <div>
                <label for="pot-size">Pot Size</label>
                <select id="pot-size">
                    <option value="all">All</option>
                    <!-- Add more pot sizes as needed -->
                </select>
            </div>
            <div>
                <label for="sort-by">Sort By</label>
                <select id="sort-by">
                    <option value="default">Default</option>
                    <option value="low_high">Price Low to High</option>
                    <option value="high_low">Price High to Low</option>
                    <option value="a_z">Alphabetical Ascending</option>
                    <option value="z_a">Alphabetical Descending</option>
                </select>
            </div>
            <div>
                <label for="search">Search</label>
                <input type="text" id="search" placeholder="What are you looking for?">
            </div>
        </div>
    </div>
</body>
</html>