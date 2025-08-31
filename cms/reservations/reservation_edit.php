<?php 

    
include __DIR__ . '/../header.php';
include __DIR__ . '/../includes/auth.php'; 


$reservation_id = $_POST['reservation_id'] ?? $_GET['reservation_id'] ?? null;



$selectReservation = "SELECT * FROM reservations WHERE reservation_id = :reservation_id";
$statement = $pdo->prepare($selectReservation);
$statement->execute([':reservation_id' => $reservation_id]);
$reservation = $statement->fetch(PDO::FETCH_OBJ);


if(!$reservation) {
    die("Reservation has not been found.");
}



if($_SERVER['REQUEST_METHOD'] === 'POST' ) {

    $reservation_name = $_POST['reservation_name'];
    $reservation_lastname = $_POST['reservation_lastname'];
    $reservation_email = $_POST['reservation_email'];
    $reservation_status = $_POST['reservation_status'];
    $reservation_date_from = $_POST['reservation_date_from'];
    $reservation_date_to = $_POST['reservation_date_to'];

    $query = "UPDATE reservations SET reservation_name=:reservation_name, reservation_lastname=:reservation_lastname, reservation_email=:reservation_email,
    reservation_status=:reservation_status, reservation_date_from=:reservation_date_from, reservation_date_to=:reservation_date_to WHERE reservation_id=:reservation_id";
    $statement = $pdo->prepare($query);

    if($statement->execute([
        ':reservation_name' => $reservation_name,
        ':reservation_lastname' => $reservation_lastname,
        ':reservation_email' => $reservation_email,
        ':reservation_date_from' => $reservation_date_from,
        ':reservation_date_to' => $reservation_date_to,
        ':reservation_status' => $reservation_status,
        ':reservation_id' => $reservation_id 
    ])) {
        header('Location: ./reservations_overview.php');
        $message = "Reservation has been updated.";
    } else {
        echo "Error: reservation doesn't exist.";
    }

}

?>
<body class="bg-dark text-white">
<div class="container my-5 d-flex justify-content-center">

  <div class="card shadow-lg w-100" style="max-width: 600px; background-color: #001d3d;">

    <div class="card-body">
      <h2 class="mb-4 text-center">Reservation #<?= $reservation->reservation_id ?></h2>

      <form method="post" class="d-flex flex-column gap-3">
        <div class="mb-3">
          <label class="form-label">Lastname:</label>
          <input type="text" class="form-control" value="<?= $reservation->reservation_lastname ?>" name="reservation_lastname" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Firstname:</label>
          <input type="text" class="form-control" value="<?= $reservation->reservation_name ?>" name="reservation_name" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email:</label>
          <input type="email" class="form-control" value="<?= $reservation->reservation_email ?>" name="reservation_email" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Check-in date:</label>
          <input type="date" class="form-control" value="<?= $reservation->reservation_date_from ?>" name="reservation_date_from" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Check-out date:</label>
          <input type="date" class="form-control" value="<?= $reservation->reservation_date_to ?>" name="reservation_date_to" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Reservation status:</label>
          <select name="reservation_status" class="form-select" required>
            <option value="Active" <?= $reservation->reservation_status == "Active" ? "selected" : "" ?>>Active</option>
            <option value="Cancelled" <?= $reservation->reservation_status == "Cancelled" ? "selected" : "" ?>>Cancelled</option>
            <option value="In Handling" <?= $reservation->reservation_status == "In Handling" ? "selected" : "" ?>>In Handling</option>
          </select>
        </div>

        <input type="submit" class="btn btn-primary w-100" name="submit" value="Submit">
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

.nav-pills .nav-link.active {
  background-color: #00bfa6;
  color: white;
}

.nav-pills .nav-link {
  color: white;
}

@media (max-width: 576px) {
  .card-body {
    padding: 1.5rem 1rem;
  }
}
</style>
