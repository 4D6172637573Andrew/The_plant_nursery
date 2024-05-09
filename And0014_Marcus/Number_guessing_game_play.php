<?php
session_start();
include_once "header.php";
?>

<div class="container">
    <h1>Number guess game: GOOD LUCK HAVE FUN!!!</h1>

    <?php
    if(isset($_POST["num_attempts"])) {
        $_SESSION["num_guess_allowed"] = $_POST["num_attempts"];
        $_SESSION["num_guess_left"] = $_SESSION["num_guess_allowed"];
        echo ("Allowed attempts = " . $_SESSION["num_guess_allowed"]);
    }
    ?>

    <form method="post" action="#">
        <label for="num_guess">Enter your guess:</label>
        <input type="number" id="num_guess" name="num_guess"><br><br><br>
        <input type="submit" value="Submit the guess"><br><br>
    </form>

    <?php
    if(isset($_POST["num_guess"])) {
        if (!isset($_SESSION["rand_num"])) {
            $_SESSION["rand_num"] = rand(1, 10);
        }
        echo "Allowed guesses = " . $_SESSION["num_guess_allowed"] . "<br>" ;
        echo "The current guess was =" . $_POST["num_guess"] . "<br>";
        $_SESSION["num_guess_left"]--;
        echo "Guesses left = " . $_SESSION["num_guess_left"] . "<br>";
        if ($_POST["num_guess"] == $_SESSION["rand_num"]) {
            echo "<b>Congrats you are the winner!</b>";
            unset($_SESSION["rand_num"]);
        } elseif ($_SESSION["num_guess_left"] == 0) {
            echo "Imagine losing, the number was " . $_SESSION["rand_num"] . ".";
            unset($_SESSION["rand_num"]);
        }
    }
    ?>

</div>

<?php
include_once "footer.php";
?>
