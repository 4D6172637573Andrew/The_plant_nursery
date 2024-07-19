<?php
$plant_id = $_GET['id'] ?? null; // Get the plant ID from URL parameter

if ($plant_id === null) {
    echo "Invalid plant ID.";
    exit;
}

$conn = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM plant WHERE id='$plant_id'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "Plant not found.";
    exit;
}

$plant = mysqli_fetch_assoc($result);
?>
<div class="modal fade" id="care_modal" tabindex="-1" aria-labelledby="care_modal_Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $plant['plant_name'] ?> Care Guide</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php echo $plant['care_guide'] ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div> 
  </div>
</div>

<div class="modal fade" id="info_modal" tabindex="-1" aria-labelledby="info_modal_Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Plant Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>