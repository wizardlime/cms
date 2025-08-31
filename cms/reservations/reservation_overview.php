<?php 
include __DIR__ . '/../header.php';
include __DIR__ . '/../includes/auth.php'; 


$reservation_id = $_GET['reservation_id'];
$selectReservation = "SELECT * FROM reservations WHERE reservation_id = :reservation_id";
$statement = $pdo->prepare($selectReservation);
$statement->execute([':reservation_id' => $reservation_id]);
$reservation = $statement->fetch(PDO::FETCH_OBJ);

?>

<div class="d-flex justify-content-center my-5">
  <div class="card shadow-sm bg-dark text-white w-100" style="max-width: 600px;">
    <div class="card-body p-4">
      <?php if($reservation): ?> 
        <h4 class="mb-3 text-center">Reservation #<?= $reservation->reservation_id ?> Overview</h4>

        <div class="reservation-info mb-3">
          <p><strong>Last Name:</strong> <?= $reservation->reservation_lastname ?></p>
          <p><strong>First Name:</strong> <?= $reservation->reservation_name ?></p>
          <p><strong>Email:</strong> <?= $reservation->reservation_email ?></p>
          <p><strong>Room ID:</strong> <?= $reservation->room_id ?></p>
          <p><strong>Date From:</strong> <?= $reservation->reservation_date_from ?></p>
          <p><strong>Date To:</strong> <?= $reservation->reservation_date_to ?></p>
        </div>

        <div class="d-flex flex-column flex-sm-row justify-content-center gap-2 mt-3">
          <a href="reservation_edit.php?reservation_id=<?= $reservation->reservation_id ?>" class="btn btn-warning flex-fill">
            <i class="bi bi-pencil-fill me-1"></i> Edit
          </a>
          <a href="reservation_delete.php?reservation_id=<?= $reservation->reservation_id ?>" class="btn btn-danger flex-fill">
            <i class="bi bi-trash-fill me-1"></i> Delete
          </a>
        </div>
      <?php endif ?>
    </div>
  </div>
</div>

<style>
.card {
  border-radius: 0.75rem;
}

.card strong {
  color: #00bfa6;
}

.btn-warning {
  background-color: #ffc107;
  border-color: #ffc107;
}

.btn-warning:hover {
  background-color: #e0a800;
  border-color: #d39e00;
}

.btn-danger {
  background-color: #dc3545;
  border-color: #dc3545;
}

.btn-danger:hover {
  background-color: #b02a37;
  border-color: #842029;
}

/* Responsywność */
@media (max-width: 576px) {
  .card-body {
    padding: 1.5rem 1rem;
  }
  .d-flex.flex-column.flex-sm-row {
    flex-direction: column !important;
  }
  .btn-warning, .btn-danger {
    width: 100%;
  }
}
</style>
