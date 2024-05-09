<?php
include_once("header.php");
?>


<?php if (isset($_POST['register'])) { 

$conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)"); $stmt->bind_param("sss", $username, $email, $password); 

$username = $_POST['username']; $email = $_POST['email']; $password = $_POST['password']; 

$password = password_hash($password, PASSWORD_DEFAULT); 

if ($stmt->execute()) { echo "New account created successfully!"; } else { echo "Error: " . $stmt->error; } 

$stmt->close(); $conn->close(); }
?>



<head>
    <meta charset="UTF-8">
    <meta http-equive="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0">
    <Title>login form</Title>
    <link rel="stylesheet" href="login_style.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>
<body>
  <br>
  <div class="box">
    <form action="register.php" method="post">
      <h1>Register</h1>
      <div class="input-box">
        <input type="text" id="username" name="username" placeholder="Enter Username" required>
        <box-icon name='user'></box-icon>
      </div>
      <div class="input-box">
        <input type="email" id="email" name="email" placeholder="Enter email" required>
        <box-icon name='envelope'></box-icon>
      </div>
      <div class="input-box">
        <input type="password" id="password" name="password" placeholder="Enter Password" required>
        <box-icon name='lock-alt'></box-icon>
      </div>
      <button name="register" value="register" type="submit" class="btn btn-outline-success">register</button>
      <div class="register-link">
        <p>Already have an account? <a href="Login.php">Login</a></p>
      </div>
    </form>
  </div>
</body>
</html>