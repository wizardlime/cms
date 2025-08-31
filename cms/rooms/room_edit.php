<?php 

    include __DIR__ . '/../header.php';    
    include __DIR__ . '/../includes/auth.php'; 


    $room_id = $_GET['room_id'];
    $selectRoom = "SELECT * FROM rooms WHERE room_id = :room_id";
    $statement = $pdo->prepare($selectRoom);
    $statement->execute([':room_id' => $room_id]);
    $room = $statement->fetch(PDO::FETCH_OBJ);

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $room_name = $_POST['room_name'];
    $room_description = $_POST['room_description'];
    $room_beds = $_POST['room_beds'];
    $room_doornumber = $_POST['room_doornumber'];
    $room_status = $_POST['room_status'];

    $query = "UPDATE rooms SET room_name=:room_name, room_description=:room_description, room_beds=:room_beds, room_doornumber=:room_doornumber, room_status=:room_status WHERE room_id=:room_id";
    $statement = $pdo->prepare($query);

    if($statement->execute([
        ':room_name' => $room_name,
        ':room_description' => $room_description,
        ':room_beds' => $room_beds,
        ':room_doornumber' => $room_doornumber,
        ':room_status' => $room_status,
        ':room_id' => $room_id
    ])) {
        header('Location: ./rooms_overview.php');
        $message = "Room informations had been updated.";
    }

}

?>

<div class="container my-5 d-flex justify-content-center">
  <div class="card shadow-lg w-100" style="max-width: 500px; background-color: #001d3d; color: white;">
    <div class="card-body">
      <a href="./rooms_overview.php" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left-circle me-1"></i> Go Back
      </a>

      <h2 class="mb-4 text-center">Edit Room #<?= $room->room_id ?></h2>

      <form method="post" class="d-flex flex-column gap-3">
        <input type="text" class="form-control" value="<?= htmlspecialchars($room->room_name) ?>" name="room_name" placeholder="Room Name" required>
        <input type="text" class="form-control" value="<?= htmlspecialchars($room->room_description) ?>" name="room_description" placeholder="Room Description" required>
        <input type="number" class="form-control" value="<?= $room->room_beds ?>" name="room_beds" placeholder="Number of Beds" required>
        <input type="text" class="form-control" value="<?= $room->room_doornumber ?>" name="room_doornumber" placeholder="Door Number" required>

        <select name="room_status" class="form-select" required>
          <option value="Available" <?= $room->room_status == "Available" ? "selected" : "" ?>>Available</option>
          <option value="Booked" <?= $room->room_status == "Booked" ? "selected" : "" ?>>Booked</option>
          <option value="Not Available" <?= $room->room_status == "Not Available" ? "selected" : "" ?>>Not Available</option>
        </select>

        <input type="submit" class="btn btn-primary w-100" value="Edit" name="submit">
      </form>
    </div>
  </div>
</div>

<style>
.card {
  border-radius: 0.75rem;
}

.form-control, .form-select {
  background-color: #002244;
  color: white;
  border: 1px solid #003366;
}

.form-control:focus, .form-select:focus {
  border-color: #00bfa6;
  box-shadow: none;
  background-color: #002244;
  color: white;
}

.btn-primary {
  background-color: #00bfa6;
  border-color: #00bfa6;
}

.btn-primary:hover {
  background-color: #00a28f;
  border-color: #00a28f;
}

.btn-secondary {
  background-color: #6c757d;
  border-color: #6c757d;
}

.btn-secondary:hover {
  background-color: #5a6268;
  border-color: #545b62;
}

@media (max-width: 576px) {
  .card-body {
    padding: 1.5rem 1rem;
  }
}
</style>


