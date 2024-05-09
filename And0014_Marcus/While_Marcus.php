<?php
include_once "Header.php"
?>

<div class="container">
    <h1>While</h1>
    <?php
    $x = 1;

    while($x <= 5) {
        echo "the number is: $x <br>";
        $x++;
    }
    ?>
</div>

<?php
include_once "footer.php"
?>
