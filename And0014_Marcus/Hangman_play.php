<?php
include_once "header.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hangman Game</title>

</head>
<body>
<h1>Hangman Game</h1>



<?php
$words = file("words.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Check if a session is already active
if (session_status() == PHP_SESSION_NONE) {
    // Start or resume the session
    session_start();
}

if (isset($_POST["reset"])) {
    // Reset the game
    session_unset();
    session_destroy();
    header("Location: Hangman_play.php");
    exit();
}

if (empty($_SESSION["randomWord"])) {
    // Select a random word
    $randomIndex = array_rand($words);
    $_SESSION["randomWord"] = strtolower($words[$randomIndex]);
    $_SESSION["displayWord"] = str_repeat("_ ", strlen($_SESSION["randomWord"]));
}

// Process user input
if (isset($_POST["letter"])) {
    $letter = strtolower($_POST["letter"]);

    // Check if the picked word contains the guessed letter
    if (strpos($_SESSION["randomWord"], $letter) !== false) {
        // Replace the underscores with the correctly guessed letter
        $wordArray = str_split($_SESSION["randomWord"]);
        $displayArray = str_split($_SESSION["displayWord"]);

        foreach ($wordArray as $index => $char) {
            if ($char === $letter) {
                $displayArray[$index * 2] = $char;
            }
        }

        $_SESSION["displayWord"] = implode($displayArray);
    }
}

// Check if the word has been fully guessed
if (str_replace(" ", "", $_SESSION["displayWord"]) === str_replace(" ", "", $_SESSION["randomWord"])) {
    // Display success message and destroy the session
    $message = "Congratulations! You guessed the word: " . $_SESSION["randomWord"];
    session_unset();
    session_destroy();
}
?>

<?php if (isset($message)) : ?>
    <p><?php echo $message; ?></p>
    <form method="POST" action="">
        <button type="submit" name="newGame">Start a New Game</button>
    </form>
<?php else : ?>
    <p><?php echo $_SESSION["displayWord"]; ?></p>

    <form method="POST" action="">
        <label for="letter">Guess a letter:</label>
        <input type="text" id="letter" name="letter" maxlength="1">
        <button type="submit">Submit</button>
    </form>

    <form method="POST" action="">
        <button type="submit" name="reset">Reset Game</button>
    </form>
<?php endif; ?>

</body>
</html>

<?php
include_once "footer.php";
?>
