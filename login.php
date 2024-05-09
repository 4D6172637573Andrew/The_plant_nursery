<?php
include_once("header.php");

// Check if the login form is submitted
if (isset($_POST['login'])) {
    // Connect to the database
    $conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }

    // Sanitize input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['username'] = $username;

            // Redirect to index page
            header("Location: index.php");
            exit;
        } else {
            // Incorrect password
            echo "Incorrect password!";
        }
    } else {
        // User not found
        echo "User not found!";
    }

    // Close prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>


<head>
    <meta charset="UTF-8">
    <meta http-equive="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0">
    <Title>login form</Title>
    <link rel="stylesheet" href="css/login_style.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>

<body>
  <br>
  <div class="box">
    <form action="Login.php" method="post">
      <h1>Login</h1>
      <div class="input-box">
        <input type="text" id="username" name="username" placeholder="Enter Username" required>
        <box-icon name='user'></box-icon>
      </div>
      <div class="input-box">
        <input type="password" id="password" name="password" placeholder="Enter Password" required>
        <box-icon name='lock-alt'></box-icon>
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox"> Remember me</label>
        <a href="forgot_pass.php">Forgot Password?</a>
      </div>
      <button name="login" value="login" type="submit" class="btn btn-outline-success">Login</button>
      <div class="register-link">
        <p>No account? <a href="register.php">Signup</a></p>
      </div>
    </form>
  </div>
</body>
</html>
