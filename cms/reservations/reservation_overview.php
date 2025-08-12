<?php 
include __DIR__ . '/../header.php'; 

$reservation_id = $_GET['reservation_id'];
$selectReservation = "SELECT * FROM reservations WHERE reservation_id = :reservation_id";
$statement = $pdo->prepare($selectReservation);
$statement->execute([':reservation_id' => $reservation_id]);
$reservation = $statement->fetch(PDO::FETCH_OBJ);

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
<div class="card">
  <div class="card-body">
    <?php if($reservation): ?> 
        <h3>Reservation nr. <?php echo $reservation -> reservation_id ?> overview</h3>
        <h2><?php echo $reservation -> reservation_lastname ?></h2>
        <h2><?php echo $reservation -> reservation_name ?></h2>
        <h2><?php echo $reservation -> reservation_email ?></h2>
        <h2><?php echo $reservation -> reservation_date_from ?></h2>
        <h2><?php echo $reservation -> reservation_date_to ?></h2>    
        <h2><?php echo $reservation -> room_id ?></h2>
        <a href="reservation_edit.php?reservation_id=<?= $reservation -> reservation_id ?>"class="btn btn-warning" role="button"><i class="bi bi-pencil-fill"></i>Edit</a>
        <a href="reservation_delete.php?reservation_id=<?= $reservation -> reservation_id ?>"class="btn btn-danger" role="button"><i class="bi bi-bin-fill"></i>Delete</a>

        <?php endif ?>
  </div>
</div>  
</body>


