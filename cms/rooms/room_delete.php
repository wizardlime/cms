<?php 

    include __DIR__ . '/../header.php'; 
    include __DIR__ . '/../includes/auth.php'; 


    $room_id = $_GET['room_id'];
    $delete_room = "DELETE FROM rooms WHERE room_id = :room_id";
    $statement = $pdo->prepare($delete_room);
    if($statement->execute([':room_id' => $room_id])) {
        header("Location: rooms_overview.php");
    }