<?php
include_once "phub_header.php";
?>

<?php
require "includes/config.php";
$conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(id) as count FROM shifts where user_id = 1";
$rec_present = mysqli_query($conn, $sql);
if ($rec_present) {
    $row = mysqli_fetch_assoc($rec_present);
    $rec_count = $row['count'];
    echo "number of shifts: " . $rec_count;
} else {
    echo "Error executing query: " . mysqli_error($conn);
}
?>

<div class="container-fluid">
    <h1>Pay calculator</h1>

    <div class="row">
        <div class="col-lg-2">
            <form  method="post">
                <div class="form-group">
                    <label for="rate">Hourly Rate:</label>
                    <input type="number" class="form-control mb-3" id="rate" name="rate" placeholder="Enter Rate">
                </div>
                <div class="form-group">
                    <label for="uni_a">Uniform Allowance</label>
                    <input type="number" class="form-control mb-3" id="uni_a" name="uni_a" placeholder="Enter Allowance">
                </div>
                <div class="form-group">
                    <label for="help">Help:</label>
                    <input type="number" class="form-control mb-3" id="help" name="help" placeholder="Enter Rate">
                </div>
                <div class="form-group">
                    <label for="sal_pack">Salary Package:</label>
                    <input type="number" class="form-control mb-3" id="sal_pack" name="sal_pack" placeholder="Enter Rate">
                </div>
                <div class="form-group">
                    <label for="other_in">Other income:</label>
                    <input type="number" class="form-control mb-3" id="other_in" name="other_in" placeholder="Enter Rate">
                </div>
                <div class="form-group">
                    <label for="other_de">Other deductions:</label>
                    <input type="number" class="form-control mb-3" id="other_de" name="other_de" placeholder="Enter Rate">
                </div>
            </form>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-2">
            <form  method="post">

                <div class="form-group">
                    <label for="sat_pe">Saturday penalty:</label>
                    <input type="number" class="form-control mb-3" id="sat_pe" name="sat_pe" placeholder="Enter Rate">
                </div>
                <div class="form-group">
                    <label for="sun_pe">Saturday penalty:</label>
                    <input type="number" class="form-control mb-3" id="sun_pe" name="sun_pe" placeholder="Enter Rate">
                </div>
                <div class="form-group">
                    <label for="other_in">Tax:</label>
                    <input type="number" class="form-control mb-3" id="other_in" name="other_in" placeholder="Enter Rate">
                </div>
                <form action="/pay_calculator2.php">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control mb-3" id="date" name="date">
                </form>
                <form action="/pay_calculator2.php">
                    <label for="s_time">Start time:</label>
                    <input type="time" class="form-control mb-3" id="s_time" name="s_time">

                </form>
                <form action="/pay_calculator2.php">
                    <label for="e_time">End time:</label>
                    <input type="time" class="form-control mb-3" id="e_time" name="e_time">

            </form>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-2">
<br>
            <input type="checkbox" id="check_box" name="check_box" value="check_box">
            <label class="form-check-label" for="check_box">Start is a holiday </label><br>
            <input type="checkbox" id="check_box" name="check_box" value="check_box">
            <label class="form-check-label" for="check_box"> End is a holiday  </label>
            <button type="submit" class="form-control btn btn-success">SUBMIT</button>
            <br><br><br>
        </div><!-- /.col-lg-4 -->




<div class="col-lg-2">
        <table class="table table-bordered table-hover table-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">user_id</th>
                <th scope="col">rate</th>
                <th scope="col">s_date</th>
                <th scope="col">s_time</th>
                <th scope="col">e_time</th>
                <th scope="col">uni_allow</th>
                <th scope="col">PM_allow</th>
                <th scope="col">AM_allow</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT id, user_id, rate, s_date, s_time, e_time, uni_allow, PM_allow, AM_allow  FROM shifts";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $row["id"] . "</th>";
                    echo "<td>" . $row["user_id"] . "</td>";
                    echo "<td>" . $row["rate"] . "</td>";
                    echo "<td>" . $row["s_date"] . "</td>";
                    echo "<td>" . $row["s_time"] . "</td>";
                    echo "<td>" . $row["e_time"] . "</td>";
                    echo "<td>" . $row["uni_allow"] . "</td>";
                    echo "<td>" . $row["PM_allow"] . "</td>";
                    echo "<td>" . $row["AM_allow"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>0 results</td></tr>";
            }
            ?>
            </tbody>
        </table>
</div>

        <?php
        mysqli_close($conn);
        ?>
        <?php
include_once "footer.php";
?>
