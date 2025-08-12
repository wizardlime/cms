<?php 

    include __DIR__ . '/../header.php'; 

    $room_id = $_GET['room_id'];
    $selectRoom = "SELECT * FROM rooms WHERE room_id = :room_id";
    $statement = $pdo->prepare($selectRoom);
    $statement->execute([':room_id' => $room_id]);
    $room = $statement->fetch(PDO::FETCH_OBJ);

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $room_name = $_POST['room_name'];
    $room_description = $_POST['room_description'];
    $room_beds = $_POST['room_beds'];
    $room_doornumber = $_POST['room_doornumber'];
    $room_status = $_POST['room_status'];

    $query = "UPDATE rooms SET room_name=:room_name, room_description=:room_description, room_beds=:room_beds, room_doornumber=:room_doornumber, room_status=:room_status WHERE room_id=:room_id";
    $statement = $pdo->prepare($query);

    if($statement->execute([
        ':room_name' => $room_name,
        ':room_description' => $room_description,
        ':room_beds' => $room_beds,
        ':room_doornumber' => $room_doornumber,
        ':room_status' => $room_status,
        ':room_id' => $room_id
    ])) {
        header('Location: ./rooms_overview.php');
        $message = "Room informations had been updated.";
    }

}

?>

<a href="./rooms_overview.php">Go Back</a>



<form method="post">
    <input type="text" value="<?= $room->room_name ?>" name="room_name">
    <input type="text" value="<?= $room->room_description ?>" name="room_description">
    <input type="text" value="<?= $room->room_beds ?>" name="room_beds">
    <input type="text" value="<?= $room->room_doornumber ?>" name="room_doornumber">

    <select name="room_status"><?= $room->room_status ?>
            <option value="Available" name="room_status">Available</option>
            <option value="Booked" name="room_status">Booked</option>
            <option value="Not Available" name="room_status">Not Available</option>
    </select>

    <input type="submit" value="Edit" name="submit">
</form>

