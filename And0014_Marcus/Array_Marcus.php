<?php
include_once "Header.php"
?>

<div class="container">
    <h1>Array</h1>
    <?php
    $x = "Holden";
    $cars = array($x, "Volvo", "BMW", "Toyota");
    echo "I like " . $cars[0] . ", " . $cars[1] . " and " . $cars[2] . ".";
    echo("<br>");
    echo "I like $cars[0], $cars[1], and $cars[2]";

    $name = "Marcus";
    $age = array("Winston" => "15", "Timofey" => "16", "Marcus" => "16", "Bobby" => "53");
    echo ("<br>$name's age is $age[$name]");

    $age = array(15, 16, 16, 53);
    $name = array("Winston", "Timofey", "Marcus", "Bobby");

    for($x =0; $x < count($name); $x++) {
        echo "<br>$name[$x]'s age is $age[$x]";
    }
    ?>

<?php
include_once "footer.php"
?>
