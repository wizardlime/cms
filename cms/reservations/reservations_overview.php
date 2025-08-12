<?php 

    include __DIR__ . '/../header.php'; 
    $selectAllReservations = "SELECT * FROM reservations";
    $statement = $pdo->query($selectAllReservations);
    $reservations = $statement->fetchAll(PDO::FETCH_OBJ);

    $message = '';

?>

<body class="container">
<div class="card text-center w-full">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link" href="../dashboard.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reservations_overview.php">Reservations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./rooms/rooms_overview.php">Rooms</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./users/users_overview.php">Users</a>
      </li>
    </ul>
  </div>
</div>
<div class="add_link"><a href='./reservations/new_reservation.php'>Book now</a></div>
  <?php if(!empty($message)): ?>
  <?php echo $message; ?>
<?php endif ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col" class="text-center bold">Room ID</th>
            <th scope="col" class="text-center bold">First Name</th>
            <th scope="col" class="text-center bold">Last Name</th>
            <th scope="col" class="text-center bold">Status</th>
            <th scope="col" class="text-center bold">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($reservations as $reservation): ?>
            <tr>
                <th scope="row"><?php echo $reservation->room_id; ?></th>
                <td class="text-center"><?php echo $reservation->reservation_name; ?> </td>
                <td class="text-center"><?php echo $reservation->reservation_lastname; ?> </td>
                <td class="text-center"><?php echo $reservation->reservation_status; ?> </td>
                <td class="text-center"><a href="./reservation_overview.php?reservation_id=<?= $reservation -> reservation_id ?>">See more</a></td>
            </tr>
        <?php endforeach ?> 
    </tbody>
</table>    
</body>


<!-- <?php 
    if($reservations->isEmpty()) {
        echo "No reservations found.";
    }
?> -->