<?php 
session_start();
include 'header.php'; 

$newReservations = "SELECT reservation_lastname, reservation_date_from, reservation_date_to, reservation_status FROM reservations ORDER BY reservation_date_from DESC LIMIT 5";
$statement = $pdo->query($newReservations);
$reservations = $statement->fetchAll(PDO::FETCH_OBJ);

// $countNewReservations = "SELECT COUNT(reservation_status) FROM reservations WHERE reservation_status= 'New' ";
// $statement1 = $pdo->query($countNewReservations);
// $countReservations = $statement1->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS | Dashboard</title>
</head>



<body class='container'>
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./reservations/reservations_overview.php">Reservations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./rooms/rooms_overview.php">Rooms</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./users/users_overview.php">Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./users/logout.php">Logout</a>
      </li>
    </ul>
  </div>
</div>







</body>
</html>