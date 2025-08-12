<?php 

    include __DIR__ . '/../header.php'; 
    $selectAllRooms = "SELECT * FROM rooms";
    $statement = $pdo->query($selectAllRooms);
    $rooms = $statement->fetchAll(PDO::FETCH_OBJ);

    $message = '';

?>



  <div class="add_link"><a href='./add_room.php'>Add new room</a></div>
  <?php if(!empty($message)): ?>
  <?php echo $message; ?>
<?php endif ?>
<table>
    <thead>
        <tr>
            <th>Room ID</th>
            <th>Room Name</th>
            <th>Room Door Nr.</th>
            <th>Room Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php foreach($rooms as $room): ?>
                <td><?php echo $room->room_id ?></td>
                <td><?php echo $room->room_name ?> </td>
                <td><?php echo $room->room_doornumber ?> </td>
                <td><?php echo $room->room_status ?> </td>
                <td><a href="./room_overview.php?room_id=<?= $room -> room_id ?>">See more</a></td>
            <?php endforeach ?> 
        </tr>
    </tbody>
</table>