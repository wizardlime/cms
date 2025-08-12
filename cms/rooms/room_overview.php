<?php 

    include __DIR__ . '/../header.php'; 
    $room_id = $_GET['room_id'];
    $selectRoom = "SELECT * FROM rooms WHERE room_id = :room_id";
    $statement = $pdo->prepare($selectRoom);
    $statement->execute([':room_id' => $room_id]);
    $room = $statement->fetch(PDO::FETCH_OBJ);

?>


<?php if($room) : ?>

    <h3><?php echo $room->room_name ?></h3>
    <h3><?php echo $room->room_status ?></h3>
    <h2><?php echo $room->room_doornumber ?></h2>
    <h2><?php echo $room->room_beds ?></h2>
    <h3><?php echo $room->room_description ?></h3>

    <td><a href="room_edit.php?room_id=<?= $room -> room_id ?>">Edit Info</a></td>
    <a href="room_delete.php?room_id=<?= $room->room_id ?>">Delete Room</a>

<?php endif ?>



<div class="go-back-button">
    <a href="./rooms_overview.php">Go Back</a>
</div>