<?php
include_once "Header.php";
?>

    <div class="container">
        <h1>Update Form:</h1>
        <form action="Data_update.php" method="post">
            <label for="id">ID you wish to update:</label><br><br>
            <input type="number" id="id" name="id"
                   value="1" size="7" min="1" max="101"><br><br>
            <label for="marks">Marks you wish to allocate:</label><br><br>
            <input type="number" id="id" name="marks"
                   value="1" size="7" min="0" max="100"><br><br>
            <button type="submit" class="btn btn-danger">Update</button>

            <?php
            echo "current date: " . date('d/m/Y') . "  (Date will be updated on database)";

            ?>


        </form>
    </div>



<?php
include_once "footer.php";
?>