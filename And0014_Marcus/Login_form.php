<?php
include_once "header.php";
?>

<div class="container">
    <br>
    <h1>Login Page:</h1>
    <form action="Login_check.php" method="post">
        <div class="form-group">
            <label for="login">Login ID:</label>
            <input type="text" class="form-control" id="login" name="login" placeholder="Enter login ID">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
        </div><br>
        <button type="submit" class="btn btn-success">LOGIN</button>
        <br><br><br><br><br><br><br><br><br>
    </form>
</div>



<?php
include_once "footer.php";
?>
