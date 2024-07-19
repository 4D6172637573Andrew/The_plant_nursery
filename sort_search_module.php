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
        }
        .container {
            text-align: center;
            padding: 20px;
        }
        .header img {
            width: 50%;
            height: auto;
        }
        .popup {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            border-radius: 5px;
            display: none;
            z-index: 1000;
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
                <label for="pot-size">Pot Size</label>
                <select id="pot-size">
                    <option value="all">All</option>
                    <option value="70">70</option>
                    <option value="80">80</option>
                    <option value="125">125</option>
                </select>
            </div>
            <div>
                <label for="sort-by">Sort By</label>
                <select id="sort-by">
                    <option value="default">Featured</option>
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
        var sizeDropdown = document.getElementById('pot-size');
        var sortByDropdown = document.getElementById('sort-by');
        var urlParams = new URLSearchParams(window.location.search);
        var category = urlParams.get('category') || 'all';
        var size = urlParams.get('size') || 'all';
        var sortBy = urlParams.get('sort_by') || 'default';

        categoryDropdown.value = category;
        sizeDropdown.value = size;
        sortByDropdown.value = sortBy;

        categoryDropdown.addEventListener('change', function() {
            applyFilters();
        });

        sizeDropdown.addEventListener('change', function() {
            applyFilters();
        });

        sortByDropdown.addEventListener('change', function() {
            applyFilters();
        });

        function applyFilters() {
            var selectedCategory = categoryDropdown.value;
            var selectedSize = sizeDropdown.value;
            var selectedSortBy = sortByDropdown.value;
            window.location.href = 'all_plants.php?category=' + selectedCategory + '&size=' + selectedSize + '&sort_by=' + selectedSortBy;
        }
    });

    function selectCategory(category) {
        var categoryDropdown = document.getElementById('category');
        categoryDropdown.value = category;
        highlightCategoryTile(category);
        applyFilters();
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
