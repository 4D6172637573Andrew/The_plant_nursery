<?php
include_once "header.php";
?>

<div class="container">
    <br><h1>Login check:</h1>
    <?php
    $_SESSION["logged_in"] = "no";
    if(isset($_POST["login"]) && isset($_POST["password"])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pay2_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $input_login_id = $_POST["login"];
        $input_password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE code = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $input_login_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row["Password"];

            if ($input_password === $stored_password) {
                echo "<br><b>Login successful!</b><br><br>";
                $_SESSION["logged_in"] = "yes";

            } else {
                echo "<br><b>Invalid login ID or Password.</b><br><br>";
                $_SESSION["logged_in"] = "no";

            }
        } else {
            echo "<br><b>Invalid login ID or Password.</b><br><br>";
        }
    } else {
        header("location:login_form.php");
    }

    $stmt->close();
    $conn->close();
    ?>
</div>

<?php
include_once "footer.php";
?>
