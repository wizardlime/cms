<?php 

    
include __DIR__ . '/../header.php'; 

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
<body class="container">
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link" href="../dashboard.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reservations_overview.php">Reservations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../rooms/rooms_overview.php">Rooms</a>
      </li>
    </ul>
  </div>
</div>
<form method="post">
    <h2>Reservation nr. <?php $reservation->reservation_id ?> </h2>
  <div class="mb-3">
    <label for="lastName" class="form-label">Lastname:</label>
    <input type="text" class="form-control" value=<?= $reservation->reservation_lastname ?> name="reservation_lastname">
  </div>
  <div class="mb-3">
    <label for="firstName" class="form-label">Firstname:</label>
    <input type="text" class="form-control" value=<?= $reservation->reservation_name ?> name="reservation_name">
  </div>
  <div class="mb-3">
    <label for="reservationEmail" class="form-label">Email:</label>
    <input type="text" class="form-control" value=<?= $reservation->reservation_email ?> name="reservation_email">
  </div>
  <div class="mb-3">
    <label for="checkinDate" class="form-label">Check-in date:</label>
    <input type="date" class="form-control" value=<?= $reservation->reservation_date_from ?> name="reservation_date_from">
  </div>
  <div class="mb-3">
    <label for="checkinDate" class="form-label">Check-out date:</label>
    <input type="date" class="form-control" value=<?= $reservation->reservation_date_to ?> name="reservation_date_to">
  </div>
  <div class="mb-3">
    <label for="reservationStatus" class="form-label">Reservation status:</label>
    <select name="reservation_status" id="" class="select-form">
    <option value="Active" name="reservation_status">Active</option>
            <option value="Cancelled" name="reservation_status">Cancelled</option>
            <option value="In Handling" name="reservation_status">In Handling</option>
    </select>
  </div>


  <input type="submit" class="btn btn-primary" name="submit">Submit</input>
</form>

</body>
