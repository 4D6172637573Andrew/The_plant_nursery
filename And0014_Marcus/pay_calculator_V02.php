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
    <h1>Pay Calculator V02</h1>
</div>
<div class="container-fluid mb-1">
    <div class="row">
        <div class="col-lg-2">
            <form id="shiftForm" method="post">
                <div class="container">
                    <label for="hourlyRate">Hourly Rate:</label>
                    <input type="number" class="form-control mb-3" id="hourlyRate" name="hourlyRate" placeholder="Enter Rate">
                    <label for="uniformAllowance">Uniform Allowance</label>
                    <input type="number" class="form-control mb-3" id="uniformAllowance" name="uniformAllowance" placeholder="Enter Allowance">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control mb-3" id="date" name="date">
                    <label for="startTime">Start time:</label>
                    <input type="time" class="form-control mb-3" id="startTime" name="startTime">
                    <label for="endTime">End time:</label>
                    <input type="time" class="form-control mb-3" id="endTime" name="endTime">
                </div>
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
            <label class="form-check-label mb-2" for="flexSwitchCheckDefault">End is a holiday</label>
        </div>
        <button type="button" id="addShift" class="form-control mb-2 btn btn-success">Add Shift</button>


        <button id="btn_delete_shift" name="btn_delete_shift" type="button"
                style="width: 100%"
                class="btn btn-outline-danger  mb-2 delete_shift">
            Clear all shifts
        </button>
        <script src="clear_shifts.js"></script>

        <button id="btn_edit_fixed_values" name="btn_edit_fixed_values" type="button"
                style="width: 100%"
                class="btn btn-outline-warning  mb-2 edit_value">
            Edit Fixed values
        </button>

        <button id="btn_calculate_pay" name="btn_calculate_pay" type="button"
                style="width: 100%"
                class="btn btn-outline-info  mb-3 calculate_pay">
            Calculate pay
        </button>



        <br><br><br>
    </div><!-- /.col-lg-4 -->




        <div class="col-lg-8">
            <table class="table table-bordered table-sm table-hover ">
                <thead class="thead-dark">
                <tr>
                    <th class="scope=" col">id</th>
                    <th class="scope=" col">user_id</th>
                    <th class="scope=" col">rate</th>
                    <th class="scope=" col">s_date</th>
                    <th class="scope=" col">s_time</th>
                    <th class="scope=" col">s_holi</th>
                    <th class="scope=" col">e_time</th>
                    <th class="scope=" col">e_holi</th>
                    <th class="scope=" col">uni_allow</th>
                    <th class="scope=" col">lau_allow</th>
                    <th class="scope=" col">pm_allow</th>
                    <th class="scope=" col">config</th>
                </tr>
                </thead>
                <tbody id="shiftTableBody">
                <?php
                $sql = "SELECT id, user_id, rate, s_date, s_time, e_time, uni_allow, PM_allow FROM shifts";
                $result = $conn->query($sql);

                $query = "SELECT * FROM shifts WHERE user_id = 1 ORDER BY s_date";
                $result = mysqli_query($conn, $query);

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

                        echo '<tr>';
                        echo '<td style="text-align:right;">' . $row["id"] . '</td>';
                        echo '<td style="text-align:right;">' . $row["user_id"] . '</td>';
                        echo '<td style="text-align:right;">' . $row["rate"] . '</td>';
                        echo '<td style="text-align:right;">' . $row["s_date"] . '</td>';
                        echo '<td style="text-align:right;">' . $s_time . '</td>';
                        echo '<td style="text-align:right;">' . $s_holi . '</td>';
                        echo '<td style="text-align:right;">' . $e_time . '</td>';
                        echo '<td style="text-align:right;">' . $e_holi . '</td>';
                        echo '<td style="text-align:right;">' . $row["uni_allow"] . '</td>';
                        echo '<td style="text-align:right;">' . $lau_allow . '</td>';
                        echo '<td style="text-align:right;">' . $pm_allow . '</td>';
                        echo '<td style="text-align:center;">
                            <a type="button" title="Delete" id="row_delete" style="color:#0099cc;font-size:20px;padding-right:8px;">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                            <a type="button" title="Edit" id="row_edit" style="color:#0099cc;font-size:20px;">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                        </td>';
                        echo '</tr>';
                    }
                } else {
                    echo "no records found";
                }


    ?>

    </tbody>
    </table>
            <?php
            echo "number of shifts: " . $rec_count;
            } else {
                echo "Error executing query: " . mysqli_error($conn);
            }

            ?>
    </div>


<?php
mysqli_close($conn);

?>
<?php
include_once "footer.php";
?>
