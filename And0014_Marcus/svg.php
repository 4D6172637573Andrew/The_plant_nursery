<?php
include_once "header.php"
?>

<?php
session_start();

if (!isset($_SESSION["word"])) {
    // Read words from file
    $words = file("words.txt", FILE_IGNORE_NEW_LINES);

    // Select a random word
    $randomIndex = array_rand($words);
    $_SESSION["word"] = strtoupper($words[$randomIndex]);

    // Initialize guessed letters and body part count
    $_SESSION["guessedLetters"] = [];
    $_SESSION["bodyPartCount"] = 0;
}

// Process user input
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["guess"])) {
        $guess = strtoupper($_POST["guess"]);
        $word = $_SESSION["word"];
        $guessedLetters = $_SESSION["guessedLetters"];
        $bodyPartCount = $_SESSION["bodyPartCount"];

        if (!in_array($guess, $guessedLetters)) {
            $_SESSION["guessedLetters"][] = $guess;
            if (strpos($word, $guess) === false) {
                $_SESSION["bodyPartCount"] = $bodyPartCount + 1;
            }
        }
    } elseif (isset($_POST["reset"])) {
        session_destroy();
        header("Location: Hangman_play.php");
        exit();
    }
}

// Check win condition
function checkWinCondition($word, $guessedLetters)
{
    $letters = str_split($word);
    $win = true;

    foreach ($letters as $letter) {
        if (!in_array($letter, $guessedLetters)) {
            $win = false;
            break;
        }
    }

    return $win;
}

// Check if game is won
$word = $_SESSION["word"];
$guessedLetters = $_SESSION["guessedLetters"];
$gameWon = checkWinCondition($word, $guessedLetters);
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        svg {
            background-color: white;
        }

        .animated-line {
            stroke-dasharray: 1000;
            stroke-dashoffset: 1000;
            animation-fill-mode: forwards;
        }

        .animated-line.head {
            animation: draw-line 2s linear forwards;
        }

        .animated-line.body {
            animation: draw-line 3s linear forwards;
        }

        .animated-line.left-arm {
            animation: draw-line 4s linear forwards;
        }

        .animated-line.right-arm {
            animation: draw-line 5s linear forwards;
        }

        .animated-line.left-leg {
            animation: draw-line 6s linear forwards;
        }

        .animated-line.right-leg {
            animation: draw-line 7s linear forwards;
        }

        .animated-line.gallows {
            animation: draw-line 1s linear forwards;
        }

        @keyframes draw-line {
            to {
                stroke-dashoffset: 0;
            }
        }
    </style>
</head>

<body>
<h1>Hangman Game</h1>
<h2><?php echo implode(" ", str_split($word)); ?></h2>

<svg width="300" height="400">
    <!-- Gallows -->
    <line class="animated-line gallows" x1="20" y1="380" x2="220" y2="380" stroke="black" stroke-width="4" />
    <line class="animated-line gallows" x1="60" y1="380" x2="60" y2="50" stroke="black" stroke-width="4" />
    <line class="animated-line gallows" x1="58" y1="50" x2="160" y2="50" stroke="black" stroke-width="4" />
    <line class="animated-line gallows" x1="160" y1="48" x2="160" y2="80" stroke="black" stroke-width="4" />

    <!-- Head -->
    <circle class="animated-line head" cx="160" cy="110" r="30" stroke="black" stroke-width="4" fill="none" />

    <!-- Body -->
    <line class="animated-line body" x1="160" y1="140" x2="160" y2="260" stroke="black" stroke-width="4" />

    <!-- Arms -->
    <line class="animated-line left-arm" x1="160" y1="160" x2="120" y2="200" stroke="black" stroke-width="4" />
    <line class="animated-line right-arm" x1="160" y1="160" x2="200" y2="200" stroke="black" stroke-width="4" />

    <!-- Legs -->
    <line class="animated-line left-leg" x1="160" y1="260" x2="120" y2="320" stroke="black" stroke-width="4" />
    <line class="animated-line right-leg" x1="160" y1="260" x2="200" y2="320" stroke="black" stroke-width="4" />
</svg>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="text" name="guess" placeholder="Enter a letter" maxlength="1" autocomplete="off">
    <button type="submit">Guess</button>
</form>

<?php
if ($gameWon) {
    echo "<h3>Congratulations! You won!</h3>";
    echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
    echo "<button type='submit' name='reset'>Play Again</button>";
    echo "</form>";
}
?>

<script>
    const animatedLines = document.querySelectorAll('.animated-line');

    animatedLines.forEach((line, index) => {
        line.style.animationDelay = '0s'; // Set initial animation delay to 0s
    });

    // Function to delay the animation for a specific body part
    function delayAnimation(bodyPart, delay) {
        setTimeout(() => {
            bodyPart.classList.add('animated-line');
        }, delay);
    }

    // Function to animate the hangman figure
    function animateHangman() {
        const bodyPartCount = <?php echo $_SESSION["bodyPartCount"]; ?>;

        if (bodyPartCount >= 1) {
            const head = document.querySelector('.head');
            delayAnimation(head, 1000);
        }
        if (bodyPartCount >= 2) {
            const body = document.querySelector('.body');
            delayAnimation(body, 2000);
        }
        if (bodyPartCount >= 3) {
            const leftArm = document.querySelector('.left-arm');
            delayAnimation(leftArm, 3000);
        }
        if (bodyPartCount >= 4) {
            const rightArm = document.querySelector('.right-arm');
            delayAnimation(rightArm, 4000);
        }
        if (bodyPartCount >= 5) {
            const leftLeg = document.querySelector('.left-leg');
            delayAnimation(leftLeg, 5000);
        }
        if (bodyPartCount >= 6) {
            const rightLeg = document.querySelector('.right-leg');
            delayAnimation(rightLeg, 6000);
        }
    }

    // Call the animateHangman function after a delay to allow the animations to start from the beginning
    setTimeout(animateHangman, 100);
</script>
</body>

</html>

<?php
include_once "footer.php"
?>
