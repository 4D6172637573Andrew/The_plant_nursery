<?php
include_once "header.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hangman Game</title>
    <style>
        .hangman-container {
            display: flex;
            justify-content: space-between;
        }

        svg {
            height: 400px;
            width: 400px;
        }

        .gallows {
            fill: none;
            stroke: black;
            stroke-width: 4;
            stroke-dasharray: 500;
            stroke-dashoffset: 500;
            animation: gallowsAnimation 2s linear forwards;
        }

        .head {
            fill: white;
            stroke: black;
            stroke-width: 4;
            opacity: 0;
            animation: headAnimation 0.5s linear forwards;
        }

        .body {
            stroke: black;
            stroke-width: 4;
            opacity: 0;
            animation: bodyAnimation 0.5s linear forwards;
        }

        .arm-leg {
            stroke: black;
            stroke-width: 4;
            opacity: 0;
            animation: armLegAnimation 10s linear forwards;
        }

        @keyframes gallowsAnimation {
            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes headAnimation {
            to {
                opacity: 1;
            }
        }

        @keyframes bodyAnimation {
            to {
                opacity: 1;
            }
        }

        @keyframes armLegAnimation {
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<h1>Hangman Game</h1>

<?php
$words = file("words2.txt");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["gallows"])) {
    $_SESSION["gallows"] = 0;
}

if (isset($_POST["reset"])) {
    session_unset();
    session_destroy();
    header("Location: Hangman_play(2).php");
    exit();
}

if (empty($_SESSION["randomWord"])) {
    $randomIndex = array_rand($words);
    $_SESSION["randomWord"] = strtolower($words[$randomIndex]);
    $_SESSION["displayWord"] = str_repeat("_ ", strlen($_SESSION["randomWord"]) - 1) . str_repeat("_", substr_count($_SESSION["randomWord"], " "));
}

if (isset($_POST["letter"])) {
    $letter = strtolower($_POST["letter"]);

    if (strpos($_SESSION["randomWord"], $letter) !== false) {
        $wordArray = str_split($_SESSION["randomWord"]);
        $displayArray = str_split($_SESSION["displayWord"]);

        foreach ($wordArray as $index => $char) {
            if ($char === $letter) {
                $displayArray[$index * 2] = $char;
            }
        }

        $_SESSION["displayWord"] = implode($displayArray);
    } else {
        $_SESSION["gallows"]++;

        // Add the wrong letter to the array
        $_SESSION["wrongLetters"][] = $letter;
    }
}

if (str_replace(" ", "", $_SESSION["displayWord"]) === str_replace(" ", "", $_SESSION["randomWord"]) && !empty($_SESSION["displayWord"])) {
    $message = "<b>CONGRATULATIONS! You guessed the word: </b>" . $_SESSION["randomWord"] . ".";
    session_unset();
    session_destroy();
} elseif ($_SESSION["gallows"] >= 10) {
    $message = "<b>YOU LOST!!! The word was: </b>" . $_SESSION["randomWord"] . ".";
    session_unset();
    session_destroy();
}
?>

<div class="hangman-container">
    <div>
        <svg viewBox="0 0 400 400">
            <g class="gallows">
                <?php if ($_SESSION["gallows"] >= 1) : ?>
                    <line x1="20" y1="380" x2="220" y2="380"/>
                <?php endif; ?>

                <?php if ($_SESSION["gallows"] >= 2) : ?>
                    <line x1="60" y1="20" x2="60" y2="380"/>
                <?php endif; ?>

                <?php if ($_SESSION["gallows"] >= 3) : ?>
                    <line x1="58" y1="20" x2="160" y2="20"/>
                <?php endif; ?>

                <?php if ($_SESSION["gallows"] >= 4) : ?>
                    <line x1="160" y1="20" x2="160" y2="60"/>
                <?php endif; ?>

                <?php if ($_SESSION["gallows"] >= 5) : ?>
                    <circle class="head" cx="160" cy="100" r="40"/>
                <?php endif; ?>

                <?php if ($_SESSION["gallows"] >= 6) : ?>
                    <line x1="160" y1="140" x2="160" y2="260"/>
                <?php endif; ?>

                <?php if ($_SESSION["gallows"] >= 7) : ?>
                    <line x1="160" y1="180" x2="120" y2="140"/>
                <?php endif; ?>

                <?php if ($_SESSION["gallows"] >= 8) : ?>
                    <line x1="160" y1="180" x2="200" y2="140"/>
                <?php endif; ?>

                <?php if ($_SESSION["gallows"] >= 9) : ?>
                    <line x1="160" y1="260" x2="120" y2="300"/>
                <?php endif; ?>

                <?php if ($_SESSION["gallows"] >= 10) : ?>
                    <line x1="160" y1="260" x2="200" y2="300"/>
                <?php endif; ?>
            </g>
        </svg>
    </div>

    <div>
        <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
            <form method="POST" action="">
                <button type="submit" name="newGame">Start a New Game</button>
            </form>
        <?php else : ?>
            <p><?php echo $_SESSION["displayWord"]; ?></p>

            <?php if (!empty($_SESSION["wrongLetters"])) : ?>
                <p>Wrong letters: <?php sort($_SESSION["wrongLetters"]); echo implode(", ", $_SESSION["wrongLetters"]); ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <label for="letter">Guess a letter:</label>
                <input type="text" id="letter" name="letter" maxlength="1">
                <button type="submit">Submit</button>
            </form>

            <form method="POST" action="">
                <button type="submit" name="reset">Reset Game</button>
            </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

<?php
include_once "footer.php"
?>
