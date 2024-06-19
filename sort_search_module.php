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
    <div class="container"><br><br>
        <div class="categories filters filters-container">
            <div class="category" onclick="selectCategory('all')" data-category="all">
                <img src="assets/img/plant_all.jpg" alt="Shop All">
                <span>SHOP ALL</span>
            </div>
            <div class="category" onclick="selectCategory('indoor')" data-category="indoor">
                <img src="assets/img/Indoor_plants.jpg" alt="Indoor Plants">
                <span>INDOOR PLANTS</span>
            </div>
            <div class="category" onclick="selectCategory('outdoor')" data-category="outdoor">
                <img src="assets/img/Outdoor_plants.jpg" alt="Outdoor Plants">
                <span>OUTDOOR PLANTS</span>
            </div>
            <div class="category" onclick="selectCategory('pots')" data-category="pots">
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
                    <option value="herbs">Herbs</option>
                    <option value="shrub">Shrubs</option>
                    <option value="tree">Trees</option>
                    <option value="climber">Climbers</option>
                    <option value="creeper">Creepers</option>
                </select>
            </div>
            <div>
                <label for="pot-size">Pot Size</label>
                <select id="pot-size">
                    <option value="all">All</option>
                    <option value="all">70</option>
                    <option value="all">80</option>
                    <option value="all">125</option>
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

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var categoryDropdown = document.getElementById('category');
        var urlParams = new URLSearchParams(window.location.search);
        var category = urlParams.get('category') || 'all';

        // Set the initial category based on URL parameter
        categoryDropdown.value = category;
        highlightCategoryTile(category);

        categoryDropdown.addEventListener('change', function() {
            var selectedCategory = categoryDropdown.value;
            window.location.href = 'all_plants.php?category=' + selectedCategory;
        });
    });

    function selectCategory(category) {
        var categoryDropdown = document.getElementById('category');
        categoryDropdown.value = category;
        highlightCategoryTile(category);
        window.location.href = 'all_plants.php?category=' + category;
    }

    function highlightCategoryTile(category) {
        var categories = document.querySelectorAll('.category');
        categories.forEach(function(cat) {
            if (cat.getAttribute('data-category') === category) {
                cat.classList.remove('darkened');
            } else {
                cat.classList.add('darkened');
            }
        });
    }
    </script>
</body>
</html>
