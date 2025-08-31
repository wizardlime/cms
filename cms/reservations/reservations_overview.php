<?php 

include __DIR__ . '/../header.php';
include __DIR__ . '/../includes/auth.php'; 

$selectAllReservations = "SELECT * FROM reservations";
$statement = $pdo->query($selectAllReservations);
$reservations = $statement->fetchAll(PDO::FETCH_OBJ);

$message = '';

?>



  <?php if(!empty($message)): ?>
    <div class="alert alert-info alert-dismissible fade show py-2 px-3 small" role="alert">
      <?= $message ?>
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif ?>

<section class="d-flex flex-column align-items-center justify-content-center min-vh-100 p-3">

  <div class="d-flex justify-content-end w-100 mb-3" style="max-width: 800px;">
    <a href='./new_reservation.php' class="btn btn-sm btn-primary">
      <i class="bi bi-plus-circle me-1"></i> Add new reservation
    </a>
  </div>

  <?php if(!empty($message)): ?>
    <div class="alert alert-info alert-dismissible fade show w-100" style="max-width: 800px;" role="alert">
      <?= $message ?>
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif ?>

  <div class="table-responsive w-100" style="max-width: 800px;">
    <table class="table table-dark table-hover text-center mb-0">
      <thead class="table-secondary text-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Lastname</th>
          <th scope="col">Email</th>
          <th scope="col">Room ID</th>
          <th scope="col">From</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($reservations as $reservation): ?>
          <tr>
            <th scope="row"><?= $reservation->reservation_id ?></th>
            <td><?= $reservation->reservation_lastname ?></td>
            <td><?= $reservation->reservation_email ?></td>
            <td><?= $reservation->room_id ?></td>
            <td><?= $reservation->reservation_date_from ?></td>
            <td><?= $reservation->reservation_status ?></td>
            <td>
              <a href="./reservation_overview.php?reservation_id=<?= $reservation->reservation_id ?>" class="btn btn-sm btn-info">
                <i class="bi bi-eye"></i>See more
              </a>
            </td>
          </tr>
        <?php endforeach ?> 
      </tbody>
    </table>
  </div>

</section>





  

<style>
  .table tbody tr {
    transition: background-color 0.2s, transform 0.1s;
    border-radius: 0.4rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
  }

  .table tbody tr:hover {
    background-color: #00334d !important;
    transform: translateY(-2px);
  }

  .table td, .table th {
    padding: 0.8rem 1rem;
    vertical-align: middle;
  }

  .btn-info {
    background-color: #00bfa6;
    border-color: #00bfa6;
    padding: 0.35rem 0.5rem;
    font-size: 0.85rem;
  }

  .btn-info:hover {
    background-color: #00a28f;
    border-color: #00a28f;
  }

  .reservation-row td, .reservation-row th {
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }

  /* Dodatkowe odstępy między card a nav */
  .container.mt-5 {
    margin-top: 3rem !important;
  }

  @media (max-width: 576px) {
    .table td:nth-child(2), .table th:nth-child(2),
    .table td:nth-child(3), .table th:nth-child(3),
    .table td:nth-child(4), .table th:nth-child(4) {
      display: none;
    }
  }


</style>
