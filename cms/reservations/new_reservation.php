<?php 

include __DIR__ . '/../header.php'; 
include __DIR__ . '/../includes/auth.php'; 




    if(isset($_POST['submit'])) {


        $reservation_name = $_POST['reservation_name'];
        $reservation_lastname = $_POST['reservation_lastname'];
        $reservation_date_from = $_POST['reservation_date_from'];
        $reservation_date_to = $_POST['reservation_date_to'];
        $reservation_email = $_POST['reservation_email'];
        $reservation_status = "New";
        $room_id = $_POST['room_id'];

        $newReservation = "INSERT INTO reservations (reservation_name, reservation_lastname, reservation_date_from, reservation_date_to, reservation_email, reservation_status, room_id) 
        VALUES (:reservation_name, :reservation_lastname, :reservation_date_from, :reservation_date_to, :reservation_email, :reservation_status, :room_id)";
        
        $statement = $pdo->prepare($newReservation);
        $statement->execute([
            ':reservation_name' => $reservation_name,
            ':reservation_lastname' => $reservation_lastname,
            ':reservation_date_from' => $reservation_date_from,
            ':reservation_date_to' => $reservation_date_to,
            ':reservation_email' => $reservation_email,
            ':reservation_status' => $reservation_status,
            ':room_id' => $room_id
        ]);

        echo "Reservation added succesfully";

    }


    $rooms = $pdo->query("SELECT room_id, room_name from rooms")->fetchAll(PDO::FETCH_ASSOC);


?>


<div class="container my-5 d-flex justify-content-center">
  <div class="card shadow-lg w-100" style="max-width: 500px; background-color: #001d3d; color: white;">
    <div class="card-body p-4">
      <h2 class="mb-4 text-center">New Reservation</h2>
      <form action="" method="post" class="d-flex flex-column gap-3">

        <input type="text" name="reservation_name" placeholder="First Name" required class="form-control">
        <input type="text" name="reservation_lastname" placeholder="Last Name" required class="form-control">
        <input type="date" name="reservation_date_from" placeholder="Check-in Date" required class="form-control">
        <input type="date" name="reservation_date_to" placeholder="Check-out Date" required class="form-control">
        <input type="email" name="reservation_email" placeholder="Email Address" required class="form-control">

        <select name="room_id" required class="form-select">
          <option value="" disabled selected>Select Room</option>
          <?php foreach ($rooms as $room): ?>
            <option value="<?= $room['room_id'] ?>">
              <?= htmlspecialchars($room['room_name']) ?>
            </option>
          <?php endforeach ?> 
        </select>

        <input type="submit" value="Submit" name="submit" class="btn btn-primary mt-2">
      </form>
    </div>
  </div>
</div>

<style>
.card {
  border-radius: 0.75rem;
}

.form-control, .form-select {
  /* background-color: #002244; */
  color: white;
  border: 1px solid #003366;
}

.form-control:focus, .form-select:focus {
  background-color: #002244;
  color: white;
  border-color: #00bfa6;
  box-shadow: none;
}

.btn-primary {
  background-color: #00bfa6;
  border-color: #00bfa6;
}

.btn-primary:hover {
  background-color: #00a28f;
  border-color: #00a28f;
}
</style>
