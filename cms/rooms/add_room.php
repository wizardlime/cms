<?php 


    include __DIR__ . '/../header.php'; 
    include __DIR__ . '/../includes/auth.php'; 


    if(isset($_POST['submit'])){

        $room_name = $_POST['room_name'];
        $room_description = $_POST['room_description'];
        $room_doornumber = $_POST['room_doornumber'];
        $room_beds = $_POST['room_beds'];
        $room_status = $_POST['room_status'];

        $addRoom = "INSERT INTO rooms (room_name, room_description, room_doornumber,room_beds,room_status) 
        VALUES(:room_name, :room_description, :room_doornumber, :room_beds, :room_status)";
        $statement = $pdo->prepare($addRoom);

        $data = [
            ':room_name' => $room_name,
            ':room_description' => $room_description,
            ':room_doornumber' => $room_doornumber,
            ':room_beds' => $room_beds,
            ':room_status' => $room_status
        ];

        if($statement->execute($data)) {
            header('Location: rooms_overview.php');
            $message = "Room has been created.";
        }

        $id = $pdo->lastInsertId();


    };


?>

<div class="container my-5 d-flex justify-content-center">
  <div class="card shadow-lg w-100" style="max-width: 500px; background-color: #001d3d; color: white;">
    <div class="card-body">
      <h2 class="mb-4 text-center">Add New Room</h2>

      <form method="post" class="d-flex flex-column gap-3">
        <input type="text" class="form-control" name="room_name" placeholder="Room Name" required>
        <input type="number" class="form-control" name="room_beds" placeholder="Number of Beds" required>
        <input type="text" class="form-control" name="room_doornumber" placeholder="Room Door Number" required>

        <select name="room_status" class="form-select" required>
          <option value="Available" selected>Available</option>
          <option value="Booked">Booked</option>
          <option value="Not Available">Not Available</option>
        </select>

        <textarea name="room_description" class="form-control" rows="4" placeholder="Room Description"></textarea>

        <input type="submit" class="btn btn-primary w-100" value="Add" name="submit">
      </form>
    </div>
  </div>
</div>

<style>
.card {
  border-radius: 0.75rem;
}

.form-control, .form-select, textarea {
  background-color: #002244;
  color: white;
  border: 1px solid #003366;
}

.form-control:focus, .form-select:focus, textarea:focus {
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

@media (max-width: 576px) {
  .card-body {
    padding: 1.5rem 1rem;
  }
}
</style>


