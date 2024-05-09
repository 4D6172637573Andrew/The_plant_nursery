<?php
include_once "header.php"
?>


<div class="container">
    <h1>Number guess game</h1>
    <p>guess a number between 1-10</p>
    <form method="post" action="Number_guessing_game_play.php">
        <label for="num_attempts">pick a number of attempts:</label>
        <input type="number" id="num_attempts" name="num_attempts" value="10"><br><br><br>
        <input type="submit" value="Start the game"><br><br>
    </form>
    <?php
    $_SESSION["num_guess_allowed"] = 0;
    $_SESSION["num_guess_left"] = 0;
    ?>
</div>

    <?php
    include_once "footer.php"
    ?>
