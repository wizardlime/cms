<?php 

include __DIR__ . '/../header.php'; 



    if(isset($_POST['submit'])) {


        $reservation_name = $_POST['reservation_name'];
        $reservation_lastname = $_POST['reservation_lastname'];
        $reservation_date_from = $_POST['reservation_date_from'];
        $reservation_date_to = $_POST['reservation_date_to'];
        $reservation_email = $_POST['reservation_email'];
        $reservation_status = "New";
        $room_id = $_POST['room_id'];

        $newReservation = "INSERT INTO reservations (reservation_name, reservation_lastname, reservation_date_from, reservation_date_to, reservation_email, reservation_status, room_id) 
        VALUES (:reservation_name, :reservation_lastname, :reservation_date_from, :reservation_date_to, :reservation_email, :reservation_status, :room_id)";
        
        $statement = $pdo->prepare($newReservation);
        $statement->execute([
            ':reservation_name' => $reservation_name,
            ':reservation_lastname' => $reservation_lastname,
            ':reservation_date_from' => $reservation_date_from,
            ':reservation_date_to' => $reservation_date_to,
            ':reservation_email' => $reservation_email,
            ':reservation_status' => $reservation_status,
            ':room_id' => $room_id
        ]);

        echo "Reservation added succesfully";

    }


    $rooms = $pdo->query("SELECT room_id, room_name from rooms")->fetchAll(PDO::FETCH_ASSOC);


?>


<h2>New Reservation</h2>
<form action="" method="post">
    <input type="text" name="reservation_name" placehodler="First Name">
    <input type="text" name="reservation_lastname" placehodler="Last Name">
    <input type="date" name="reservation_date_from" placehodler="Check-in Date">
    <input type="date" name="reservation_date_to" placehodler="Check-out Date">
    <input type="email" name="reservation_email" placehodler="Email address">

    <select name="room_id" id="">
        <?php foreach ($rooms as $room): ?>
            <option value="<?=$room['room_id']?> ">
                <?= htmlspecialchars($room['room_name']) ?>
            </option>
        <?php endforeach ?> 
    </select>

    <input type="submit" value="submit" name="submit">

</form>