<?php
include_once "Header.php";




$fruits = array('apple',"banana", 'orange');

?>

<div class="container">
    <h1>String</h1>

    <?php
    $str = "Griffin is the best house";
    $num = "512";

    echo ("<br>Num divided by 2 is $num/2");
    $temp = $num/2;
    echo ("<br>Num divided by 2 is ". $temp/2);
    echo ("<br>Num divided by 2 is $temp");

    //chopping a string
    echo "<br><br><b><u>Chopping a string using 2 different methods: </u></b>";
    $temp = substr($str, 8);
    echo ("<br>String without Griffin = $temp");

    //another way to chop a string 
    $temp_house = "Griffin";
    echo ("<br>String without Griffin = <b> $temp </b>");

    //exploding a string
    echo "<br><br><b><u>Exploding a string: </u></b>";
    echo("<br>");
    print_r (explode(" ", $str));
    $arr_str = explode(" ", $str);
    echo ("<br>");
    print_r ($arr_str);


    //array splice, third element will be removed
    echo "<br><br><b><u>Array Splice (third element removed):</u></b>"; //<line break><line break><bold><underline> title <underline><bold><line break>
    array_splice($arr_str, 2, 1); //removing the third element
    
    
    //print each word in the array using the foreach loop
    foreach ($arr_str as $value) {
        echo "<br>$value";

    }
    echo("<br>");
    echo "<br><b><u>Adding elements to the end in an array: </u></b><br>";
    array_push($fruits, "kiwi", "grape");
    foreach ($fruits as $value) {
        echo "$value, ";
    }
    echo("<br>");
    echo"<br><b><u>Breaking and joining arrays: </u></b><br>";
    //break the array into 2 smaller parts
    $arr1 = array_slice($fruits, 0, 2);
    $arr2 = array_slice($fruits, 2, 3);
    //Join the 2 arrays back together
    $new_arr = array_merge($arr1, $arr2);
    foreach ($new_arr as $value) {
        echo "$value, ";
    }

    //removing grape from the end of the array.
    echo"<br><br><b><u>Removing elements using array_shift </u></b><br>";
    $removed_front_item = array_shift($fruits);
    echo ("First item in fruit array:<i> $removed_front_item </i><br>");
    echo ("Array output after removing the first item: ");
    foreach ($fruits as $value) {
        echo "<i>$value,</i> ";
    }
    ?>


</div>

<?php
include_once "footer.php";
?>
