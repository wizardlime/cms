<?php 
    session_start();

    include __DIR__ . '/../header.php'; 

    $reservation_id = $_POST['reservation_id'] ?? $_GET['reservation_id'] ?? null;

    $delete_reservation = "DELETE FROM reservations WHERE reservation_id = :reservation_id";
    $statement = $pdo->prepare($delete_reservation);
    if($statement->execute([':reservation_id' => $reservation_id])) {
        header("Location: reservations_overview.php");
    }