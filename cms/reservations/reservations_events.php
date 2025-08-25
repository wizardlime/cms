<?php
require __DIR__ . '/db.php';
header('Content-Type: application/json');

$stmt = $pdo->query("SELECT r.reservation_id, r.reservation_date, ro.room_name 
                     FROM reservations r
                     JOIN rooms ro ON r.room_id = ro.room_id");

$events = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $events[] = [
        'title' => "Room: " . $row['room_name'],
        'start' => $row['reservation_date']
    ];
}
echo json_encode($events);