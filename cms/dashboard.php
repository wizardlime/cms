<?php
include __DIR__ . './header.php';
require __DIR__ . './config/db.php';
include __DIR__ . './includes/auth.php'; 

// Statystyki
$totalRooms = $pdo->query("SELECT COUNT(*) FROM rooms")->fetchColumn();
$totalReservations = $pdo->query("SELECT COUNT(*) FROM reservations")->fetchColumn();
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$thisMonthReservations = $pdo->query("SELECT COUNT(*) FROM reservations WHERE MONTH(reservation_date_from) = MONTH(CURRENT_DATE())")->fetchColumn();
?>





<div class="container py-5">
  <h1 class="mb-5 text-center text-white">Dashboard</h1>

  <div class="row g-4 justify-content-center">

    <?php 
      $cards = [
        ['title'=>'Rooms', 'value'=>$totalRooms],
        ['title'=>'Reservations', 'value'=>$totalReservations],
        ['title'=>'Users', 'value'=>$totalUsers],
        ['title'=>'Reservations This Month', 'value'=>$thisMonthReservations]
      ];
    ?>

    <?php foreach($cards as $card): ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card text-white h-100 shadow dashboard-card d-flex align-items-center justify-content-center">
          <div class="text-center">
            <h5 class="card-title"><?= $card['title'] ?></h5>
            <p class="card-text fs-2"><?= $card['value'] ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</div>

<style>
  .dashboard-card {
    background-color: #001d3d; /* kolor kart */
    border-radius: 0.75rem;
    min-height: 180px; /* równa wysokość */
    transition: transform 0.2s;
  }

  .dashboard-card:hover {
    transform: translateY(-5px);
  }

  .card-title {
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  .card-text {
    font-weight: bold;
  }
</style>
























<!-- <div class="container mt-4">
  <h1 class="mb-4">Dashboard</h1>
  <div class="row">
    <div class="col-md-3">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body">
          <h5 class="card-title">Rooms</h5>
          <p class="card-text fs-4"><?= $totalRooms ?></p>
          <a href="./rooms/rooms_overview.php" class="text-decoration-none">See all rooms</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-success mb-3">
        <div class="card-body">
          <h5 class="card-title">Reservations</h5>
          <p class="card-text fs-4"><?= $totalReservations ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-warning mb-3">
        <div class="card-body">
          <h5 class="card-title">Users</h5>
          <p class="card-text fs-4"><?= $totalUsers ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-danger mb-3">
        <div class="card-body">
          <h5 class="card-title">This Month</h5>
          <p class="card-text fs-4"><?= $thisMonthReservations ?></p>
        </div>
      </div>
    </div>
  </div>
</div> -->


