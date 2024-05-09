<?php
include_once "header.php";
?>


<?php
$conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(id) as count FROM shifts where user_id = 1";
$rec_present = mysqli_query($conn, $sql);
if ($rec_present) {
    $row = mysqli_fetch_assoc($rec_present);
    $rec_count = $row['count'];
    ?>

    <div class="container-fluid"><br>
    <h1>Pay Calculator V01</h1>
    </div>
    <div class="container-fluid mb-1">
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
            <form action="/pay_calculator_V01.php">
                <label for="date">Date:</label>
                <input type="date" class="form-control mb-3" id="date" name="date">
            </form>
            <form action="/pay_calculator_V01.php">
                <label for="s_time">Start time:</label>
                <input type="time" class="form-control mb-3" id="s_time" name="s_time">

            </form>
            <form action="/pay_calculator_V01.php">
                <label for="e_time">End time:</label>
                <input type="time" class="form-control mb-3" id="e_time" name="e_time">

            </form>
    </div><!-- /.col-lg-4 -->

    <div class="col-lg-2">
        <br>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
            <label class="form-check-label mb-2" for="flexSwitchCheckDefault">Start is a holiday</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
            <label class="form-check-label mb-3" for="flexSwitchCheckDefault">End is a holiday</label>
        </div>
        <button type="submit" class="form-control mb-3  btn  btn-success">Add Shift</button>


        <button id="btn_delete_shift" name="btn_delete_shift" type="button"
                style="width: 100%"
                class="btn btn-outline-danger  mb-3 delete_shift">
            Clear all shifts
        </button>
        <script src="clear_shifts.js"></script>

        <button id="btn_edit_fixed_values" name="btn_edit_fixed_values" type="button"
                style="width: 100%"
                class="btn btn-outline-warning  mb-3 edit_value">
            Edit Fixed values
        </button>

        <button id="btn_calculate_pay" name="btn_calculate_pay" type="button"
                style="width: 100%"
                class="btn btn-outline-info  mb-3 calculate_pay">
            Calculate pay
        </button>



        <br><br><br>
    </div><!-- /.col-lg-4 -->




    <div class="col-lg-5 navbar-nav-scroll">
    <table class="  table table-bordered table-sm table-hover ">
    <thead class="thead-dark">
    <tr>
        <th class= scope="col">id</th>
        <th class= scope="col">user_id</th>
        <th class= scope="col">rate</th>
        <th class= scope="col">s_date</th>
        <th class= scope="col">s_time</th>
        <th class= scope="col">s_holi</th>
        <th class= scope="col">e_time</th>
        <th class= scope="col">e_holi</th>
        <th class= scope="col">uni_allow</th>
        <th class= scope="col">lau_allow</th>
        <th class= scope="col">pm_allow</th>
        <th class= scope="col">config</th>

    </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT id, user_id, rate, s_date, s_time, e_time, uni_allow, PM_allow FROM shifts";
    $result = $conn->query($sql);



    $query = "SELECT * FROM shifts WHERE user_id = 1 ORDER BY s_date"; // query
    $conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
    $result = mysqli_query($conn, $query); // run query

    $numRecords = 0; // initialized
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Check if array keys exist before accessing them
            $s_holi = isset($row["s_holi"]) && $row["s_holi"] == "1" ? "Y" : "N";
            $e_holi = isset($row["e_holi"]) && $row["e_holi"] == "1" ? "Y" : "N";
            $lau_allow = isset($row["lau_allow"]) ? $row["lau_allow"] : "";
            $pm_allow = isset($row["pm_allow"]) ? $row["pm_allow"] : "";

            $date = date_create($row["s_time"]);
            $s_time = date_format($date, "H:i");
            $date = date_create($row["e_time"]);
            $e_time = date_format($date, "H:i");

            echo '
        <tr>
        <td style="text-align:right;">' . $row["id"] . '</td>
        <td style="text-align:right;">' . $row["user_id"] . '</td>
         <td style="text-align:right;">' . $row["rate"] . '</td>
         <td style="text-align:right;">' . $row["s_date"] . '</td>
        <td style="text-align:right;">' . $s_time . '</td>
        <td style="text-align:right;">' . $s_holi . '</td>
        <td style="text-align:right;">' . $e_time . '</td>
        <td style="text-align:right;">' . $e_holi . '</td>
        <td style="text-align:right;">' . $row["uni_allow"] . '</td>
        <td style="text-align:right;">' . $lau_allow . '</td>
        <td style="text-align:right;">' . $pm_allow . '</td>
        <td style="text-align:center;">
        <a type="button" title="Delete" id="row_delete" style="color:#0099cc;font-size:20px;padding-right:8px;">
        <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a type="button" title="Edit" id="row_edit" style="color:#0099cc;font-size:20px;">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        </a>
        </td>
        </tr>
        ';
        }
    } else {
        echo "no records found";
    }


    ?>
    <?php
    echo "number of shifts: " . $rec_count;
} else {
    echo "Error executing query: " . mysqli_error($conn);
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