<?php
include_once "Header.php";
?>

<div class="container">
    <h1>delete form:</h1>
    <form action="Data_delete.php" method="post">
        <label for="fname">ID you wish to delete:</label><br><br>
        <input type="number" id="id" name="id"
               value="1" size="7" min="0" max="100"><br><br>
        <button type="submit" class="btn btn-danger">DELETE</button>


    </form>
</div>


<?php
include_once "footer.php";
?>
